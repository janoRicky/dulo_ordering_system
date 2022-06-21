<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_update extends E_Core_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Model_read");
		$this->load->model("Model_update");

 		date_default_timezone_set('Asia/Manila');

		$this->load->library("email", array(
			"protocol" => "smtp",
			"smtp_host" => "ssl://mail.bytemerchant.info",
			"smtp_port" => 465,
			"smtp_user" => $this->Model_read->get_config_wkey("smtp_user"), 
			"smtp_pass" => $this->Model_read->get_config_wkey("smtp_pass"),
			"mailtype" => "html"
		));
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

		$password = $this->input->post("inp_password");

		if ($user_id == NULL || $password == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$acc = $this->Model_read->get_user_acc_wid($user_id);
			if ($acc->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "Something went wrong, please try again."));
			} else {
				$data = array(
					"password" => password_hash($password, PASSWORD_BCRYPT)
				);

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

	

	// EMAIL CONFIRMATION
	public function email_verification() {
		$email = $this->input->get("em");
		$verification_code = $this->input->get("vc");

		if ($email == NULL || $verification_code == NULL) {
			$this->session->set_flashdata("notice", array("warning", "Something went wrong, please try again.[0]"));
		} else {
			$acc = $this->Model_read->get_user_acc_wemail($email);
			if ($acc->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "Something went wrong, please try again.[1]"));
			} else {
				$acc_info = $acc->row_array();
				if ($acc_info['email_verified'] == 1) {
					$this->session->set_flashdata("notice", array("warning", "Email already verified."));
				} elseif ($acc_info['email_verification_code'] != $verification_code) {
					$this->session->set_flashdata("notice", array("warning", "Something went wrong, please try again.[2]"));
				} elseif ($acc_info['email_verification_expiry'] < time()) {
					$this->session->set_flashdata("notice", array("warning", "Link has expired."));
				} else {
					$data = array(
						"email_verified" => 1
					);

					if ($this->Model_update->update_user_account($acc_info["user_id"], $data)) {
						$this->session->set_flashdata("notice", array("success", "Email is successfully verified, please proceed to login."));
					} else {
						$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[3]"));
					}
				}
			}
		}
		redirect("home");
	}
	// EMAIL VERIFICATION RESEND
	public function email_resend() {
		$email = $this->input->post("inp_email");

		if ($email == NULL) {
			$this->session->set_flashdata("notice", array("warning", "Something went wrong, please try again.[0]"));
		} else {
			$acc = $this->Model_read->get_user_acc_wemail($email);
			if ($acc->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "Something went wrong, please try again.[1]"));
			} else {
				$acc_info = $acc->row_array();
				if ($acc_info['email_verified'] == 1) {
					$this->session->set_flashdata("notice", array("warning", "Email already verified."));
				} elseif (!empty($acc_info['email_verification_resend_cooldown']) && $acc_info['email_verification_resend_cooldown'] > time()) {
					$this->session->set_flashdata("notice", array("warning", "Please wait ". date('s', $acc_info['email_verification_resend_cooldown']) ." seconds before trying again."));
				} else {
					$data = array(
						"email_verification_expiry" => time() + 86400, // current time + 24hrs
						"email_verification_resend_cooldown" => time() + 60, // current time + 60 seconds
					);

					if ($this->Model_update->update_user_account($acc_info["user_id"], $data)) {
						$this->email->set_newline("\r\n");
						$this->email->clear();
						$this->email->from("dulo.ordering@gmail.com");
						$this->email->to($email);
						$this->email->subject("Account Verification - Dulo Ordering System");
						$this->email->message(
							'<div style="width: 100%; background-color: #fff;">
								<div style="width: auto; background-color: #000; padding: 2rem 1rem 0 2rem;">
									<div style="width: 80%; max-width: 250px; margin: 0 auto;">
										<img style="width: 100%;" src="'. base_url("assets/img/dulo-logo.png") .'">
									</div>
								</div>
								<div style="width: auto; background-color: #000; padding: 2rem; text-align: center; color: #fff; padding-bottom: 3rem;">
									<h2>WELCOME TO DULO ORDERING SYSTEM!</h2>
									<p>Click the button below to verify your email and activate your account.</p>
									<div style="width: 100%; margin: 3rem 0;">
										<a href="'. base_url("verify_email?em=". $email ."&vc=". $acc_info["email_verification_code"]) .'" style="border-radius: 1rem; border-radius: 50rem; background-color: #fff; padding: 1rem 2rem; text-decoration: none; color: #000;">
											<span style="font-weight: bold;">Verify my email.</span>
										</a>
									</div>
									<small>This link will expire in 24 hours</small>
								</div>
							</div>'
						);
						$this->email->send();

						$this->session->set_flashdata("notice", array("success", "Verification link is successfully sent, please check your email."));
					} else {
						$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[3]"));
					}
				}
			}
		}
		redirect("home");
	}
}