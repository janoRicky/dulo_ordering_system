<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_create extends CI_Model {


	public function create_product_custom($data) {
		return $this->db->insert("products_custom", $data);
	}

	public function create_product($data) {
		return $this->db->insert("products", $data);
	}

	public function create_type($data) {
		return $this->db->insert("types", $data);
	}

	public function create_order($data) {
		return $this->db->insert("orders", $data);
	}
	public function create_order_item($data) {
		return $this->db->insert("orders_items", $data);
	}
	public function create_order_payment($data) {
		return $this->db->insert("orders_payments", $data);
	}

	public function create_user_account($data) {
		return $this->db->insert("user_accounts", $data);
	}
	public function create_message($data) {
		return $this->db->insert("messages", $data);
	}
	public function message_user($user_id, $admin_id, $message, $date_time) {
		$data = array(
			"user_id" => $user_id,
			"admin_id" => $admin_id,
			"message" => $message,
			"date_time" => $date_time,
			"seen" => "0",
			"status" => "1"
		);
		return $this->db->insert("messages", $data);
	}

	public function create_adm_account($data) {
		return $this->db->insert("admin_accounts", $data);
	}
}
