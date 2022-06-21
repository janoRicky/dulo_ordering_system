<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_update extends E_Core_Controller {

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


	public function user_order_cancel() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$order_id = $this->input->get("oid");

		if ($user_id == NULL || $order_id == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {

			$order = $this->Model_read->get_order_all_wid_user_id_state($order_id, $user_id, "0");
			if ($order->num_rows() > 0) {
				$data = array(
					"state" => "3"
				);

				if ($this->Model_update->update_order_wuser_id($order_id, $user_id, $data)) {
					$this->session->set_flashdata("notice", array("success", "Order is successfully cancelled."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("my_orders?state=3");
	}
	public function user_order_share() {

		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$order_id = $this->input->get("oid");

		if ($user_id == NULL || $order_id == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			
			$order = $this->Model_read->get_order_unshared_all_wid($order_id, $user_id);
			if ($order->num_rows() > 0 && $order->row_array()['state'] != 3) {

				$data = array(
					"shared" => '1'
				);

				if ($this->Model_update->update_order_wuser_id($order_id, $user_id, $data)) {

					$this->session->set_flashdata("notice", array("success", "Order is now shareable!"));

					redirect(explode("#", $_SERVER['HTTP_REFERER'])[0] ."#share");
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[1]"));
				}
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[0]"));
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
}