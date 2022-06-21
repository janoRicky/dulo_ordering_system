<?php 
 defined("BASEPATH") OR exit("No direct script access allowed");

 class U_controller_login extends E_Core_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 	}
	public function user_login_verification() {
		$email = $this->input->post("inp_email", TRUE);
		$password = $this->input->post("inp_password", TRUE);

		if ($email == NULL || $password == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$account = $this->Model_read->get_user_acc_wemail($email);
			if ($account->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "Account does not exist."));
			} else {
				$account_info = $account->row_array();
				if ($account_info['email_verified'] == 0) {
					$this->session->set_flashdata("notice", array("warning", "Please verify your email first.". $account_info['email_verified']));
				} else {
					if (password_verify($password, $account_info["password"])) {
						$data = array(
							"user_id" => $account_info["user_id"],
							"user_uid" => $account_info["user_uid"],
							"user_name" => ucwords($account_info["name_first"] ." ". $account_info["name_last"]),
							"user_email" => $account_info["email"],
							"user_in" => TRUE
						);
						$this->session->set_userdata($data);
						$this->session->set_flashdata("notice", array("success", "Welcome ". $data["user_name"] ."!"));
						redirect($_SERVER['HTTP_REFERER']);
					} else {
						$this->session->set_flashdata("notice", array("warning", "Password is incorrect."));
					}
				}
			}
		}
		redirect("home");
	}
}