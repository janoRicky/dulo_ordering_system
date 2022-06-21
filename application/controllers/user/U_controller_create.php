<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_create extends E_Core_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_create");
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");

 		date_default_timezone_set('Asia/Manila');

		$this->load->library("email", array(
			"protocol" => "smtp",
			"smtp_host" => "ssl://mail.bytemerchant.info",
			"smtp_port" => 465,
			"smtp_user" => $this->Model_read->get_config_wkey("smtp_user"), 
			"smtp_pass" => $this->Model_read->get_config_wkey("smtp_pass")
		));
 	}

	public function user_account_register() {
		$name_last = $this->input->post("inp_name_last");
		$name_first = $this->input->post("inp_name_first");
		$name_middle = $this->input->post("inp_name_middle");
		$name_extension = $this->input->post("inp_name_extension");

		$gender = $this->input->post("inp_gender");
		$email = $this->input->post("inp_email");
		$contact_num = $this->input->post("inp_contact_num");

		// $zip_code = $this->input->post("inp_zip_code");
		// $country = $this->input->post("inp_country");
		// $province = $this->input->post("inp_province");
		// $city = $this->input->post("inp_city");
		// $street = $this->input->post("inp_street");
		// $address = $this->input->post("inp_address");

		$password = $this->input->post("inp_password");

		if ($name_last == NULL || $name_first == NULL || $gender == NULL || $email == NULL || $contact_num == NULL
		 // || $province == NULL || $city == NULL || $street == NULL
		  || $password == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->Model_read->get_user_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("notice", array("warning", "Email is aready registered."));
			} else {

				do {
					$uid = uniqid('', true);
				} while ($this->Model_read->get_user_acc_wuid($uid)->num_rows() > 0);


				$data = array(
					"user_uid" => $uid,

					"name_last" => $name_last,
					"name_first" => $name_first,
					"name_middle" => $name_middle,
					"name_extension" => $name_extension,

					"gender" => $gender,
					"email" => $email,
					"contact_num" => $contact_num,

					// "zip_code" => $zip_code,
					// "country" => $country,
					// "province" => $province,
					// "city" => $city,
					// "street" => $street,
					// "address" => $address,

					"password" => password_hash($password, PASSWORD_BCRYPT),
					"status" => "1"
				);
				if ($this->Model_create->create_user_account($data)) {
					$this->session->set_flashdata("notice", array("success", "Registration Successful!"));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("home");
	}

	public function new_order() {
		
		include('application/libraries/phpqrcode/qrlib.php');

		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : 0);
		$date_time = date('Y-m-d H:i:s');
		// $ref_no = $this->input->post("inp_ref_no");

		// $zip_code = $this->input->post("inp_zip_code");
		// $country = $this->input->post("inp_country");
		// $province = $this->input->post("inp_province");
		// $city = $this->input->post("inp_city");
		// $street = $this->input->post("inp_street");
		// $address = $this->input->post("inp_address");


		$datetime_pickup = $this->input->post("inp_datetime_pickup");

		$payment_method = $this->input->post("inp_payment_method");

		$items_no = $this->input->post("items_no"); // WAT?
		$items = ($this->session->has_userdata("cart") ? $this->session->userdata("cart") : array());

		$items_notes = ($this->session->has_userdata("cart_notes") ? $this->session->userdata("cart_notes") : array());


		if ($user_id == NULL || count($items) < 1) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$user = $this->Model_read->get_user_acc_wid($user_id);
			if ($user->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "User does not exist."));
				redirect("home");
			} else {

			    $user_info = $user->row_array();

				$data_items = array();
				foreach ($items as $id => $qty) {
					if ($id != NULL && $qty != NULL) {
						$p_details = $this->Model_read->get_product_wid_user($id)->row_array();

						$data_temp = array(
							"product_id" => $id,
							"qty" => $qty,
							"price" => $p_details["price"],
							"type" => "PICKUP"
						);
						$data_temp["adtl_note"] = (isset($items_notes[$id]) ? $items_notes[$id] : "");

						$data_items[] = $data_temp;
					}
				}


				// generate unique id
				do {
					$ouid = uniqid('', true);
				} while ($this->Model_read->get_order_all_w_ouid($ouid)->num_rows() > 0);

				// make directories
				if (!is_dir("uploads")) {
					mkdir("./uploads", 0755, TRUE);
				}
				if (!is_dir("uploads/orders")) {
					mkdir("./uploads/orders", 0755, TRUE);
				}

				// make file path
				$file_name = $ouid .'.png';
				$file_path = 'uploads/orders/'. $file_name;
				$qr_link = base_url() .'order?ouid='. $ouid;


				$data = array(
					"order_uid" => $ouid,

					"user_id" => $user_id,
					"date_time" => $date_time,
					// "zip_code" => $zip_code,
					// "country" => $country,
					// "province" => $province,
					// "city" => $city,
					// "street" => $street,
					// "address" => $address,
					"datetime_pickup" => $datetime_pickup,

					"img_qr" => $file_name,

					"state" => "0",
					"status" => "1"
				);
				if ($this->Model_create->create_order($data)) {
					$order_id = $this->db->insert_id();

					foreach ($data_items as $row) {
						$row["order_id"] = $order_id;
						$this->Model_create->create_order_item($row);
					}

					$this->session->unset_userdata("cart");

					// generating
					if (!file_exists($file_path)) {
						QRcode::png($qr_link, $file_path, QR_ECLEVEL_L, 6, 4);
					}

					if ($payment_method == 0) {
						$this->email->set_newline("\r\n");
						$this->email->clear();
						$this->email->from("dulo.ordering@gmail.com");
						$this->email->to($this->Model_read->get_config_wkey("alerts_email_send_to"));
						$this->email->subject("New Order!");
						$this->email->message(
							"A new order has been placed by ". $user_info["email"] ."[user #". $user_id ."] at ". $date_time
						);
						$this->email->send();

						$this->session->set_flashdata("notice", array("success", "Order is successfully added."));
						
						redirect("my_orders");
					} else { // ONLINE PAYMENT
						// insert order payment
						$img = NULL;

						$user_folder = "user_". $user_id;
						$payment_folder = "order_". $order_id;

						$config["upload_path"] = "./uploads/users/". $user_folder ."/payments/". $payment_folder;
						$config["allowed_types"] = "gif|jpg|jpeg|png";
						$config["max_size"] = 5000;
						$config["encrypt_name"] = TRUE;

						$this->load->library("upload", $config);
						if (!is_dir("uploads")) {
							mkdir("./uploads", 0777, TRUE);
						}
						if (!is_dir("uploads/users")) {
							mkdir("./uploads/users", 0777, TRUE);
						}
						if (!is_dir("uploads/users/". $user_folder)) {
							mkdir("./uploads/users/". $user_folder, 0777, TRUE);
						}
						if (!is_dir("uploads/users/". $user_folder ."/payments")) {
							mkdir("./uploads/users/". $user_folder ."/payments", 0777, TRUE);
						}
						if (!is_dir("uploads/users/". $user_folder ."/payments/". $payment_folder)) {
							mkdir("./uploads/users/". $user_folder ."/payments/". $payment_folder, 0777, TRUE);
						}

						if (isset($_FILES["inp_img"])) {
							if (!$this->upload->do_upload("inp_img")) {
								$this->session->set_flashdata("notice", array("warning", $this->upload->display_errors()));
							} else {
								$img = $this->upload->data("file_name");
							}
						}

						$data = array(
							"payment_method" => $payment_method,
							
							"order_id" => $order_id,
							// "ref_no" => $ref_no,
							"img" => $img,
							"date_time" => $date_time,
							"type" => "0",
							"status" => "1"
						);

						if ($this->Model_create->create_order_payment($data)) {

							$this->email->set_newline("\r\n");
							$this->email->clear();
							$this->email->from("dulo.ordering@gmail.com");
							$this->email->to($this->Model_read->get_config_wkey("alerts_email_send_to"));
							$this->email->subject("New Order!");
							$this->email->message(
								"A new order has been placed by ". $user_info["email"] ."[user #". $user_id ."] at ". $date_time
							);
							$this->email->send();

							$this->session->set_flashdata("notice", array("success", "Order is successfully added."));
							
							redirect("my_orders");
						} else {
							$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again. [0]"));
						}
					}
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again. [1]"));
				}
			}
		}
		redirect("cart");
	}
	public function submit_payment() {
		$order_id = $this->input->post("inp_order_id");
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);
		$date_time = date('Y-m-d H:i:s');
		// $ref_no = $this->input->post("inp_ref_no");

		// get payment id for adtl payment
		$payment_id = $this->input->post("inp_payment_id");
		$payment = $this->Model_read->get_order_payment_adtl_wid($payment_id);

		$order_payments = $this->Model_read->get_order_payments_worder_id($order_id);

		$order = $this->Model_read->get_order_payable_wid_user_id($order_id, $user_id);
		if ($order_id == NULL || $order->num_rows() < 1) {
			$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[0]"));
		} elseif ($order_id == NULL || $user_id == NULL || $date_time == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		}
		//  elseif ($payment_id != NULL && $payment->num_rows() < 1) {
		// 	$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[1]"));
		// } 
		elseif ($order_payments->num_rows() > 10) {
			$this->session->set_flashdata("notice", array("warning", "Payment limit (10). Remove some payments first."));
		}
		else {
			$user = $this->Model_read->get_user_acc_wid($user_id);
			if ($user->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "User does not exist."));
				redirect("home");
			} else {
				// insert payment image
				$img = NULL;

				$user_folder = "user_". $user_id;
				$payment_folder = "order_". $order_id;

				$config["upload_path"] = "./uploads/users/". $user_folder ."/payments/". $payment_folder;
				$config["allowed_types"] = "gif|jpg|jpeg|png";
				$config["max_size"] = 5000;
				$config["encrypt_name"] = TRUE;

				$this->load->library("upload", $config);
				if (!is_dir("uploads")) {
					mkdir("./uploads", 0777, TRUE);
				}
				if (!is_dir("uploads/users")) {
					mkdir("./uploads/users", 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder)) {
					mkdir("./uploads/users/". $user_folder, 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder ."/payments")) {
					mkdir("./uploads/users/". $user_folder ."/payments", 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder ."/payments/". $payment_folder)) {
					mkdir("./uploads/users/". $user_folder ."/payments/". $payment_folder, 0777, TRUE);
				}

				if (isset($_FILES["inp_img"])) {
					if (!$this->upload->do_upload("inp_img")) {
						$this->session->set_flashdata("notice", array("warning", $this->upload->display_errors()));
					} else {
						$img = $this->upload->data("file_name");
					}
				}

				
				// submit order payment
				$data = array(
					"order_id" => $order_id,
					"img" => $img,
					"date_time" => $date_time,
					"type" => "0",
					"status" => "1"
				);

				if ($this->Model_create->create_order_payment($data)) {
					$user_info = $user->row_array();

					// send email
					$this->email->set_newline("\r\n");
					$this->email->clear();
					$this->email->from("dulo.ordering@gmail.com");
					$this->email->to($this->Model_read->get_config_wkey("alerts_email_send_to"));
					$this->email->subject("Payment for Order has been made!");
					$this->email->message(
						"Payment for a order [order #". $order_id ."] has been made by ". $user_info["email"] ."[user_id: ". $user_id ."] at ". $date_time
					);
					$this->email->send();

					$this->session->set_flashdata("notice", array("success", "Payment is successfully sent."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[3]"));
				}

				redirect("my_order_details?id=". $order_id);
			}
		}
		redirect("my_orders");
	}
	// = = = MESSAGES
	public function new_message_user() {
		$user_id = $this->session->userdata("user_id");
		$message = $this->input->post("inp_message");

		if ($user_id == NULL || $message == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$user = $this->Model_read->get_user_wacc_wid($user_id);
			if ($user->num_rows() < 1 && $user_id != 0) {
				$this->session->set_flashdata("notice", array("warning", "User ID does not exist."));
			} else {
				$data = array(
					"user_id" => $user_id,
					"message" => $message,
					"date_time" => date("Y-m-d H:i:s"),
					"seen" => "1",
					"status" => "1"
				);
				if ($this->Model_create->create_message($data)) {
					$this->session->set_flashdata("notice", array("success", "Message is successfully sent."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("customer_support");
	}
}