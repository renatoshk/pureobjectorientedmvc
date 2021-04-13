<?php
//redirect function
function redirect($loaction){
	header('Location: ' . URLROOT . '/' . $loaction);
}