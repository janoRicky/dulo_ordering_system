<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_delete extends CI_Model {

	public function delete_product($id) {
		$this->db->where("product_id", $id);
		return $this->db->update("products", array("status" => "0"));
	}

	public function delete_type($id) {
		$this->db->where("type_id", $id);
		return $this->db->update("types", array("status" => "0"));
	}

	public function delete_order($id) {
		$this->db->where("order_id", $id);
		return $this->db->update("orders", array("status" => "0"));
	}
	public function delete_order_item_worder_id($id) {
		return $this->db->delete("orders_items", array("order_id" => $id));
	}

	public function delete_payment($id) {
		return $this->db->delete("orders_payments", array("payment_id" => $id));
	}

	public function delete_user_account($id) {
		$this->db->where("user_id", $id);
		return $this->db->update("user_accounts", array("status" => "0"));
	}

	public function delete_adm_account($id) {
		$this->db->where("admin_id", $id);
		return $this->db->update("admin_accounts", array("status" => "0"));
	}
}
