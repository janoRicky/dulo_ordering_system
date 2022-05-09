<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_read extends CI_Model {


	public function get_orders_custom($state) {
		$where_state = ($state != "ALL" ? "AND state = '$state'" : "");
		$query = "SELECT * FROM orders AS o WHERE status = '1' $where_state AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_order_custom_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_order_general_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id)";
		return $this->db->query($query);
	}
	public function get_order_custom_to_pay_wid_user_id($id, $user_id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND user_id = '$user_id' AND state = '1' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_product_custom_wid($id) {
		$query = "SELECT * FROM products_custom WHERE custom_id = '$id'";
		return $this->db->query($query);
	}

	public function get_products() {
		return $this->db->get_where("products", array("status" => "1", "type" => "NORMAL"));
	}
	public function get_products_user() {
		$query = "SELECT * FROM products AS p WHERE status = '1' AND visibility = '1' AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)";
		return $this->db->query($query);
	}
	public function get_products_user_view($search, $type, $page) {
		$search_query = (!is_null($type) && !empty($type) ? "AND type_id = '$type' " : "") . (!is_null($search) ? "AND (name LIKE '%$search%' OR description LIKE '%$search%') " : "");
		$pg_no = (!is_null($page) && !empty($page) ? $page * 10 : 0);

		$query = "SELECT * FROM products AS p WHERE status = '1' AND visibility = '1' $search_query AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id) ORDER BY p.date_added DESC LIMIT 10 OFFSET $pg_no";
		return $this->db->query($query);
	}
	public function get_product_wid($id) {
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wid_user($id) {
		$query = "SELECT * FROM products AS p WHERE product_id = '$id' AND status = '1' AND visibility = '1' AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)";
		return $this->db->query($query);
	}
	public function get_product_desc_wid($id) {
		$this->db->select("description");
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wtype($id) {
		return $this->db->get_where("products", array("type_id" => $id));
	}
	public function get_products_featured() {
		return $this->db->get_where("products", array("featured !=" => "NULL"));
	}
	public function get_product_featured_wno($no) {
		return $this->db->get_where("products", array("featured" => $no));
	}

	public function get_types() {
		return $this->db->get_where("types", array("status" => "1"));
	}
	public function get_types_featured_view() { // showw types with products that are available for purchase
		$query = "SELECT * FROM types AS t WHERE status = '1' AND EXISTS(SELECT * FROM products AS p WHERE t.type_id = p.type_id AND visibility = '1')";
		return $this->db->query($query);
	}
	public function get_type_wid($id) {
		return $this->db->get_where("types", array("type_id" => $id));
	}
	public function get_types_featured() {
		return $this->db->get_where("types", array("status" => "1", "featured" => "1"));
	}
	public function get_types_user() {
		return $this->db->get("types");
	}

	public function get_orders($state) {
		$where_state = ($state != "ALL" ? "AND state = '$state'" : "");
		$query = "SELECT * FROM orders AS o WHERE status = '1' $where_state AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL')";
		return $this->db->query($query);
	}
	public function get_order_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL')";
		return $this->db->query($query);
	}
	public function get_order_wuser_id($id, $state) {
		$where_state = ($state != "ALL" ? array("state" => $state) : array());
		return $this->db->get_where("orders", array_merge(array("user_id" => $id, "status" => "1"), $where_state));
	}
	public function get_order_states_wuser_id($id) {
		$this->db->select("state");
		return $this->db->get_where("orders", array("user_id" => $id, "status" => "1"));
	}
	public function get_order_items_worder_id($id) {
		return $this->db->get_where("orders_items", array("order_id" => $id));
	}
	public function get_order_items_qty_price_worder_id($id) {
		$this->db->select("qty, price");
		return $this->db->get_where("orders_items", array("order_id" => $id));
	}

	public function get_order_all_wid_user_id($id, $user_id) {
		return $this->db->get_where("orders", array("order_id" => $id, "user_id" => $user_id));
	}
	public function get_order_to_pay_wid_user_id($id, $user_id) {
		return $this->db->get_where("orders", array("order_id" => $id, "user_id" => $user_id, "state" => "1"));
	}
	public function get_order_items_wid_user_id($id, $user_id, $type) {
		$query = "SELECT * FROM orders_items AS oi WHERE order_id = '$id' AND type = '$type' AND EXISTS(SELECT * FROM orders AS o WHERE o.order_id = oi.order_id AND user_id = '$user_id' AND status = '1')";
		return $this->db->query($query);
	}

	public function get_order_payments_worder_id($order_id) {
		return $this->db->get_where("orders_payments", array("order_id" => $order_id, "type" => "0"));
	}
	public function get_order_payment_wid($payment_id) {
		return $this->db->get_where("orders_payments", array("payment_id" => $payment_id, "type" => "0"));
	}

	public function get_order_payments_adtl_worder_id($order_id) {
		return $this->db->get_where("orders_payments", array("order_id" => $order_id, "type" => "1"));
	}
	public function get_order_payment_adtl_wid($payment_id) {
		return $this->db->get_where("orders_payments", array("payment_id" => $payment_id, "type" => "1"));
	}

	public function get_all_order_payments_paid_worder_id($order_id) {
		return $this->db->get_where("orders_payments", array("order_id" => $order_id, "status" => "1"));
	}
	public function get_order_payments_unpaid_worder_id($order_id) {
		return $this->db->get_where("orders_payments", array("order_id" => $order_id, "type" => "1", "status" => "0"));
	}

	public function get_user_accounts() {
		return $this->db->get_where("user_accounts", array("status" => "1"));
	}
	public function get_user_acc_wid($id) {
		return $this->db->get_where("user_accounts", array("user_id" => $id));
	}
	public function get_user_wacc_wid($id) {
		return $this->db->get_where("user_accounts", array("email !=" => "NULL", "user_id" => $id));
	}
	public function get_user_acc_wemail($email) {
		return $this->db->get_where("user_accounts", array("email" => $email, "status" => "1"));
	}
	public function search_user_emails($search) {
		$this->db->select("user_id, email, name_last, name_first, name_middle, name_extension");
		$this->db->from("user_accounts");
		$this->db->where(array(
			"status" => "1"
		));
		$this->db->like("email", $search);
		$this->db->or_like(array(
			"user_id" => $search,
			"name_last" => $search,
			"name_first" => $search
		));
		$this->db->limit(8);
		return $this->db->get();
	}
	public function get_user_address_wid($id) {
		$this->db->select("email, zip_code, country, province, city, street, address");
		$this->db->from("user_accounts");
		$this->db->where("user_id", $id);
		return $this->db->get();
	}
	public function search_user_names($search) {
		$this->db->select("user_id, email, name_last, name_first, name_middle, name_extension");
		$this->db->from("user_accounts");
		$this->db->where(array(
			"status" => "1"
		));
		$this->db->like("user_id", $search);
		$this->db->or_like(array(
			"email" => $search,
			"name_last" => $search,
			"name_first" => $search,
			"name_middle" => $search,
			"name_extension" => $search
		));
		$this->db->limit(8);
		return $this->db->get();
	}
	public function get_user_info_wid($id) {
		$this->db->select("name_last, name_first, name_middle, name_extension, gender, contact_num, zip_code, country, province, city, street, address");
		$this->db->from("user_accounts");
		$this->db->where("user_id", $id);
		return $this->db->get();
	}
	public function get_user_message_wid($id) {
		$this->db->from("messages");
		$this->db->where("message_id", $id);
		return $this->db->get();
	}
	public function get_messages_conversations() {
		$query = ("SELECT m.message_id, m.user_id, m.admin_id, m.message, m.seen, m.date_time FROM (SELECT message_id, admin_id, user_id, message, seen, date_time, MAX(message_id) OVER (PARTITION BY user_id) max_message_id FROM messages) m WHERE m.message_id = m.max_message_id");
		return $this->db->query($query);
	}
	public function get_user_messages_all_wuser_id($user_id) {
		$this->db->select("message_id");
		$this->db->from("messages");
		$this->db->where("user_id", $user_id);
		return $this->db->get();
	}
	public function get_user_messages_wuser_id($user_id, $offset) {
		$this->db->from("messages");
		$this->db->where("user_id", $user_id);
		$this->db->limit(10, $offset);
		$this->db->order_by("message_id", "DESC");
		return $this->db->get();
	}
	public function get_user_messages_latest($user_id) {
		$this->db->select("message_id, admin_id, seen");
		$this->db->from("messages");
		$this->db->where("user_id", $user_id);
		$this->db->limit(1);
		$this->db->order_by("message_id", "DESC");
		return $this->db->get();
	}

	public function get_adm_accounts() {
		return $this->db->get_where("admin_accounts", array("status" => "1"));
	}
	public function get_adm_acc_wid($id) {
		return $this->db->get_where("admin_accounts", array("admin_id" => $id));
	}
	public function get_adm_acc_wemail($email) {
		return $this->db->get_where("admin_accounts", array("email" => $email));
	}

	public function get_config() {
		return $this->db->get("config");
	}
	public function get_config_wkey($key) {
		return $this->db->get_where("config", array("c_key" => $key))->row_array()["c_val"];
	}


	public function is_order_custom($id) {
		return ($this->db->get_where("orders_items", array("order_id" => $id, "type" => "CUSTOM"))->num_rows() > 0);
	}


	public function get_orders_custom_w_date($state, $date) {
		$date_from = date("Y-m-01", strtotime($date));
		$date_to = date("Y-m-t", strtotime($date));
		$where_state = ($state != "ALL" ? "AND state = '$state'" : "");
		$query = "SELECT date_time FROM orders AS o WHERE status = '1' $where_state AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM') AND date_time BETWEEN '$date_from' AND '$date_to'";
		return $this->db->query($query);
	}
	public function get_orders_w_date($state, $date) {
		$date_from = date("Y-m-01", strtotime($date));
		$date_to = date("Y-m-t", strtotime($date));
		$where_state = ($state != "ALL" ? "AND state = '$state'" : "");
		$query = "SELECT date_time FROM orders AS o WHERE status = '1' $where_state AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL') AND date_time BETWEEN '$date_from' AND '$date_to'";
		return $this->db->query($query);
	}
}
