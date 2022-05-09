<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_session extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 		$this->load->model("Model_create");
 	}

	public function to_cart() {
		$id = $this->input->get("id");
		$amount = $this->input->get("amount");
		$submit = $this->input->get("submit");

		if ($amount > 0) {
			if (!$this->session->has_userdata("cart")) {
				$data["cart"] = array($id => $amount);
			} else {
				$cart = $this->session->userdata("cart");

				$cart[$id] = $amount;
				$data["cart"] = $cart;
			}
			$this->session->set_userdata($data);
		}
		

		if ($submit == "BN") {
			redirect("cart");
		} else {
			redirect("products");
		}
	}
	public function remove_from_cart() {
		$id = $this->input->get("id");

		if ($this->session->has_userdata("cart")) {
			$cart = $this->session->userdata("cart");

			if (array_key_exists($id, $cart)) {
				unset($cart[$id]);
				$data["cart"] = $cart;
				$this->session->set_userdata($data);
			}
		}

		redirect("cart");
	}
}