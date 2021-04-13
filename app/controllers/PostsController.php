<?php
namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User; 
use App\Models\Post; 
/**
 * 
 */
class PostsController extends BaseController
{
	public function __construct(){
		if(!isLoggedIn()){
 			redirect('users/login');
		}
		$this->postModel = new Post();
		$this->userModel = new User();
	}
	public function index()
	{
		//get posts
		$posts = $this->postModel->getPosts();
		$data = [
			'posts'=>$posts
		];
		$this->view('posts/index', $data);
	}
	//add posts 
	public function add(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//sanitize the post
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'title'=>trim($_POST['title']),
				'body'=>trim($_POST['body']),
				'user_id'=>$_SESSION['user_id'],
				'title_err'=>'',
				'body_err'=>'',
			];
			//validate title
			if(empty($data['title'])){
				$data['title_err'] = 'Please fill the title';
			}
			//validate body
			if(empty($data['body'])){
				$data['body_err'] = 'Please fill the body';
			}
			if(empty($data['title_err']) && empty($data['body_err'])){
				//validated
				if($this->postModel->addPost($data)){
					flash('post_message', 'Post added Successfully');
					redirect('posts');
				}else{
					die('Something went wrong');
				}	
			}else{
				//load view with errors
				$this->view('posts/add', $data);
			}
		}
		else{
			$data = [
				'title'=>'',
				'body'=>''
			];
			$this->view('posts/add', $data);
		}
	}
	//edit posts 
	public function edit($id){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//sanitize the post
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'id'=>$id,
				'title'=>trim($_POST['title']),
				'body'=>trim($_POST['body']),
				'user_id'=>$_SESSION['user_id'],
				'title_err'=>'',
				'body_err'=>'',
			];
			//validate title
			if(empty($data['title'])){
				$data['title_err'] = 'Please fill the title';
			}
			//validate body
			if(empty($data['body'])){
				$data['body_err'] = 'Please fill the body';
			}
			if(empty($data['title_err']) && empty($data['body_err'])){
				//validated
				if($this->postModel->updatePost($data)){
					flash('post_message', 'Post updated Successfully');
					redirect('posts');
				}else{
					die('Something went wrong');
				}	
			}else{
				//load view with errors
				$this->view('posts/edit', $data);
			}
		}
		else{
			$post = $this->postModel->getPost($id);
			//check for the owner of post
			if($post->user_id !== $_SESSION['user_id']){
				redirect('posts');
			}
			$data = [
				'id'=>$id,
				'title'=>$post->title,
				'body'=>$post->body
			];
			$this->view('posts/edit', $data);
		}
	}
	public function show($id){
		$post = $this->postModel->getPost($id);
		$user = $this->userModel->findUserById($post->user_id);
		$data = [
			'post'=>$post,
			'user'=>$user
		];
		$this->view('posts/show', $data);
	}
	//delete a post
	public function delete($id){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$post = $this->postModel->getPost($id);
			//check for the owner of post
			if($post->user_id !== $_SESSION['user_id']){
				redirect('posts');
			}
			if($this->postModel->deletePost($id)){
				flash('post_message', 'Your post has been deleted successfully');
				redirect('posts');
			}else{
				die('Something went wrong');
			}
		}else{
			redirect('posts');
		}
	}
}