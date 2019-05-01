<?php 

class homeController extends controller{

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

		$this->loadTemplate('home',$data);
	}


}