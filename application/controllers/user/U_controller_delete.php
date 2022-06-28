<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_delete extends E_Core_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 		$this->load->model("Model_delete");
 	}


    public function delete_payment() {
        $payment_id = $this->input->get("id");
        $order_id = $this->input->get("oid");
        $user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);


        $order = $this->Model_read->get_order_to_pay_wid_user_id($order_id, $user_id);
        if ($order_id == NULL || $order->num_rows() < 1) {
            $this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[0]"));
        } elseif ($order_id == NULL || $user_id == NULL) {
            $this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
        } else {
            $this->Model_delete->delete_payment($payment_id);
            $this->session->set_flashdata("notice", array("success", "Successfully removed payment."));
        }
        redirect("my_order_details?id=". $order_id);
    }
    public function delete_item() {
        $item_id = $this->input->get("id");
        $order_id = $this->input->get("oid");
        $user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);


        $order = $this->Model_read->get_order_all_wid_user_id_state($order_id, $user_id, '0');
        if ($order_id == NULL || $order->num_rows() < 1) {
            $this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[0]"));
        } elseif ($order_id == NULL || $user_id == NULL) {
            $this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
        } else {
            $item = $this->Model_read->get_order_items_wid_order_id($item_id, $order_id);
            if ($item->num_rows() > 0) {
                $this->Model_delete->delete_order_item_witem_id($item_id);
                $this->session->set_flashdata("notice", array("success", "Successfully removed item."));
            } else {
                $this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again.[1]"));
            }
        }
        redirect("my_order_details?id=". $order_id);
    }
}