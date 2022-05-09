<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_delete extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 		$this->load->model("Model_delete");
 	}
}