<?php 
namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User;
/**
 * 
 */
class RolesController extends BaseController
{
	
	function __construct()
	{
		$this->userModel = new User();
	}
	//show roles function
	public function index(){
		$roleId = $_SESSION['user_role'];
		$roleAdmin = $this->userModel->isAdmin($roleId);
		if($roleAdmin){
		   $roles = $this->userModel->getRoles();
		   $data = [
		   	'roles'=>$roles
		   ];
		   return $this->view('admin/roles/index', $data);
		}else{
			redirect('posts');
		}
	}
	//add roles function
	public function add(){
		$data = [];
		$roleId = $_SESSION['user_role'];
		$roleAdmin = $this->userModel->isAdmin($roleId);
		if($roleAdmin){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
			   $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			   $data = [
			   	  'role'=>$_POST['role'],
			   	  'roleErr'=>''
			   ];
			    //validate role
			   if(empty($data['role'])){
			   	  $data['roleErr'] = 'Role cannot be empty';
			   }
			   //proccess if errors are empty
			   if(empty($data['roleErr'])){
                 $addRoles = $this->userModel->addRoles($data['role']);
                 if($addRoles){
                    echo json_encode(['code'=>200, 'msg'=>'Role added Successfully']);
                 }else{
					redirect('roles');
                 }
			   }else{
			     echo json_encode(['code'=>404, 'msg'=>$data['roleErr']]);
			   }
	        }else{
	        	$data = [
	        		'role'=>'', 
	        		'roleErr'=>''
	        	];
	        	return $this->view('admin/roles/add', $data);
	        }
		}else{
			redirect('posts');
		}
	}
	//edit roles function
	public function edit($id){
	        $role = $this->userModel->getRoleById($id);
	        $roleId = $_SESSION['user_role'];
	        $roleAdmin = $this->userModel->isAdmin($roleId);
	     if($roleAdmin){
	       if($role){
			  if($_SERVER['REQUEST_METHOD'] == 'POST'){
			 	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			 	$data = [
			 		'id'=>$id,
			 		'role'=>$_POST['role'],
			 		'roleErr'=>''
			 	];

			 	if(empty($data['role'])){
	              $data['roleErr'] = 'Role Field cannot be empty!'; 
			 	}
			 	if($data['role'] == $role->name){
			 	  $data['roleErr'] = "You didn't made any changes";	
			 	}
			 	if(empty($data['roleErr'])){
			 		$updateRoles = $this->userModel->updateRole($data['id'], $data['role']);
			 		if($updateRoles){
			 			echo json_encode(['code'=>200, 'msg'=>'Role updated Successfully']);
			 		}else{
			 			 redirect('posts');
			 		}
			 	}
			 	else{
			 		echo json_encode(['code'=>404, 'msg'=>$data['roleErr']]);
			 	}
			 }else{
		         $data = [
		         	'id'=>$id,
		         	'role'=>$role->name,
		         	'roleErr'=>''
		         ];
		         $this->view('admin/roles/edit', $data);
			    }
	       } 
	       else{
	       	redirect('roles');
	       }  
		}else{
		     	redirect('posts');
		}
   }
   //delete roles function
   public function delete($id){
   	     $role = $this->userModel->getRoleById($id);
	     $roleId = $_SESSION['user_role'];
	     $roleAdmin = $this->userModel->isAdmin($roleId);
	     if($roleAdmin){
	     	if($role){
	     	   if($_SERVER['REQUEST_METHOD'] == 'POST'){
			      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			      $roleId = $_POST['id'];
			      $deleteRole = $this->userModel->deleteRole($roleId);
			      if($deleteRole){
                     echo json_encode(['code'=>200, 'msg'=>'Role deleted Successfully']);
			      }else{
			      	redirect('roles');
			      }
			   }
	     	}
	     	else{
	     		redirect('roles');
	     	}
	     }else{
	     	redirect('posts');
	     }

   }
}

 ?>