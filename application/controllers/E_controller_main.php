<?php 
 defined("BASEPATH") OR exit("No direct script access allowed");

 class E_controller_main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Model_read");
		$this->load->model("Model_update");

		date_default_timezone_set("Asia/Manila");
	}


	public function index() {
		redirect("home");
	}

	public function view_u_home() {
		$head["title"] = "DULO By The A's - Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		// $data["tbl_products"] = $this->Model_read->get_products_featured();
		// $data["tbl_types"] = $this->Model_read->get_types_featured();

		$this->load->view("user/u_home", $data);
	}
	public function view_u_products() {
		$search = $this->input->get("search");
		$type = $this->input->get("type");
		$page = intval($this->input->get("page"));
		
		$page_total = intval($this->Model_read->get_products_user()->num_rows() / 10) + 1;

		$page_no = (!is_null($page) && $page >= 0 ? ($page > $page_total-1 ? $page_total-1 : $page) : 0);

		$head["title"] = "Products - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);
		$data["tbl_products"] = $this->Model_read->get_products_user_view($search, $type, $page_no);
		foreach ($this->Model_read->get_types_featured_view()->result_array() as $row) {
			$data["types"][$row["type_id"]] = $row["name"];
		}

		$data["page_total"] = $page_total;
		$data["page_no"] = $page_no;
		$next_page = $this->Model_read->get_products_user_view($search, $type, $page_no + 1);
		$data["page_limit"] = ($next_page->num_rows() > 0 ? FALSE : TRUE);

		$this->load->view("user/u_products", $data);
	}
	public function view_u_product() {
		$id = $this->input->get("id");

		$head["title"] = "Product #$id - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$product = $this->Model_read->get_product_wid_user($id);

		if ($id == NULL || $product->num_rows() < 1) {
			redirect("products");
		} else {
			$data["product_details"] = $product->row_array();
			$data["type"] = $this->Model_read->get_type_wid($data["product_details"]["type_id"])->row_array()["name"];
			$this->load->view("user/u_product", $data);
		}
	}
	public function view_u_custom() {
		$head["title"] = "Custom - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			$this->session->set_flashdata("notice", array("warning", "Please log-in first."));
			redirect("login");
		} else {
			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["name"];
			}

			$user_details = $this->Model_read->get_user_acc_wid($this->session->userdata("user_id"));
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_custom", $data);
			}
		}
	}
	public function view_u_cart() {
		$head["title"] = "Cart - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if ($this->session->has_userdata("cart")) {
			$data["cart"] = $this->session->userdata("cart");
			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["name"];
			}
		} else {
			$data["cart"] = array();
		}

		$this->load->view("user/u_cart", $data);
	}
	public function view_u_submit_order() {
		$head["title"] = "Place Order - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$grand_total = $this->input->post("grand_total");

		if (!$this->session->has_userdata("user_in")) {
			$this->session->set_flashdata("notice", array("warning", "Please log-in first."));
			redirect("login");
		} else {
			if (!isset($grand_total) || $grand_total <= 0){
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				redirect("cart");
			} else {
				$user_details = $this->Model_read->get_user_acc_wid($this->session->userdata("user_id"));
				if ($user_details->num_rows() < 1) {
					session_destroy();
					redirect("home");
				} else {
					$data["grand_total"] = $grand_total;
					$data["account_details"] = $user_details->row_array();
					$this->load->view("user/u_submit_order", $data);
				}
			}
		}
	}
	public function view_u_login() {
		if ($this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$head["title"] = "Login - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

			$this->load->view("user/u_login", $data);
		}
	}
	public function view_u_register() {
		if ($this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$head["title"] = "Register - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

			$this->load->view("user/u_register", $data);
		}
	}
	public function user_logout() {
		if ($this->session->has_userdata("user_in")) {
			$this->session->unset_userdata(array("user_id", "user_name", "user_email", "user_in"));
			redirect("login");
		}
	}
	public function view_u_account() {
		$head["title"] = "Account - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$user_id = $this->session->userdata("user_id");

			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);

			$order_states = $this->Model_read->get_order_states_wuser_id($user_id)->result_array();
			$data["order_state_counts"] = array_count_values(array_column($order_states, "state"));

			$user_details = $this->Model_read->get_user_acc_wid($user_id);
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_account", $data);
			}
		}
	}
	public function view_u_account_details() {
		$head["title"] = "Account Details - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$user_id = $this->session->userdata("user_id");

			$user_details = $this->Model_read->get_user_acc_wid($user_id);
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_account_details", $data);
			}
		}
	}
	public function view_u_my_orders() {
		$state = ($this->input->get("state") != NULL ? $this->input->get("state") : "ALL");

		$head["title"] = "My Orders - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);
			$user_id = $this->session->userdata("user_id");
			
			$order_states = $this->Model_read->get_order_states_wuser_id($user_id)->result_array();
			$data["order_state_counts"] = array_count_values(array_column($order_states, "state"));

			$data["my_orders"] = $this->Model_read->get_order_wuser_id($user_id, $state);
			$this->load->view("user/u_my_orders", $data);
		}
	}
	public function view_u_my_order_details() {
		$id = $this->input->get("id");

		$head["title"] = "Order Details - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$user_id = $this->session->userdata("user_id");

		// get order details
		$order = $this->Model_read->get_order_all_wid_user_id($id, $user_id);
		if ($id == NULL || $order->num_rows() < 1) {
			redirect("my_orders");
		} else {
			// get state count
			$order_states = $this->Model_read->get_order_states_wuser_id($user_id)->result_array();
			$data["order_state_counts"] = array_count_values(array_column($order_states, "state"));

			// get order item details
			$order_items = $this->Model_read->get_order_items_wid_user_id($id, $user_id, "CUSTOM");
			$type = "CUSTOM";
			if ($order_items->num_rows() < 1) {
				$order_items = $this->Model_read->get_order_items_wid_user_id($id, $user_id, "NORMAL");
				$type = "NORMAL";
			}
			// state descriptions
			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);
			// get order payments
			$data["order_payments"] = $this->Model_read->get_order_payments_worder_id($id);

			$data["my_order"] = $order->row_array();
			$data["order_items"] = $order_items;
			$data["type"] = $type;
			$data["user_id"] = $user_id;
			$data["order_id"] = $id;

			foreach ($this->Model_read->get_types_user()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["name"];
			}

			$this->load->view("user/u_my_order_details", $data);
		}
	}
	public function view_u_my_order_payment() {
		$id = $this->input->get("id");

		$head["title"] = "Order Payment - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$user_id = $this->session->userdata("user_id");

		$order = $this->Model_read->get_order_to_pay_wid_user_id($id, $user_id);
		if ($id == NULL || $order->num_rows() < 1) {
			redirect("my_orders");
		} else {
			$order_items = $this->Model_read->get_order_items_wid_user_id($id, $user_id, "CUSTOM");
			$type = "CUSTOM";
			if ($order_items->num_rows() < 1) {
				$order_items = $this->Model_read->get_order_items_wid_user_id($id, $user_id, "NORMAL");
				$type = "NORMAL";
			}
			
			$data["my_order"] = $order->row_array();
			$data["order_items"] = $order_items;

			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);
			$data["order_payments"] = $this->Model_read->get_order_payments_worder_id($id);

			$data["order_id"] = $id;
			$data["type"] = $type;

			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["name"];
			}

			$this->load->view("user/u_my_order_payment", $data);
		}
	}
	public function view_u_my_order_adtl_payment() {
		$id = $this->input->get("id");

		$head["title"] = "Order Adtl. Payment - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$user_id = $this->session->userdata("user_id");

		$order = $this->Model_read->get_order_to_pay_wid_user_id($id, $user_id); // if order state is waiting for payment
		if ($id == NULL || $order->num_rows() < 1) {
			redirect("my_orders");
		} else {
			$payments_adtl = $this->Model_read->get_order_payments_adtl_worder_id($id);
			if ($payments_adtl->num_rows() > 0) {
				$data["my_order"] = $order->row_array();

				$data["states"] = array(
					"PENDING", 
					"WAITING FOR PAYMENT", 
					"ACCEPTED / IN PROGRESS", 
					"TO SHIP", 
					"SHIPPED", 
					"RECEIVED", 
					"CANCELLED"
				);
				$data["order_payments"] = $payments_adtl;

				$data["order_id"] = $id;

				$this->load->view("user/u_my_order_adtl_payment", $data);
			} else {
				redirect("my_orders");
			}
		}
	}
	public function view_u_customer_support() {
		$head["title"] = "Customer Support Chat - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$user_id = $this->session->userdata("user_id");
			$page = ($this->input->get("pg") ? $this->input->get("pg") : 0);

			$data["tbl_messages_all"] = $this->Model_read->get_user_messages_all_wuser_id($user_id);

			$data["tbl_messages"] = $this->Model_read->get_user_messages_wuser_id($user_id, $page * 10);
			$data["tbl_page"] = $page;
			$data["user_id"] = $user_id;

			$msg_latest_id = max(array_column($data["tbl_messages_all"]->result_array(), "message_id"));
			$msg_latest = $this->Model_read->get_user_message_wid($msg_latest_id)->row_array();
			if ($msg_latest["admin_id"] != NULL && $msg_latest["seen"] == "0") {
				$this->Model_update->see_user_message($msg_latest_id);
			}

			$this->load->view("user/u_support", $data);
		}
	}



	// ADMIN
	public function admin_logout() {
		$this->session->unset_userdata(array("admin_id", "admin_name", "admin_email", "admin_in"));
		redirect("admin");
	}
	public function admin_login_check() {
		// check if admin is logged in, sessions are set on A_controller_login
		if (!$this->session->has_userdata("admin_in")) {
			// set log-in error message
			$this->session->set_flashdata("login_alert", array("warning", "Please log-in first."));
			redirect("admin");
		}
	}

	public function view_a_login() {
		// check if user is already logged in, if yes return to dashboard
		if (!$this->session->has_userdata("admin_in")) {
			$head["title"] = "Login - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);

			$this->load->view("admin/a_login", $data);
		} else {
			redirect("admin/dashboard");
		}
	}
	public function view_a_dashboard() {
		$this->admin_login_check();

		$head["title"] = "Dashboard - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Dashboard", "link" => "dashboard"));

		$data["tbl_custom"] = $this->Model_read->get_orders_custom_w_date("ALL", date("Y-m"));
		$data["tbl_regular"] = $this->Model_read->get_orders_w_date("ALL", date("Y-m"));


		$data["custom_count_0"] = $this->Model_read->get_orders_custom("0")->num_rows();
		$data["regular_count_0"] = $this->Model_read->get_orders("0")->num_rows();
		$data["custom_count_1"] = $this->Model_read->get_orders_custom("1")->num_rows();
		$data["regular_count_1"] = $this->Model_read->get_orders("1")->num_rows();

		$this->load->view("admin/a_dashboard", $data);
	}
// = = = PRODUCTS
	public function view_a_products() {
		$this->admin_login_check();

		$head["title"] = "Products - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Products", "link" => "products"));

		$data["tbl_products"] = $this->Model_read->get_products();
		foreach ($this->Model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["name"];
		}

		$this->load->view("admin/a_products", $data);
	}
	public function view_a_products_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_product_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Product ID does not exist."));
			redirect("admin/products");
		} else {
			$head["title"] = "Products/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Products", "link" => "products"),
				array("text" => "View Product #". $id, "link" => "products_view?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();
			
			$type = $this->Model_read->get_type_wid($data["row_info"]["type_id"]);
			$data["row_info"]["type_name"] = ($type->num_rows() > 0 ? $type->row_array()["name"] : NULL);

			$this->load->view("admin/a_products_view", $data);
		}
	}
	public function view_a_products_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_product_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Product ID does not exist."));
			redirect("admin/products");
		} else {
			$head["title"] = "Products/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Products", "link" => "products"),
				array("text" => "View Product", "link" => "products_view?id=". $id),
				array("text" => "Edit Product #". $id, "link" => "products_edit?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();
			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["name"];
			}

			$this->load->view("admin/a_products_update", $data);
		}
	}
// = = = TYPES
	public function view_a_types() {
		$this->admin_login_check();

		$head["title"] = "Types - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Types", "link" => "types"));

		$data["tbl_types"] = $this->Model_read->get_types();

		$this->load->view("admin/a_types", $data);
	}
	public function view_a_types_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_type_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Type ID does not exist."));
			redirect("admin/types");
		} else {
			$head["title"] = "Types/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Types", "link" => "types"),
				array("text" => "View Type #". $id, "link" => "types_view?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_types_view", $data);
		}
	}
	public function view_a_types_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_type_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Type ID does not exist."));
			redirect("admin/types");
		} else {
			$head["title"] = "Types/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Types", "link" => "types"),
				array("text" => "View Type", "link" => "types_view?id=". $id),
				array("text" => "Edit Type #". $id, "link" => "types_edit?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_types_update", $data);
		}
	}
// = = = ORDERS
	public function view_a_orders() {
		$this->admin_login_check();

		$state = $this->input->get("state");

		$head["title"] = "Orders - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Orders", "link" => "orders"));

		$data["tbl_orders"] = $this->Model_read->get_orders(!is_null($state) ? $state : "ALL");
		$data["tbl_products"] = $this->Model_read->get_products_user();
		foreach ($this->Model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["name"];
		}

		$data["states"] = array(
			"PENDING", 
			"WAITING FOR PAYMENT", 
			"ACCEPTED / IN PROGRESS", 
			"TO SHIP",
			"SHIPPED", 
			"RECEIVED", 
			"CANCELLED"
		);

		$this->load->view("admin/a_orders", $data);
	}
	public function view_a_orders_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_order_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders");
		} else {
			$head["title"] = "Orders/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Orders", "link" => "orders"),
				array("text" => "View Order #". $id, "link" => "orders_view?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();
			$data["tbl_order_items"] = $this->Model_read->get_order_items_worder_id($id);

			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);
			
			$data["tbl_payments"] = $this->Model_read->get_all_order_payments_paid_worder_id($id);
			$data["tbl_payments_unpaid"] = $this->Model_read->get_order_payments_unpaid_worder_id($id);

			$this->load->view("admin/a_orders_view", $data);
		}
	}
	public function view_a_orders_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_order_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders");
		} else {
			$head["title"] = "Orders/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Orders", "link" => "orders"),
				array("text" => "View Order", "link" => "orders_view?id=". $id),
				array("text" => "Edit Order #". $id, "link" => "orders_edit?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();
			$data["tbl_order_items"] = $this->Model_read->get_order_items_worder_id($id);
			$data["tbl_products"] = $this->Model_read->get_products_user();
			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["name"];
			}

			$this->load->view("admin/a_orders_update", $data);
		}
	}
// = = = ORDERS CUSTOM
	public function view_a_orders_custom() {
		$this->admin_login_check();

		$state = $this->input->get("state");

		$head["title"] = "Custom Orders - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Custom Orders", "link" => "orders_custom"));

		$data["tbl_orders_custom"] = $this->Model_read->get_orders_custom(!is_null($state) ? $state : "ALL");
		foreach ($this->Model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["name"];
		}

		$data["states"] = array(
			"PENDING", 
			"WAITING FOR PAYMENT", 
			"ACCEPTED / IN PROGRESS", 
			"TO SHIP",
			"SHIPPED", 
			"RECEIVED", 
			"CANCELLED"
		);

		$this->load->view("admin/a_orders_custom", $data);
	}
	public function view_a_orders_custom_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_order_custom_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders_custom");
		} else {
			$head["title"] = "Custom Orders/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Custom Orders", "link" => "orders_custom"),
				array("text" => "View Custom Order #". $id, "link" => "orders_custom_view?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();
			$data["order_item_info"] = $this->Model_read->get_order_items_worder_id($data["row_info"]["order_id"])->row_array();
			$data["product_info"] = $this->Model_read->get_product_custom_wid($data["order_item_info"]["product_id"])->row_array();

			// $type = $this->Model_read->get_type_wid($data["product_info"]["type_id"]);
			// $data["product_info"]["type_name"] = ($type->num_rows() > 0 ? $type->row_array()["type"] : NULL);
			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["name"];
			}

			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);

			$data["tbl_payments"] = $this->Model_read->get_all_order_payments_paid_worder_id($id);
			$data["tbl_payments_unpaid"] = $this->Model_read->get_order_payments_unpaid_worder_id($id);

			$this->load->view("admin/a_orders_custom_view", $data);
		}
	}
	public function view_a_orders_custom_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_order_custom_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders_custom");
		} else {
			$head["title"] = "Custom Orders/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Custom Orders", "link" => "orders_custom"),
				array("text" => "View Custom Order", "link" => "orders_custom_view?id=". $id),
				array("text" => "Edit Custom Order #". $id, "link" => "orders_custom_edit?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();
			$data["order_item_info"] = $this->Model_read->get_order_items_worder_id($data["row_info"]["order_id"])->row_array();
			$data["product_info"] = $this->Model_read->get_product_custom_wid($data["order_item_info"]["product_id"])->row_array();
			foreach ($this->Model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["name"];
			}

			$this->load->view("admin/a_orders_custom_update", $data);
		}
	}
// = = = USERS
	public function view_a_users() {
		$this->admin_login_check();

		$head["title"] = "Users - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Users", "link" => "users"));

		$data["tbl_users"] = $this->Model_read->get_user_accounts();

		$this->load->view("admin/a_users", $data);
	}
	public function view_a_users_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_user_acc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			redirect("admin/users");
		} else {
			$head["title"] = "Users/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Users", "link" => "users"),
				array("text" => "View User #". $id, "link" => "users_view?id=". $id)
			);

			$data["tbl_orders"] = $this->Model_read->get_order_wuser_id($id, "ALL");

			$data["states"] = array(
				"PENDING", 
				"WAITING FOR PAYMENT", 
				"ACCEPTED / IN PROGRESS", 
				"TO SHIP",
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_users_view", $data);
		}
	}
	public function view_a_users_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_user_acc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			redirect("admin/users");
		} else {
			$head["title"] = "Users/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Users", "link" => "users"),
				array("text" => "View User", "link" => "users_view?id=". $id),
				array("text" => "Edit User #". $id, "link" => "users_edit?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_users_update", $data);
		}
	}
// = = = MESSAGING
	public function view_a_messaging() {
		$this->admin_login_check();

		$head["title"] = "Messaging - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Messaging", "link" => "messaging"));

		$data["tbl_messages"] = $this->Model_read->get_messages_conversations();

		$this->load->view("admin/a_messaging", $data);
	}
	public function view_a_messaging_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");
		$page = ($this->input->get("pg") ? $this->input->get("pg") : 0);

		$row_info = $this->Model_read->get_user_wacc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			redirect("admin/users");
		} else {
			$head["title"] = "Messaging/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Messaging", "link" => "messaging"),
				array("text" => "Message User #". $id, "link" => "messaging_view?id=". $id)
			);

			$data["tbl_messages_all"] = $this->Model_read->get_user_messages_all_wuser_id($id);

			$data["tbl_messages"] = $this->Model_read->get_user_messages_wuser_id($id, $page * 10);
			$data["tbl_page"] = $page;

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_messaging_view", $data);
		}
	}
// = = = ADMINS
	public function view_a_accounts() {
		$this->admin_login_check();

		$head["title"] = "Accounts - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Accounts", "link" => "accounts"));

		$data["tbl_accounts"] = $this->Model_read->get_adm_accounts();

		$this->load->view("admin/a_accounts", $data);
	}
	public function view_a_accounts_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_adm_acc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Admin ID does not exist."));
			redirect("admin/accounts");
		} else {
			$head["title"] = "Accounts/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Accounts", "link" => "accounts"),
				array("text" => "View Account #". $id, "link" => "accounts_view?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_accounts_view", $data);
		}
	}
	public function view_a_accounts_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->Model_read->get_adm_acc_wid($id);

		// if id of the account is non-existent, redirect to accounts page
		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Admin ID does not exist."));
			redirect("admin/accounts");
		} else {
			$head["title"] = "Accounts/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array(
				array("text" => "Accounts", "link" => "accounts"),
				array("text" => "View Account", "link" => "accounts_view?id=". $id),
				array("text" => "Edit Account #". $id, "link" => "accounts_edit?id=". $id)
			);

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_accounts_update", $data);
		}
	}
// = = = CONFIG
	public function view_a_config() {
		$this->admin_login_check();

		$head["title"] = "Config - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array(array("text" => "Config", "link" => "config"));

		$data["tbl_config"] = $this->Model_read->get_config();

		$this->load->view("admin/a_config", $data);
	}

	// UTILITY
	public function search_emails() {
		$this->admin_login_check();

		$search = $this->input->get("search");

		$result = $this->Model_read->search_user_emails($search)->result_array();

		$emails = array();
		foreach ($result as $row) {
			if ($row["email"] != NULL) {
				$emails[$row["user_id"]] = "[". $row["user_id"] ."] ". $row["email"] ." - ". $row["name_last"] .", ". $row["name_first"];
			}
		}

		echo json_encode($emails);
	}
	public function get_address() {
		$this->admin_login_check();

		$id = $this->input->get("user_id");

		if (strlen($id) > 0) {
			
			$result = $this->Model_read->get_user_address_wid($id)->row_array();

			echo json_encode($result);
		}
	}

	public function search_names() {
		$this->admin_login_check();

		$search = $this->input->get("search");

		$result = $this->Model_read->search_user_names($search)->result_array();

		$names = array();
		foreach ($result as $row) {
			if ($row["email"] == NULL) {
				$names[$row["user_id"]] = "[". $row["user_id"] ."] ". $row["name_last"] .", ". $row["name_first"] ." ". $row["name_middle"] ." ". $row["name_extension"];
			}
		}

		echo json_encode($names);
	}
	public function get_info() {
		$this->admin_login_check();

		$id = $this->input->get("user_id");

		if (strlen($id) > 0) {
			
			$result = $this->Model_read->get_user_info_wid($id)->row_array();

			echo json_encode($result);
		}
	}

	public function search_users() {
		$this->admin_login_check();

		$search = $this->input->get("search");

		$result = $this->Model_read->search_user_names($search)->result_array();

		$names = array();
		foreach ($result as $row) {
			$names[$row["user_id"]] = "[". $row["user_id"] ."] ". $row["name_last"] .", ". $row["name_first"] . ($row["name_middle"] != NULL ? " ". $row["name_middle"] : "") . ($row["name_extension"] != NULL ? " ". $row["name_extension"] : "") . ($row["email"] == NULL ? " (NO ACCOUNT)" : " (". $row["email"] .")");
		}

		echo json_encode($names);
	}
}