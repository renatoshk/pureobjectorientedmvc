<?php 
namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User;

/**
 * 
 */
class PagesController extends BaseController
{
	
	public function __construct()
	{
	}
	public function index(){
		$data = [
			'title'=>'Welcome',
		];
		$this->view('pages/index', $data);
	}
	public function about(){
		$data = [
			'title'=>'About Us'
		];
		$this->view('pages/about', $data);
	}
}
