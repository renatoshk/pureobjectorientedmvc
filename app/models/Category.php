<?php 
namespace App\Models;

use App\Libraries\Database;
/**
 * category
 */
class Category  
{
	
	public function __construct()
	{
		$this->db = new Database;
	}
    //get categories
    public function getCategories(){
    	$this->db->query('SELECT * FROM categories');
    	$categories = $this->db->resultSet();
    	return $categories;
    }
    //add category
    public function addCategory($data){
        //query to insert data category
        $this->db->query('INSERT INTO categories(icon, parent, name, status, created_at) VALUES (:icon, :parent, :name,:status, :created_at)');
        //bind values
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':parent', $data['parent']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_at', $data['date']);
        //query execute
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    //find parent category
    public function findParentCategory($parentId){
        $this->db->query('SELECT * FROM categories WHERE id = :parentId');
        $this->db->bind(':parentId', $parentId);
        $result = $this->db->singleRow();
        return $result; 
    }
    //get category by id
    public function getCategoryById($id){
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->singleRow();
        return $result;
    }
    //update category by id
    public function updateCategory($id, $data){
        $this->db->query('UPDATE categories SET icon = :icon, parent = :parent, name = :name, status = :status, created_at = :created_at WHERE id = :id');
        //bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':parent', $data['parent']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_at', $data['date']);
        //run query
        if($this->db->execute()){
           return true; 
        }else{
            return false;
        }
    }
    //delete category
    public function deleteCategory($id){
         //query to delete role
        $this->db->query('DELETE  FROM categories WHERE id = :id');
        //bind value
        $this->db->bind(':id', $id);
        if($this->db->execute()){
           return true; 
        }else{
            return false;
        }
    }

}

 ?>