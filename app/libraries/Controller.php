<?php 

/**
 *base controller
 *loads models and views 
 */
class Controller
{
	//model load
	public function model($model){
		//require model file
		require_once '../app/models/' . $model . '.php';	
		//instatiate model
		return new $model();	
	}
	//load view
	public function view($view, $data = []){
		//check for the view file
		if(file_exists('../app/views/' . $view . '.php')){
			require_once '../app/views/' . $view . '.php';
		}
		else {
			die('View dont exists'); 
		}
	}
	
}

 ?>