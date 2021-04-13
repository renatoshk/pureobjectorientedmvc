<?php
namespace App\Libraries;

use App\Controllers\RolesController;
use App\Controllers\PostsController;
use App\Controllers\PagesController;
use App\Controllers\AdminController;
use App\Controllers\UserController;
use App\Controllers\CategoriesController;
/**
 * App Core Class
 *Create Url and loads core controllers
 *URL FORMAT - /controllers/methods/params
 */
class Core
{
	//properties
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];
	
	public function __construct()
	{
		$url = $this->getUrl();
		if($url == null){
           $url = [];
           $url[] = lcfirst($this->currentController);
        }
		//look in controllers for first value
		if(file_exists('../app/controllers/' . ucwords($url[0]) .'Controller'.'.php')){
         //if yes set as controller
			$this->currentController = ucwords($url[0]);
			//unset 0 index 
			unset($url[0]);
		}
		//require the controller
		// require_once '../app/controllers/' . $this->currentController .'Controller'.'.php';
		//instantiate controller class
		
		$this->currentController = $this->currentController.'Controller';
		$path =  'App"Controllers"'.$this->currentController;
		$path = addslashes($path);
		$path = str_replace('"', '', $path);
		// var_dump($path);die;
		$this->currentController = new $path();
		//check for second part of url
		if(isset($url[1])){
			//check if method exists
			if(method_exists($this->currentController, $url[1])){
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}
		//check params
		$this->params = $url ? array_values($url) : [];
		//call a call back with array of params
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
	}

	public function getUrl(){
		if(isset($_GET['url'])){
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
	   }
	}
}