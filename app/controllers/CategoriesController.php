<?php 
namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User; 
use App\Models\Category;
/**
 * 
 */
class CategoriesController extends BaseController
{
	
	function __construct()
	{
		$this->category = new Category();
		$this->userModel = new User();
	}
	public function index(){
		$data = [];
		$roleId = $_SESSION['user_role'];
		$roleAdmin = $this->userModel->isAdmin($roleId);
		if($roleAdmin){
			$categories = $this->category->getCategories();
			$data = [
				'categories'=>$categories,
			];
			return $this->view('admin/categories/index', $data);
		}else{
			redirect('posts');
		}
	}
	public function add(){
		$data= [];
		$roleId = $_SESSION['user_role'];
		$roleAdmin = $this->userModel->isAdmin($roleId);
		if($roleAdmin){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'parent'=>trim($_POST['parent']),
					'name'=>trim($_POST['name']),
					'status'=>trim($_POST['status']),
					'icon'=>trim($_POST['icon']),
					'date'=>$_POST['date'],
					'nameErr'=>'',
					'statusErr'=>'',
					'dateErr'=>'',
				];
				if(empty($data['name'])){
					$data['nameErr'] = 'You must add category name!';
				}
				if(empty($data['status'])){
					$data['status'] = 'You must add status for category!';
				}
				if(empty($data['date'])){
					$data['dateErr'] = 'You must add date for category!';
				}
				if(empty($data['nameErr']) && empty($data['statusErr']) && empty($data['dateErr'])){
					$newCategoryAdd = $this->category->addCategory($data);
					if($newCategoryAdd){
						echo json_encode(['code'=>200, 'msg'=>'Category added successfully']);
					}else{
						redirect('categories');
					}
				}else{
					echo json_encode([
						'code'=>404, 
						'msg'=> [
							'nameErr'=>$data['nameErr'],
							'statusErr'=>$data['statusErr'],
							'dateErr'=>$data['dateErr'],
						]
					]);
				}

			}
			else{
				$categories = $this->category->getCategories();
				$data = [
					'categories'=>$categories 
				];
				return $this->view('admin/categories/add', $data);
			}
		}else{
			redirect('posts');
		}
	}
	//edit product categories
	public function edit($id){
		$data= [];
		$roleId = $_SESSION['user_role'];
		$roleAdmin = $this->userModel->isAdmin($roleId);
		//find category
		$category = $this->category->getCategoryById($id);
		//get all categories
		$categories = $this->category->getCategories();
		//get parent category if this category is child
		$parentCat = $this->category->findParentCategory($category->parent);
		if($roleAdmin){
			if($category){
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$data = [
						'parent'=>trim($_POST['parent']),
						'name'=>trim($_POST['name']),
						'status'=>trim($_POST['status']),
						'icon'=>trim($_POST['icon']),
						'date'=>$_POST['date'],
						'parentErr'=>'',
						'nameErr'=>'',
						'statusErr'=>'',
						'dateErr'=>'',
						'iconErr'=>''
					];
				if(empty($data['name'])){
					$data['nameErr'] = 'You must add category name!';
				}
				if(empty($data['status'])){
					$data['status'] = 'You must add status for category!';
				}
				if(empty($data['date'])){
					$data['dateErr'] = 'You must add date for category!';
				}
				if(empty($data['nameErr'])&& empty($data['dateErr']) && empty($data['parentErr']) && empty($data['statusErr']) && empty($data['iconErr'])){
				  if($data['name'] !== $category->name || $data['parent'] !== $category->parent || $data['status'] !== $category->status || $data['icon'] !== $category->icon || $data['date'] !== $category->created_at){
					
					$updateCategory = $this->category->updateCategory($id, $data);
					if($updateCategory){
						echo json_encode(['code'=>200, 'msg'=>'Category updated successfully']);
					}else{
						redirect('categories');
					}
				}else{
					echo json_encode(['code'=>200, 'msg'=>'You didnt made any changes!']);
				}				

				}else{
					echo json_encode([
						'code'=>404, 
						'msg'=> [
							'nameErr'=>$data['nameErr'],
							'statusErr'=>$data['statusErr'],
							'dateErr'=>$data['dateErr'],
							'iconErr'=>$data['iconErr'],
							'parentErr'=>$data['parentErr']
						]
					]);
				}
					
				}else{
					$data = [
						'category'=>$category,
						'categories'=>$categories,
						'parentCat'=>$parentCat,
						'nameErr'=>'',
					    'statusErr'=>'',
					    'dateErr'=>'',
					];
					return $this->view('admin/categories/edit', $data);
				}

			}else{
			 redirect('categories');
			}

		}else{
			redirect('posts');
		}
	}
	//delete categories
	public function delete($id){
		$category = $this->category->getCategoryById($id);
		$roleId = $_SESSION['user_role'];
	    $roleAdmin = $this->userModel->isAdmin($roleId);
	    if($roleAdmin){
	    	if($category){
	    	   if($_SERVER['REQUEST_METHOD'] == 'POST'){
			      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			      $catId = $_POST['id'];
			      $deleteCategory = $this->category->deleteCategory($catId);
			      if($deleteCategory){
                     echo json_encode(['code'=>200, 'msg'=>'Category deleted Successfully']);
			      }else{
			      	redirect('categories');
			      }

			   }
	    	}else{
	    		redirect('categories');
	    	}
	    }else{
	    	redirect('posts');	
	    }
	}
}

 ?>