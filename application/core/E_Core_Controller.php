<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class E_Core_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		// unset($_SESSION['alert']);
	}
}
