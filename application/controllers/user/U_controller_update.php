<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_update extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");
 	}

	public function user_details_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$name_last = $this->input->post("inp_name_last");
		$name_first = $this->input->post("inp_name_first");
		$name_middle = $this->input->post("inp_name_middle");
		$name_extension = $this->input->post("inp_name_extension");

		$gender = $this->input->post("inp_gender");

		if ($user_id == NULL || $name_last == NULL || $name_first == NULL || $gender == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"name_last" => $name_last,
				"name_first" => $name_first,
				"name_middle" => $name_middle,
				"name_extension" => $name_extension,
				
				"gender" => $gender
			);

			if ($this->Model_update->update_user_account($user_id, $data)) {
				$this->session->set_flashdata("notice", array("success", "Personal info is successfully updated."));
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("account_details");
	}
	public function user_account_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($user_id == NULL || $email == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$acc_info = $this->Model_read->get_user_acc_wid($user_id)->row_array();
			if ($this->Model_read->get_user_acc_wemail($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("notice", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"email" => $email
				);
				if ($password != NULL) {
					$data["password"] = password_hash($password, PASSWORD_BCRYPT);
				}

				if ($this->Model_update->update_user_account($user_id, $data)) {
					$this->session->set_flashdata("notice", array("success", "Account info is successfully updated."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("account_details");
	}
	public function user_address_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");

		if ($user_id == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"zip_code" => $zip_code,
				"country" => $country,
				"province" => $province,
				"city" => $city,
				"street" => $street,
				"address" => $address
			);

			if ($this->Model_update->update_user_account($user_id, $data)) {
				$this->session->set_flashdata("notice", array("success", "Address info is successfully updated."));
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("account_details");
	}
	public function user_contact_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$contact_num = $this->input->post("inp_contact_num");

		if ($user_id == NULL || $contact_num == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"contact_num" => $contact_num
			);

			if ($this->Model_update->update_user_account($user_id, $data)) {
				$this->session->set_flashdata("notice", array("success", "Contact info is successfully updated."));
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("account_details");
	}

	public function user_order_receive() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$order_id = $this->input->get("order_id");

		if ($user_id == NULL || $order_id == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"state" => "5"
			);

			if ($this->Model_update->update_order_wuser_id($order_id, $user_id, $data)) {
				$this->session->set_flashdata("notice", array("success", "Contact info is successfully updated."));
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("my_orders?state=5");
	}
	
	// public function submit_payment_unpaid() {
	// 	$order_id = $this->input->post("inp_order_id");
	// 	$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);
	// 	$date_time = date('Y-m-d H:i:s');
	// 	$ref_no = $this->input->post("inp_ref_no");

	// 	$order = $this->Model_read->get_order_to_pay_wid_user_id($order_id, $user_id);
	// 	if ($order_id == NULL || $order->num_rows() < 1) {
	// 		$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
	// 	} elseif ($order_id == NULL || $user_id == NULL || $date_time == NULL || $ref_no == NULL) {
	// 		$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
	// 	} else {
	// 		$user = $this->Model_read->get_user_acc_wid($user_id);
	// 		if ($user->num_rows() < 1) {
	// 			$this->session->set_flashdata("notice", array("warning", "User does not exist."));
	// 			redirect("home");
	// 		} else {
	// 			// insert order payment
	// 			$img = NULL;

	// 			$user_folder = "user_". $user_id;
	// 			$payment_folder = "order_". $order_id;

	// 			$config["upload_path"] = "./uploads/users/". $user_folder ."/payments/". $payment_folder;
	// 			$config["allowed_types"] = "gif|jpg|png";
	// 			$config["max_size"] = 5000;
	// 			$config["encrypt_name"] = TRUE;

	// 			$this->load->library("upload", $config);
	// 			if (!is_dir("uploads")) {
	// 				mkdir("./uploads", 0777, TRUE);
	// 			}
	// 			if (!is_dir("uploads/users")) {
	// 				mkdir("./uploads/users", 0777, TRUE);
	// 			}
	// 			if (!is_dir("uploads/users/". $user_folder)) {
	// 				mkdir("./uploads/users/". $user_folder, 0777, TRUE);
	// 			}
	// 			if (!is_dir("uploads/users/". $user_folder ."/payments")) {
	// 				mkdir("./uploads/users/". $user_folder ."/payments", 0777, TRUE);
	// 			}
	// 			if (!is_dir("uploads/users/". $user_folder ."/payments/". $payment_folder)) {
	// 				mkdir("./uploads/users/". $user_folder ."/payments/". $payment_folder, 0777, TRUE);
	// 			}

	// 			if (isset($_FILES["inp_img"])) {
	// 				if (!$this->upload->do_upload("inp_img")) {
	// 					$this->session->set_flashdata("notice", array("warning", $this->upload->display_errors()));
	// 				} else {
	// 					$img = $this->upload->data("file_name");
	// 				}
	// 			}

	// 			$data = array(
	// 				"order_id" => $order_id,
	// 				"img" => $img,
	// 				"date_time" => $date_time,
	// 				"status" => "1"
	// 			);

	// 			if ($this->Model_create->create_order_payment($data)) {
	// 				$user_info = $user->row_array();

	// 				$this->email->set_newline("\r\n");
	// 				$this->email->clear();
	// 				$this->email->from("angeliclay.ordering@gmail.com");
	// 				$this->email->to($this->Model_read->get_config_wkey("alerts_email_send_to"));
	// 				$this->email->subject("Payment for Custom Order has been made!");
	// 				$this->email->message(
	// 					"Payment for a custom order [custom order #". $order_id ."] has been made by ". $user_info["email"] ."[user_id: ". $user_id ."] at ". $date_time
	// 				);
	// 				$this->email->send();
	// 				$this->session->set_flashdata("notice", array("success", "Payment is successfully sent."));
	// 			} else {
	// 				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
	// 			}
	// 		}
	// 	}
	// 	redirect("home");
	// }
}