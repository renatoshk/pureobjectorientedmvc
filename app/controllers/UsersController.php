<?php
namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User;
/**
 * 
 */
class UsersController extends BaseController
{
	
	public function __construct()
	{
		$this->userModel = new User();
	
	}
	public function register(){
		//check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//process form
		//sanitize form data
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		//init data	
		$data = [
			    'title'=>'Register', 
				'name' =>trim($_POST['name']),
				'email' =>trim($_POST['email']),
				'password'=>trim($_POST['password']),
				'confirm_password'=>trim($_POST['confirm_password']),
				'name_err'=>'',
				'email_err'=>'',
				'password_err'=>'',
				'confirm_password_err'=>''
		   	];
		   //validate email
			if(empty($data['email'])){
				$data['email_err'] = 'Please enter an email';
			}
			else {
				if($this->userModel->findUserByEmail($data['email'])){
                  $data['email_err'] = 'Email is already taken';
				}
			}
			//validate name
			if(empty($data['name'])){
				$data['name_err'] = 'Please enter an name';
			}
			//validate password
			if(empty($data['password'])){
				$data['password_err'] = 'Please enter an password';
			}elseif (strlen($data['password'])<6) {
				$data['password_err'] = 'Your password is short';
			}
			//validate confirm password
			if(empty($data['confirm_password'])){
				$data['confirm_password_err'] = 'Please enter an password';
			}elseif($data['confirm_password'] !== $data['password']){
				$data['confirm_password_err'] = 'Your password is not the same';
			}
			//make sure errors are empty
			if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ){
				//hash password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
				//register user
				unset($data['title']);
				if($this->userModel->register($data)){
				   flash('register_success', 'You are registered successfully');
				   redirect('users/login');	
				}else{
					die('Something is wrong');
				}	
			}
			else {
				//load view with errors handle
				$this->view('users/register', $data);
			}			
		}			
		else {
			//init data
			$data = [
				'title'=>'Register',
				'name' =>'',
				'email' =>'',
				'password'=>'',
				'confirm_password'=>'',
				'name_err'=>'',
				'email_err'=>'',
				'password_err'=>'',
				'confirm_password_err'=>''
			];
			//load form
		    if(!isLoggedIn()){
			  $this->view('users/register', $data);
		    }
		    else{
		      redirect('');
		    }
		}
	}
    public function login(){
		//check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//process form
		//sanitize form data
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		//init data	
		$data = [
			    'title'=>'Login', 
				'email' =>trim($_POST['email']),
				'password'=>trim($_POST['password']),
				'email_err'=>'',
				'password_err'=>'',
		   	];
		   	 //validate email
			if(empty($data['email'])){
				$data['email_err'] = 'Please enter an email';
			}
			//validate password
			if(empty($data['password'])){
				$data['password_err'] = 'Please enter an password';
			}
			//check for user/email in db
			if($this->userModel->findUserByEmail($data['email'])){
				//user found
			}else{
				//user not found
				$data['email_err'] = 'No user found';
			}
			//make sure errors are empty
			if(empty($data['email_err']) && empty($data['password_err'])){
				$loggedIn = $this->userModel->login($data['email'], $data['password']);
				if($loggedIn){
					//create session
					$this->createUserSession($loggedIn);
					die('success');
				}else{
					$data['password_err'] = 'Password Incorrect';
					$this->view('users/login', $data);
				}
			}
			else {
				//load view with errors handle
				$this->view('users/login', $data);
			}
		}
		else {
			//init data
			$data = [
				'title'=>'Login',
				'email' =>'',
				'password'=>'',
				'email_err'=>'',
				'password_err'=>'',
			];
			//load form
		 if(!isLoggedIn()){
			$this->view('users/login', $data);
		   }
		   else {
		   	redirect('');
		   }	
		}
	}
	public function createUserSession($user){
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_role'] = $user->role_id;
		redirect('posts');		
	}
	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_role']);
		session_destroy();
		redirect('users/login');
	}
}

