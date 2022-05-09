<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class A_controller_delete extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 		$this->load->model("Model_delete");
 		$this->load->model("Model_update");
 	}

	// = = = PRODUCTS
	public function delete_product() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			if ($this->Model_read->get_product_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Product does not exist."));
			} else {
				if ($this->Model_delete->delete_product($id)) {
					$this->session->set_flashdata("alert", array("success", "Product is successfully deleted."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/products");
	}
	// = = = TYPES
	public function delete_type() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			if ($this->Model_read->get_type_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Type does not exist."));
			} else {
				
				$products = $this->Model_read->get_product_wtype($id);
				foreach ($products->result_array() as $row) {
					$data = array(
						"type_id" => NULL,
					);
					$this->Model_update->update_product($row["product_id"], $data);
				}

				if ($this->Model_delete->delete_type($id)) {
					$this->session->set_flashdata("alert", array("success", "Type is successfully deleted."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/types");
	}
	// = = = PAYMENT
	public function delete_payment_tbp() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			$payment = $this->Model_read->get_order_payment_adtl_wid($id);
			if ($payment->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Payment does not exist."));
			} else {
				$payment_details = $payment->row_array();

				if ($payment_details["status"] == 0) {
					if ($this->Model_delete->delete_payment($id)) {
						$this->session->set_flashdata("alert", array("success", "Payment is successfully deleted."));
					} else {
						$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					}
				}
			}
		}
		if (strpos($_SERVER["HTTP_REFERER"], "orders_custom") == false) {
			redirect("admin/orders". (isset($payment_details["order_id"]) ? "_view?id=". $payment_details["order_id"] : ""));
		} else {
			redirect("admin/orders_custom". (isset($payment_details["order_id"]) ? "_view?id=". $payment_details["order_id"] : ""));
		}
	}
	// = = = ORDERS
	public function delete_order() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			if ($this->Model_read->get_order_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Order does not exist."));
			} else {
				$order_items = $this->Model_read->get_order_items_worder_id($id);
				foreach ($order_items->result_array() as $row) { // restore stock before deleting order
					$product_info = $this->Model_read->get_product_wid($row["product_id"])->row_array();
					$data_product["qty"] = $product_info["qty"] + $row["qty"];
					$this->Model_update->update_product($row["product_id"], $data_product);
				}
				
				if ($this->Model_delete->delete_order($id)) {
					$this->session->set_flashdata("alert", array("success", "Order is successfully deleted."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders");
	}
	// = = = ORDERS CUSTOM
	public function delete_order_custom() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			if ($this->Model_read->get_order_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Order does not exist."));
			} else {
				if ($this->Model_delete->delete_order($id)) {
					$this->session->set_flashdata("alert", array("success", "Order is successfully deleted."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders_custom");
	}
	// = = = USERS
	public function delete_user_account() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			if ($this->Model_read->get_user_acc_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Account does not exist."));
			} else {
				if ($this->Model_delete->delete_user_account($id)) {
					$this->session->set_flashdata("alert", array("success", "Account is successfully deleted."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/users");
	}
	// = = = ADMINS
	public function delete_admin_account() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
		} else {
			if ($this->Model_read->get_adm_acc_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Account does not exist."));
			} else {
				if ($this->Model_delete->delete_adm_account($id)) {
					$this->session->set_flashdata("alert", array("success", "Account is successfully deleted."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/accounts");
	}
}