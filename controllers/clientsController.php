<?php 

class clientsController extends controller{


	public function __construct(){	
		$u = new Users();
		if($u->isLogged() == false){
			header("Location: ".BASE_URL."login");
			exit;
		}
	}

	public function index(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('clients_view')){
			$c = new Clients();
			$offset = 0;

			$data['clients_list'] = $c->getList($offset);
			$data['edit_permission'] = $u->hasPremission('clients_edit');

			$this->loadTemplate('clients',$data);
		}else{
			header("Location: ".BASE_URL);
		}		
	}


	public function add_client(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('clients_edit')){
			$c = new Clients();
			
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$email = addslashes($_POST['email']);
				$phone = addslashes($_POST['phone']);
				$stars = addslashes($_POST['stars']);
				$internal_obs = addslashes($_POST['internal_obs']);
				$address = addslashes($_POST['address']);
				$address_zipcode = addslashes($_POST['address_zipcode']);
				$address_number = addslashes($_POST['address_number']);
				$address2 = addslashes($_POST['address2']);
				$address_neigh = addslashes($_POST['address_neigh']);
				$address_city = addslashes($_POST['address_city']);
				$address_state = addslashes($_POST['address_state']);
				$address_country = addslashes($_POST['address_country']);

				$c->add($u->getUserCompany(), $name, $email, $phone, $stars, $internal_obs, $address, $address2, $address_number, $address_zipcode, $address_neigh, $address_city, $address_state, $address_country);

				header("Location: ".BASE_URL."clients");

			}
			
			

			$this->loadTemplate('clients_add',$data);
		}else{
			header("Location: ".BASE_URL."clients");
		}	

	}


}	