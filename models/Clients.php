<?php 

class Clients extends model{


	public function getList($offset){
		$array = array();

		$sql = $this->pdo->prepare("SELECT * FROM clients LIMIT $offset, 10");
		$sql->execute();

		if($sql->rowCount() > 0){	
			$array = $sql->fetchAll();
		}

		return $array;

	}

	public function add($company, $name, $email, $phone, $stars, $internal_obs, $address, $address2, $address_number, $address_zipcode, $address_neigh, $address_city, $address_state, $address_country){

		$sql = $this->pdo->prepare("INSERT INTO clients SET name = :name, id_company = :company, email = :email, phone = :phone, address = :address, address2 = :address2, address_number = :address_number, address_neigh = :address_neigh, address_city = :address_city, address_state = :address_state, address_country = :address_country, address_zipcode = :address_zipcode, stars = :stars, internal_obs =:internal_obs");
		$sql->bindValue(":name",$name);
		$sql->bindValue(":company",$company);
		$sql->bindValue(":email",$email);
		$sql->bindValue(":phone",$phone);
		$sql->bindValue(":address",$address);
		$sql->bindValue(":address2",$address2);
		$sql->bindValue(":address_number",$address_number);
		$sql->bindValue(":address_neigh",$address_neigh);
		$sql->bindValue(":address_city",$address_city);
		$sql->bindValue(":address_state",$address_state);
		$sql->bindValue(":address_country",$address_country);
		$sql->bindValue(":address_zipcode",$address_zipcode);
		$sql->bindValue(":stars",$stars);
		$sql->bindValue(":internal_obs",$internal_obs);
		$sql->execute();
	}


}