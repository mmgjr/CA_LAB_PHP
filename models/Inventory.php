<?php 

class Inventory extends model{


	public function getList($offset,$id_company){

		$array = array();

		$sql = "SELECT * FROM inventory WHERE id_company =:id_company LIMIT $offset, 10";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;

	}

	public function getProduct($id,$id_company){
		$array = array();
		$sql = "SELECT * FROM inventory WHERE id_company =:id_company AND id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}
		return $array;
	}

	public function add($id_company,$name,$price,$quant,$min_quant,$id_user){

		
		$sql = $this->pdo->prepare("INSERT INTO inventory SET name = :name, price = :price, quant = :quant, min_quant = :min_quant, id_company = :id_company");
		$sql->bindValue(':name',$name);
		$sql->bindValue(':id_company',$id_company);
		$sql->bindValue(':price',$price);
		$sql->bindValue(':quant',$quant);
		$sql->bindValue(':min_quant',$min_quant);
		$sql->execute();

		//pegando o ID do último elemento inserido.
		$id_product = $this->pdo->lastInsertId();

		//Método Auxiliar
		$this->setLog($id_product,$id_user,"ADD");

	}

	public function edit($id,$id_company,$name,$price,$quant,$min_quant,$id_user){

		$sql = $this->pdo->prepare("UPDATE inventory SET name = :name, price = :price, quant = :quant, min_quant = :min_quant WHERE id=:id AND id_company = :id_company");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':name',$name);
		$sql->bindValue(':id_company',$id_company);
		$sql->bindValue(':price',$price);
		$sql->bindValue(':quant',$quant);
		$sql->bindValue(':min_quant',$min_quant);
		$sql->execute();

		//Método Auxiliar
		$this->setLog($id,$id_user,"EDI");

	}


	public function delet($id,$id_company,$id_user){

		$sql = $this->pdo->prepare("DELETE FROM inventory WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();

		//Método Auxiliar
		$this->setLog($id,$id_user,"DEL");

	}



	//Método auxiliar
	private function setLog($id_product,$id_user,$action){
		$sql = $this->pdo->prepare("INSERT INTO inventory_history SET id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()");
		$sql->bindValue(":id_product",$id_product);
		$sql->bindValue(":id_user",$id_user);
		$sql->bindValue(":action",$action);
		$sql->execute();
	}
}
