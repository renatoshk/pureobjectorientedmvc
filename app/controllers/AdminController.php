<?php
namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User;
/**
 * 
 */
class AdminController extends BaseController
{
	
	 public function __construct()
	{
	}
	public function index(){
		$data = [];
		$this->view('admin/dashboard', $data);
	}
}