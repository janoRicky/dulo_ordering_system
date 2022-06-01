<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_facebook extends E_Core_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_create");
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");

 		date_default_timezone_set('Asia/Manila');
 	}

	// = = = AJAX
	public function login_with_facebook() {
		$name_last = $this->input->post("fb_first_name");
		$name_first = $this->input->post("fb_last_name");
		$name_middle = $this->input->post("fb_middle_name");

		$gender = "other";
		$email = $this->input->post("fb_email");
		$fb_id = $this->input->post("fb_id");


		if ($name_last == NULL || $name_first == NULL || $email == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->Model_read->get_user_acc_wemail($email)->num_rows() > 0) {
				$account = $this->Model_read->get_user_acc_wemail($email);
				if ($account->num_rows() < 1) {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				} else {
					$account_info = $account->row_array();

					$data = array(
						"user_id" => $account_info["user_id"],
						"user_uid" => $account_info["user_uid"],
						"user_name" => ucwords($account_info["name_first"] ." ". $account_info["name_last"]),
						"user_email" => $account_info["email"],
						"user_in" => TRUE
					);
					$this->session->set_userdata($data);
					$this->session->set_flashdata("notice", array("success", "Welcome ". $data["user_name"] ."!"));
				}
			} else {

				do {
					$uid = uniqid('', true);
				} while ($this->Model_read->get_user_acc_wuid($uid)->num_rows() > 0);


				$data = array(
					"user_uid" => $uid,

					"name_last" => $name_last,
					"name_first" => $name_first,
					"name_middle" => $name_middle,

					"gender" => $gender,
					"email" => $email,
					"fb_id" => $fb_id,

					"status" => "1"
				);
				if ($this->Model_create->create_user_account($data)) {
					$account = $this->Model_read->get_user_acc_wemail($email); // get freshly input details
					if ($account->num_rows() < 1) {
						$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
					} else {
						$account_info = $account->row_array();
						
						$data = array(
							"user_id" => $account_info["user_id"],
							"user_uid" => $account_info["user_uid"],
							"user_name" => ucwords($account_info["name_first"] ." ". $account_info["name_last"]),
							"user_email" => $account_info["email"],
							"user_in" => TRUE
						);
						$this->session->set_userdata($data);
						$this->session->set_flashdata("notice", array("success", "Welcome ". $data["user_name"] ."!"));
					}
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
}