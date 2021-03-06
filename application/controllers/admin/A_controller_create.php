<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class A_controller_create extends E_Core_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_create");
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");

		date_default_timezone_set("Asia/Manila");
 	}

	// = = = PRODUCTS
	public function new_product() {
		$name = $this->input->post("inp_name");
		$type_id = $this->input->post("inp_type_id");
		$description = $this->input->post("inp_description");
		$price = $this->input->post("inp_price");

		if ($name == NULL || $type_id == NULL || $description == NULL || $price == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$img = NULL;

			$product_folder = "product_". (intval($this->db->count_all("products")) + 1);

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
				chmod("./uploads/products/". $product_folder, 0777);
			}

			if (isset($_FILES["inp_img"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
				} else {
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
				"type_id" => $type_id,
				"description" => $description,
				"price" => floatval($price),
				"type" => "NORMAL",
				"date_added" => date("Y-m-d H:i:s"),
				"visibility" => "0",
				"status" => "1"
			);
			if ($this->Model_create->create_product($data)) {
				$item_id = $this->db->insert_id();
				$this->session->set_flashdata("alert", array("success", "Product is successfully added."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products". (isset($item_id) ? "_view?id=". $item_id : ""));
	}
	// = = = TYPES
	public function new_type() {
		$name = $this->input->post("inp_name");
		$description = $this->input->post("inp_description");
		// $price_range = $this->input->post("inp_price_range");

		if ($name == NULL || $description == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$img = NULL;

			$type_folder = "type_". (intval($this->db->count_all("types")) + 1);

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
				chmod("./uploads/types/". $type_folder, 0777);
			}

			if (isset($_FILES["inp_img"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
				} else {
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
				"description" => $description,
				// "price_range" => $price_range,
				"featured" => "0",
				"status" => "1"
			);
			if ($this->Model_create->create_type($data)) {
				$item_id = $this->db->insert_id();
				$this->session->set_flashdata("alert", array("success", "Type is successfully added."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/types". (isset($item_id) ? "_view?id=". $item_id : ""));
	}
	// = = = ORDERS
	public function new_order() {
		
		include('application/libraries/phpqrcode/qrlib.php');
		
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
			$prd_price = $this->input->post("item_". $i ."_price");
			$prd_qty = $this->input->post("item_". $i ."_qty");

			if ($prd_id != NULL && $prd_price != NULL) {
				$items[] = array(
					"product_id" => $prd_id,
					"price" => $prd_price,
					"qty" => $prd_qty
				);
			}
		}

		if ($user_id == NULL || count($items) < 1) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user = $this->Model_read->get_user_acc_wid($user_id);
			if ($user->num_rows() < 1 && $user_id != 0) {
				$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			} else {
				$total_qty = 0;
				foreach ($items as $row) { // check if qty is enough
					$p_details = $this->Model_read->get_product_wid_user($id)->row_array();
					$total_qty = $p_details["qty"] - $qty;
					if ($total_qty < 0) {
						$unstocked_product = $p_details["name"];
						break;
					}
				}

				if ($total_qty < 0) {
					$this->session->set_flashdata("alert", array("danger", $unstocked_product ." does not have enough stock. [Available: ". $p_details['qty'] ."]"));
				} else {

				}




				$error = NULL;
				if ($user_id == 0) {
					$name_last = $this->input->post("inp_name_last");
					$name_first = $this->input->post("inp_name_first");
					$name_middle = $this->input->post("inp_name_middle");
					$name_extension = $this->input->post("inp_name_extension");
					$gender = $this->input->post("inp_gender");
					$contact_num = $this->input->post("inp_contact_num");

					// $zip_code = $this->input->post("inp_zip_code");
					// $country = $this->input->post("inp_country");
					// $province = $this->input->post("inp_province");
					// $city = $this->input->post("inp_city");
					// $street = $this->input->post("inp_street");
					// $address = $this->input->post("inp_address");

					if ($name_last == NULL || $name_first == NULL || $gender == NULL || $contact_num == NULL) {
						$error = "One or more inputs are empty.";
					} else {
						do {
							$uid = uniqid('', true);
						} while ($this->Model_read->get_user_acc_wuid($uid)->num_rows() > 0);

						$data = array(
							"user_uid" => $uid,

							"name_last" => $name_last,
							"name_first" => $name_first,
							"name_middle" => $name_middle,
							"name_extension" => $name_extension,
							"gender" => $gender,
							"contact_num" => $contact_num,

							// "zip_code" => $zip_code,
							// "country" => $country,
							// "province" => $province,
							// "city" => $city,
							// "street" => $street,
							// "address" => $address,

							"status" => "1"
						);
						if ($this->Model_create->create_user_account($data)) {
							$user_id = $this->db->insert_id();
						} else {
							$error = "Something went wrong, please try again.";
						}
					}
				}
				if ($error == NULL) {
					// generate unique id
					do {
						$ouid = uniqid('', true);
					} while ($this->Model_read->get_order_all_w_ouid($ouid)->num_rows() > 0);

					// make directories
					if (!is_dir("uploads")) {
						mkdir("./uploads", 0755, TRUE);
					}
					if (!is_dir("uploads/orders")) {
						mkdir("./uploads/orders", 0755, TRUE);
					}

					// make file path
					$file_name = $ouid .'.png';
					$file_path = 'uploads/orders/'. $file_name;
					$qr_link = base_url() .'order?ouid='. $ouid;

					$data = array(
						"order_uid" => $ouid,
						
						"user_id" => $user_id,
						"description" => $description,
						"date_time" => $date ." ". $time,
						// "zip_code" => $zip_code,
						// "country" => $country,
						// "province" => $province,
						// "city" => $city,
						// "street" => $street,
						// "address" => $address,

						"img_qr" => $file_name,

						"state" => "0",
						"status" => "1"
					);
					if ($this->Model_create->create_order($data)) {
						$item_id = $this->db->insert_id();

						// generating
						if (!file_exists($file_path)) {
							QRcode::png($qr_link, $file_path, QR_ECLEVEL_L, 6, 4);
						}

						foreach ($items as $row) {
							$product_info = $this->Model_read->get_product_wid($row["product_id"])->row_array();
							$data_product["qty"] = $product_info["qty"] - $row["qty"];
							$this->Model_update->update_product($row["product_id"], $data_product);

							$row["order_id"] = $item_id;
							$row["type"] = "PICKUP";
							$this->Model_create->create_order_item($row);
						}

						$this->session->set_flashdata("alert", array("success", "Order is successfully added."));
					} else {
						$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					}
				} else {
					$this->session->set_flashdata("alert", array("danger", $error));
				}
			}
		}
		redirect("admin/orders". (isset($item_id) ? "_view?id=". $item_id : ""));
	}
	// = = = ORDERS BOTH
	public function new_order_payment() {
		$order_id = $this->input->post("inp_id");
		$description = $this->input->post("inp_description");
		$date = $this->input->post("inp_date");
		$time = $this->input->post("inp_time");
		$amount = $this->input->post("inp_amount");

		if ($order_id == NULL || $date == NULL  || $time == NULL || $amount == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$order = $this->Model_read->get_order_general_wid($order_id);

			if ($order->num_rows() > 0) {
				$order_info = $order->row_array();
				$img = NULL;

				$user_folder = "user_". $order_info["user_id"];
				$payment_folder = "order_". $order_id;

				$config["upload_path"] = "./uploads/users/". $user_folder ."/payments/". $payment_folder;
				$config["allowed_types"] = "gif|jpg|jpeg|png";
				$config["max_size"] = 5000;
				$config["encrypt_name"] = TRUE;

				$this->load->library("upload", $config);
				if (!is_dir("uploads/users/". $user_folder)) {
					mkdir("./uploads/users/". $user_folder, 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder ."/payments")) {
					mkdir("./uploads/users/". $user_folder ."/payments", 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder ."/payments/". $payment_folder)) {
					mkdir("./uploads/users/". $user_folder ."/payments/". $payment_folder, 0777, TRUE);
				}

				if (isset($_FILES["inp_img_proof"])) {
					if (!$this->upload->do_upload("inp_img_proof")) {
						$this->session->set_flashdata("notice", array("warning", $this->upload->display_errors()));
					} else {
						$img = $this->upload->data("file_name");
					}
				}

				$data = array(
					"order_id" => $order_id,
					"description" => $description,
					"img" => $img,
					"date_time" => $date ." ". $time,
					"amount" => $amount,
					"type" => "0",
					"status" => "1"
				);

				if ($this->Model_create->create_order_payment($data)) {
					$this->session->set_flashdata("alert", array("success", "Order Payment is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again." ));
			}
		}
		if ($this->input->post("payment_submit") == "Submit Payment for Order") {
			redirect("admin/orders". (isset($order_id) ? "_view?id=". $order_id : ""));
		} else {
			redirect("admin/orders_custom". (isset($order_id) ? "_view?id=". $order_id : ""));
		}
	}
	public function new_order_payment_tbp() {
		$order_id = $this->input->post("inp_id");
		$description = $this->input->post("inp_description");
		$amount = $this->input->post("inp_amount");

		if ($order_id == NULL || $amount == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$order = $this->Model_read->get_order_general_wid($order_id);

			if ($order->num_rows() > 0) {
				$order_info = $order->row_array();

				$data = array(
					"order_id" => $order_id,
					"description" => $description,
					"amount" => $amount,
					"type" => "1",
					"status" => "0"
				);

				if ($this->Model_create->create_order_payment($data)) {
					$this->session->set_flashdata("alert", array("success", "TBP Order Payment is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again." ));
			}
		}
		if ($this->input->post("payment_submit") == "Submit Payment for Order") {
			redirect("admin/orders". (isset($order_id) ? "_view?id=". $order_id : ""));
		} else {
			redirect("admin/orders_custom". (isset($order_id) ? "_view?id=". $order_id : ""));
		}
	}
	// = = = USERS
	public function new_user_account() {
		$name_last = $this->input->post("inp_name_last");
		$name_first = $this->input->post("inp_name_first");
		$name_middle = $this->input->post("inp_name_middle");
		$name_extension = $this->input->post("inp_name_extension");

		$gender = $this->input->post("inp_gender");
		$email = $this->input->post("inp_email");
		$contact_num = $this->input->post("inp_contact_num");

		// $zip_code = $this->input->post("inp_zip_code");
		// $country = $this->input->post("inp_country");
		// $province = $this->input->post("inp_province");
		// $city = $this->input->post("inp_city");
		// $street = $this->input->post("inp_street");
		// $address = $this->input->post("inp_address");

		$password = $this->input->post("inp_password");

		if ($name_last == NULL || $name_first == NULL || $gender == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			if ($email == NULL || $password == NULL) {
				$new_email = NULL;
				$new_password = NULL;
			} else {
				$new_email = $email;
				$new_password = password_hash($password, PASSWORD_BCRYPT);
			}
			if ($this->Model_read->get_user_acc_wemail($new_email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email is aready registered."));
			} else {
				do {
					$uid = uniqid('', true);
				} while ($this->Model_read->get_user_acc_wuid($uid)->num_rows() > 0);

				$data = array(
					"user_uid" => $uid,
					
					"email" => $new_email,
					"password" => $new_password,

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

					"contact_num" => $contact_num,

					"status" => "1"
				);
				if ($this->Model_create->create_user_account($data)) {
					$item_id = $this->db->insert_id();
					$this->session->set_flashdata("alert", array("success", "User is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/users". (isset($item_id) ? "_view?id=". $item_id : ""));
	}
	// = = = ADMINS
	public function new_admin_account() {
		$name = $this->input->post("inp_name");
		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($name == NULL || $email == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->Model_read->get_adm_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been registered."));
			} else {
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT),
					"status" => "1"
				);
				if ($this->Model_create->create_adm_account($data)) {
					$item_id = $this->db->insert_id();
					$this->session->set_flashdata("alert", array("success", "Account is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/accounts". (isset($item_id) ? "_view?id=". $item_id : ""));
	}
	// = = = MESSAGES
	public function new_message_admin() {
		$user_id = $this->input->post("inp_user_id");
		$admin_id = $this->session->userdata("admin_id");
		$message = $this->input->post("inp_message");

		if ($user_id == NULL || $admin_id == NULL || $message == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user = $this->Model_read->get_user_wacc_wid($user_id);
			if ($user->num_rows() < 1 && $user_id != 0) {
				$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			} else {
				if ($this->Model_create->message_user($user_id, $admin_id, $message, date("Y-m-d H:i:s"))) {
					$this->session->set_flashdata("alert", array("success", "Message is successfully sent."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/messaging". (isset($user_id) ? "_view?id=". $user_id : ""));
	}
}