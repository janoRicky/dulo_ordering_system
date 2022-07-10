<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class A_controller_update extends E_Core_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_create");
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");
 		$this->load->model("Model_delete");

		date_default_timezone_set("Asia/Manila");

		$this->load->library("email", array(
			"protocol" => "smtp",
			"smtp_host" => "ssl://mail.bytemerchant.info",
			"smtp_port" => 465,
			"smtp_user" => $this->Model_read->get_config_wkey("smtp_user"), 
			"smtp_pass" => $this->Model_read->get_config_wkey("smtp_pass"),
			"mailtype" => "html"
		));
 	}

	// = = = PRODUCTS
	public function edit_product() {
		$product_id = $this->input->post("inp_id");
		$name = $this->input->post("inp_name");
		$type_id = $this->input->post("inp_type_id");
		$description = $this->input->post("inp_description");
		$price = $this->input->post("inp_price");

		if ($product_id == NULL || $name == NULL || $type_id == NULL || $description == NULL || $price == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$row_info = $this->Model_read->get_product_wid($product_id)->row_array();

			$img = $row_info["img"];

			$product_folder = "product_". $product_id;

			$config["upload_path"] = "./uploads/products/". $product_folder;
			$config["allowed_types"] = "gif|jpg|jpeg|png";
			$config["max_size"] = 5000;
			$config["encrypt_name"] = TRUE;

			$this->load->library("upload", $config);
			if (!is_dir("uploads")) {
				mkdir("./uploads", 0777, TRUE);
			}
			if (!is_dir("uploads/products")) {
				mkdir("./uploads/products", 0777, TRUE);
			}
			if (!is_dir("uploads/products/". $product_folder)) {
				mkdir("./uploads/products/". $product_folder, 0777, TRUE);
			}

			if (!empty($_FILES["inp_img"]["name"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
					redirect("admin/products");
				} else {
				    if (isset($row_info["img"]) && !is_null($row_info["img"]) && $row_info["img"] != "") {
				        unlink("./uploads/products/". $product_folder ."/". $row_info["img"]);
				    }
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
				"type_id" => $type_id,
				"description" => $description,
				"price" => $price,
				// "qty" => $qty
			);

			if ($this->Model_update->update_product($product_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Product info is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products". (isset($product_id) ? "_view?id=". $product_id : ""));
	}
	public function edit_product_featured() {
		$product_id = $this->input->post("inp_id");
		// $featured_no = $this->input->post("inp_featured_no");
		$submit = $this->input->post("inp_submit");

		if ($product_id == NULL || $submit == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$featured = ($submit == "Unfeature" ? 0 : 1);
			$data = array(
				"featured" => $featured
			);
			// $data = array(
			// 	"featured" => $featured_no
			// );
			// $featured_prev = $this->Model_read->get_product_featured_wno($featured_no)->row_array();
			// $data_prev = array(
			// 	"featured" => NULL
			// );

			// if ($this->Model_update->update_product($featured_prev["product_id"], $data_prev) && $this->Model_update->update_product($product_id, $data)) {
			if ($this->Model_update->update_product($product_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Product featured is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products");
	}
	public function edit_product_visibility() {
		$product_id = $this->input->post("inp_id");
		$submit = $this->input->post("inp_submit");

		if ($product_id == NULL || $submit == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$visibility = ($submit == "Set to Invisible" ? 0 : 1);
			$data = array(
				"visibility" => $visibility
			);

			if ($this->Model_update->update_product($product_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Product visibility is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products");
	}
	public function edit_product_qty() {
		$product_id = $this->input->post("inp_id_upd");
		$qty = $this->input->post("inp_qty_upd");

		if ($product_id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$row_info = $this->Model_read->get_product_wid($product_id)->row_array();

			$data = array(
				"qty" => $qty
			);

			if ($this->Model_update->update_product($product_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Product qty is successfully updated."));
				redirect("admin/products");
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products". (isset($product_id) ? "_view?id=". $product_id : ""));
	}
	// = = = TYPES
	public function edit_type() {
		$type_id = $this->input->post("inp_id");
		$name = $this->input->post("inp_name");
		$description = $this->input->post("inp_description");
		// $price_range = $this->input->post("inp_price_range");

		if ($name == NULL || $description == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {

			$row_info = $this->Model_read->get_type_wid($type_id)->row_array();

			$img = $row_info["img"];

			$type_folder = "type_". $type_id;

			$config["upload_path"] = "./uploads/types/". $type_folder;
			$config["allowed_types"] = "gif|jpg|jpeg|png";
			$config["max_size"] = 5000;
			$config["encrypt_name"] = TRUE;

			$this->load->library("upload", $config);

			if (!is_dir("uploads")) {
				mkdir("./uploads", 0777, TRUE);
			}
			if (!is_dir("uploads/types")) {
				mkdir("./uploads/types", 0777, TRUE);
			}
			if (!is_dir("uploads/types/". $type_folder)) {
				mkdir("./uploads/types/". $type_folder, 0777, TRUE);
			}

			if (!empty($_FILES["inp_img"]["name"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
					redirect("admin/types");
				} else {
					unlink("./assets/img/featured/". $type_folder ."/". $row_info["img"]);
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
				"description" => $description,
				"price_range" => $price_range
			);
			if ($this->Model_update->update_type($type_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Type info is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/types". (isset($type_id) ? "_view?id=". $type_id : ""));
	}
	public function edit_type_featured() {
		$type_id = $this->input->post("inp_id");
		$submit = $this->input->post("inp_submit");

		if ($type_id == NULL || $submit == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$featured = ($submit == "Unfeature" ? 0 : 1);
			$data = array(
				"featured" => $featured
			);

			if ($this->Model_update->update_type($type_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Type featured is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/types");
	}
	// = = = ORDERS
	public function edit_order() {
		$order_id = $this->input->post("inp_id");
		$user_id = $this->input->post("inp_user_id");

		$description = $this->input->post("inp_description");
		$date = $this->input->post("inp_date");
		$time = $this->input->post("inp_time");

		// $zip_code = $this->input->post("inp_zip_code");
		// $country = $this->input->post("inp_country");
		// $province = $this->input->post("inp_province");
		// $city = $this->input->post("inp_city");
		// $street = $this->input->post("inp_street");
		// $address = $this->input->post("inp_address");

		$items_no = $this->input->post("items_no");
		$items = array();

		for ($i = 1; $i < $items_no + 1; $i++) {
			$prd_id = $this->input->post("item_". $i ."_id");
			$prd_qty = $this->input->post("item_". $i ."_qty");
			$prd_price = $this->input->post("item_". $i ."_price");

			if ($prd_id != NULL && $prd_qty != NULL && $prd_price != NULL) {
				$items[] = array(
					"product_id" => $prd_id,
					"qty" => $prd_qty,
					"price" => $prd_price
				);
			}
		}

		if ($order_id == NULL || $user_id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user = $this->Model_read->get_user_acc_wid($user_id);
			if ($user->num_rows() < 1 && $user_id != 0) {
				$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			} else {
				$data = array(
					"user_id" => $user_id,
					"description" => $description,
					"date_time" => $date ." ". $time,
					// "zip_code" => $zip_code,
					// "country" => $country,
					// "province" => $province,
					// "city" => $city,
					// "street" => $street,
					// "address" => $address
				);
				if ($this->Model_update->update_order($order_id, $data)) {

					$order_items = $this->Model_read->get_order_items_worder_id($order_id);
					foreach ($order_items->result_array() as $row) { // restore stock before deleting order
						$product_info = $this->Model_read->get_product_wid($row["product_id"])->row_array();
						$data_product["qty"] = $product_info["qty"] + $row["qty"];
						$this->Model_update->update_product($row["product_id"], $data_product);
					}
					$this->Model_delete->delete_order_item_worder_id($order_id);

					foreach ($items as $row) {
						$product_info = $this->Model_read->get_product_wid($row["product_id"])->row_array();
						$data_product["qty"] = $product_info["qty"] - $row["qty"];
						$this->Model_update->update_product($row["product_id"], $data_product);

						$row["order_id"] = $order_id;
						$row["type"] = "PICKUP";
						$this->Model_create->create_order_item($row);
					}

					$this->session->set_flashdata("alert", array("success", "Order is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders". (isset($order_id) ? "_view?id=". $order_id : ""));
	}
	public function edit_order_state() {
		$order_id = $this->input->post("inp_id");
		$state = $this->input->post("inp_state");

		$send_email = $this->input->post("inp_send_email");

		if ($order_id == NULL || $state == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$order = $this->Model_read->get_order_wid($order_id);

			if ($order->num_rows() > 0) {

				$data = array(
					"state" => $state
				);
				if ($this->Model_update->update_order($order_id, $data)) {

					if ($send_email == 'on') {
						$order_info = $order->row_array();
						$user = $this->Model_read->get_user_acc_wid($order_info['user_id']);

						if ($user->num_rows() > 0) {
							$user_info = $user->row_array();

							$states = array(
								"PENDING", 
								"ACCEPTED", 
								"COMPLETED", 
								"CANCELLED"
							);

							$this->email->set_newline("\r\n");
							$this->email->clear();
							$this->email->from($this->Model_read->get_config_wkey("mail_sender"));
							$this->email->to($user_info['email']);
							$this->email->subject("Your Order - Dulo Ordering System");
							$this->email->message(
								'<div style="width: 100%; background-color: #fff;">
									<div style="width: auto; background-color: #000; padding: 2rem 1rem 0 2rem;">
										<div style="width: 80%; max-width: 250px; margin: 0 auto;">
											<img style="width: 100%;" src="'. base_url("assets/img/dulo-logo.png") .'">
										</div>
									</div>
									<div style="width: auto; background-color: #000; padding: 2rem; text-align: center; color: #fff; padding-bottom: 3rem;">
										<h2>THE STATE OF YOUR ORDER HAS BEEN UPDATED!</h2>
										<p>The state of your order that is due for pickup on '. date('Y-m-d h:i A', strtotime($order_info['datetime_pickup'])) .' has been updated to '. $states[$state] .'.</p>
										<div style="width: 100%; margin: 3rem 0;">
											<a href="'. base_url("my_order_details?id=". $order_info["order_id"]) .'" style="border-radius: 1rem; border-radius: 50rem; background-color: #fff; padding: 1rem 2rem; text-decoration: none; color: #000;">
												<span style="font-weight: bold;">View Order</span>
											</a>
										</div>
									</div>
								</div>'
							);
							$this->email->send();
						}
					}


					$this->session->set_flashdata("alert", array("success", "State is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again.[0]"));
				}
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again.[1]"));
			}
			redirect("admin/orders". (isset($order_id) ? "_view?id=". $order_id : ""));
		}
		redirect("admin/orders");
	}
	// = = = ORDERS BOTH
	public function edit_order_payment() {
		$order_id = $this->input->post("inp_id");
		$payment_id = $this->input->post("inp_payment_id");
		$description = $this->input->post("inp_description");
		$date = $this->input->post("inp_date");
		$time = $this->input->post("inp_time");
		$amount = $this->input->post("inp_amount");

		if ($order_id == NULL || $payment_id == NULL || $date == NULL  || $time == NULL || $amount == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$payment = $this->Model_read->get_order_payment_wid($payment_id);
			if ($payment->num_rows() > 0) {
				$payment_info = $payment->row_array();
				if ($payment_info["order_id"] == $order_id) {
					$data = array(
						"description" => $description,
						"date_time" => $date ." ". $time,
						"amount" => $amount
					);

					if ($this->Model_update->update_order_payment($payment_id, $data)) {
						$this->session->set_flashdata("alert", array("success", "Order Payment is successfully updated."));
					} else {
						$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again.1"));
					}
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again.2"));
				}
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again.3"));
			}
		}
		if ($this->input->post("payment_submit") == "Update Payment for Order") {
			redirect("admin/orders". (isset($order_id) ? "_view?id=". $order_id : ""));
		} else {
			redirect("admin/orders_custom". (isset($order_id) ? "_view?id=". $order_id : ""));
		}
	}
	// = = = USERS
	public function edit_user_account() {
		$user_id = $this->input->post("inp_id");

		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		$name_last = $this->input->post("inp_name_last");
		$name_first = $this->input->post("inp_name_first");
		$name_middle = $this->input->post("inp_name_middle");
		$name_extension = $this->input->post("inp_name_extension");
		$gender = $this->input->post("inp_gender");

		// $zip_code = $this->input->post("inp_zip_code");
		// $country = $this->input->post("inp_country");
		// $province = $this->input->post("inp_province");
		// $city = $this->input->post("inp_city");
		// $street = $this->input->post("inp_street");
		// $address = $this->input->post("inp_address");

		$contact_num = $this->input->post("inp_contact_num");


		if ($user_id == NULL || $name_last == NULL || $name_first == NULL || $gender == NULL || $contact_num == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user_info = $this->Model_read->get_user_acc_wid($user_id)->row_array();
			if ($user_info["email"] != NULL && $this->Model_read->get_user_acc_wemail($email)->num_rows() > 0 && $user_info["email"] != $email) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} elseif ($user_info["email"] != NULL && $email == NULL) {
				$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
			} else {
				$data = array(
					"name_last" => $name_last,
					"name_first" => $name_first,
					"name_middle" => $name_middle,
					"name_extension" => $name_extension,
					"gender" => $gender,

					// "zip_code" => $zip_code,
					// "country" => $country,
					// "province" => $province,
					// "city" => $city,
					// "street" => $street,
					// "address" => $address,
					
					"contact_num" => $contact_num
				);
				if ($user_info["email"] != NULL) {
					$data["email"] = $email;
				} 
				if ($user_info["password"] != NULL && $password != NULL) {
					$data["password"] = password_hash($password, PASSWORD_BCRYPT);
				} 

				if ($this->Model_update->update_user_account($user_id, $data)) {
					$this->session->set_flashdata("alert", array("success", "Account info is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/users". (isset($user_id) ? "_view?id=". $user_id : ""));
	}
	// = = = ADMINS
	public function edit_admin_account() {
		$admin_id = $this->input->post("inp_id");
		$name = $this->input->post("inp_name");
		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($admin_id == NULL || $name == NULL || $email == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			// if email is already used and if the previous email is not the same with new email, show error
			$acc_info = $this->Model_read->get_adm_acc_wid($admin_id)->row_array();
			if ($this->Model_read->get_adm_acc_wemail($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				// set values to be updated on the database table
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT)
				);
				if ($this->Model_update->update_adm_account($admin_id, $data)) {
					// update admin info
					if ($this->session->has_userdata("admin_email") && $this->session->userdata("admin_id") == $admin_id) {
						$data = array(
							"admin_name" => $name,
							"admin_email" => $email
						);
						$this->session->set_userdata($data);
					}
					$this->session->set_flashdata("alert", array("success", "Account info is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/accounts". (isset($admin_id) ? "_view?id=". $admin_id : ""));
	}
	// = = = CONFIG
	public function edit_config() {
		$configs = $this->Model_read->get_config()->result_array();

		foreach ($configs as $row) {
			$val_new = $this->input->post("inp_". $row["c_key"]);

			if ($val_new == NULL) {
				$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
				break;
			} else {
				$data = array(
					"c_val" => $val_new
				);
				if ($this->Model_update->update_config_wkey($row["c_key"], $data)) {
					$this->session->set_flashdata("alert", array("success", "Config is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}

		redirect("admin/config");
	}
}