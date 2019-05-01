<?php 

Class Permissions extends model{

	private $group;
	private $permissions;

	public function setGroup($id,$id_company){
		$this->group = $id;
		$this->permissions = array();
		
		$sql = $this->pdo->prepare("SELECT params FROM permission_groups WHERE id = :id AND id_company = :id_company");	
		$sql->bindValue(':id',$id);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$row = $sql->fetch();

			if(empty($row['params'])){
				$row['params'] = '0';
			}
			$params = $row['params'];

			$sql = $this->pdo->prepare("SELECT name FROM permission_params WHERE id IN ($params) AND id_company = :id_company");
			$sql->bindValue(':id_company',$id_company);
			$sql->execute();

			if($sql->rowCount() > 0){
				foreach ($sql->fetchAll() as $item) {
					$this->permissions[] = $item['name'];

				}	
			}
		}
	}

	public function hasPermission($name){
		if(in_array($name, $this->permissions)){
			return true;
		}else{
			return false;
		}
	}

	public function getList($id_company){
		$array = array();
		$sql = "SELECT * FROM permission_params WHERE id_company = :id_company";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}
		return $array;
	}
	public function getGroupList($id_company){
		$array = array();

		$sql = "SELECT * FROM permission_groups WHERE id_company = :id_company";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function add($pName,$id_company){
		
		$sql = $this->pdo->prepare("INSERT INTO permission_params SET id_company = :id_company, name = :pName");
		$sql->bindValue(':pName',$pName);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();
	}

	public function addGroup($gName,$gList,$id_company){
		$params = implode(',',$gList);
		$sql = $this->pdo->prepare("INSERT INTO permission_groups SET id_company = :id_company, name = :gName, params = :params");
		$sql->bindValue(':gName',$gName);
		$sql->bindValue(':id_company',$id_company);
		$sql->bindValue(':params',$params);
		$sql->execute();
	}

	public function delete($id){
		$sql = $this->pdo->prepare("DELETE FROM permission_params WHERE id = :id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		
	}

	public function deleteGroup($id){
		
		$u = new Users();
		if($u->findUsersInGroup($id) == false){
			$sql = $this->pdo->prepare("DELETE FROM permission_groups WHERE id = :id");
			$sql->bindValue(":id",$id);
			$sql->execute();
		}
	}

	public function getGroup($id,$id_company){
		$array = array();
		$sql = "SELECT * FROM permission_groups WHERE id = :id AND id_company = :id_company";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();

		if($sql->rowCOunt() > 0){
			$array = $sql->fetch();
			$array['params'] = explode(',', $array['params']);

		}
		return $array;
	}

	public function editGroup($gName,$gList,$id_company,$id){
		$params = implode(',',$gList);
		$sql = $this->pdo->prepare("UPDATE permission_groups SET id_company = :id_company, name = :gName, params = :params WHERE id = :id");
		$sql->bindValue(':gName',$gName);
		$sql->bindValue(':id_company',$id_company);
		$sql->bindValue(':params',$params);
		$sql->bindValue(':id',$id);
		$sql->execute();	
	}
}