<?php 

class Users extends model{

	private $userInfo;
	private $permissions; 

	public function isLogged(){

		if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])){
			return true;
		}else{
			return false;
		}

	}

	public function doLogin($email,$pass){
		$sql = "SELECT * FROM users WHERE email=:email AND password=:pass";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':email',$email);
		$sql->bindValue(':pass',md5($pass));
		$sql->execute();

		if($sql->rowCount() > 0){
			$row = $sql->fetch();
			$_SESSION['ccUser'] = $row['id'];
			
			return true;
		}else{
			return false;
		}
	}


	public function setLoggedUser(){
		if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])){
			$id = $_SESSION['ccUser'];
			$sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindValue(":id",$id);
			$sql->execute();
			if($sql->rowCount() > 0){
				$this->userInfo = $sql->fetch();
				$this->permissions = new Permissions();
				$this->permissions->setGroup($this->userInfo['groups'],$this->userInfo['id_company']);
			}
		}
	}

	public function logout(){
		unset($_SESSION['ccUser']);
		
	}
	public function hasPremission($name){
		return $this->permissions->hasPermission($name);
	}
	public function getUserCompany(){
		if(isset($this->userInfo['id_company'])){
			return $this->userInfo['id_company'];
		}else{
			return 0;
		}
	}
	public function getEmail(){
		if(isset($this->userInfo['email'])){
			return $this->userInfo['email'];
		}else{
			return '';
		}
	}

	public function findUsersInGroup($id){
		$sql = $this->pdo->prepare("SELECT COUNT(*) as c FROM users WHERE groups = :id_group");
		$sql->bindValue(":id_group",$id);
		$sql->execute();
		$row = $sql->fetch();
		if($row['c'] == '0'){
			return false;
		}else{
			return true;
		}
	}

	public function getList($id_company){
		$array = array();
		$sql = "SELECT users.id,users.email,permission_groups.name FROM users 
		LEFT JOIN permission_groups ON permission_groups.id=users.groups WHERE users.id_company = :id_company";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();

		}
		return $array;
	}


	public function addUser($email,$pass,$group,$id_company){
		$sql = "SELECT COUNT(*) as c FROM users WHERE email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":email",$email);
		$sql->execute();
		$row = $sql->fetch();
		if($row['c'] == '0'){

			$sql = "INSERT INTO users SET email=:email,password=:pass,id_company=:id_company,groups=:groups";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":email",$email);
			$sql->bindValue(":pass",md5($pass));
			$sql->bindValue(":id_company",$id_company);
			$sql->bindValue(":groups",$group);
			$sql->execute();

			return '1';
		}else{
			return '0';
		}
	}


	public function getInfo($id,$id_company){
		$array = array();
		$sql = "SELECT * FROM users WHERE id=:id AND id_company=:id_company";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();
		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		return $array;
	}

	public function editUser($pass,$group,$id,$id_company){
		$sql = $this->pdo->prepare("UPDATE users SET groups = :id_group WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id_group",$group);
		$sql->bindValue(":id",$id);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();

		if(!empty($pass)){
			$sql = $this->pdo->prepare("UPDATE users SET password = :pass WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":pass",md5($pass));
			$sql->bindValue(":id",$id);
			$sql->bindValue(":id_company",$id_company);
			$sql->execute();

		}
	}

	public function deleteUser($id,$id_company){
		$sql = $this->pdo->prepare("DELETE FROM users WHERE id = :id AND id_company=:id_company");
		$sql->bindValue(":id",$id);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();
		
		
	}

}

