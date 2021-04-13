<?php
namespace App\Models;

use App\Libraries\Database;
/**
 * 
 */
class User
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database;
	}
    //register user
    public function register($data){
        $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        //execute
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    //login user
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->singleRow();
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        }
        else{
            return false;
        }
    }
	//find user by email
    public function findUserByEmail($email){
    	//query
    	$this->db->query('SELECT * FROM users WHERE email = :email');
    	//bind value
    	$this->db->bind(':email', $email);
    	//get result
        $row = $this->db->singleRow();
        if($this->db->rowCount() > 0){
           return true;
        }
        else {
        	return false;
        }
    }
    //find user by id
    public function findUserById($id){
        //query
        $this->db->query('SELECT * FROM users WHERE id = :id');
        //bind value
        $this->db->bind(':id', $id);
        //get result
        $row = $this->db->singleRow();
        return $row;
    }
    //function to check if is admin
    public function isAdmin($roleId){
        //query to get admins
        $this->db->query('SELECT users.role_id, roles.name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.role_id = :roleId');
        $this->db->bind(':roleId', $roleId);
        $results = $this->db->resultSet();
        if($results[0]->name == 'Admin'){
            return true;
        }else{
            return false;
        }
    }
    //function to get all roles
    public function getRoles(){
        //query to get roles
        $this->db->query('SELECT * FROM roles');
        $roles = $this->db->resultSet();
        return $roles;
    }
    //function to add roles
    public function addRoles($role){
        //query to add roles
        $this->db->query('INSERT INTO roles (name) VALUES (:role)');
        $this->db->bind(':role', $role);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //function to get role by id
    public function getRoleById($id){
        //query to find role
        $this->db->query('SELECT * FROM roles WHERE id = :id');
        //bind id
        $this->db->bind(':id', $id);
        //get result
        $row = $this->db->singleRow();
        return $row;
    }
    //function to edit role
    public function updateRole($id, $role){
        //query to edit role
        $this->db->query('UPDATE roles SET name = :role WHERE id = :id');
        //bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':role', $role);
        if($this->db->execute()){
           return true; 
        }else{
            return false;
        }
    }
    //function to delete role
    public function deleteRole($id){
        //query to delete role
        $this->db->query('DELETE  FROM roles WHERE id = :id');
        //bind value
        $this->db->bind(':id', $id);
        if($this->db->execute()){
           return true; 
        }else{
            return false;
        }
    }

}