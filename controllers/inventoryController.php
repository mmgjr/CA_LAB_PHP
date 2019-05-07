<?php 

class inventoryController extends controller{


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
		$company = new Companies($u->getUserCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();
		
		if($u->hasPremission('inventory_view')){

			$i = new Inventory();
			$offset = 0;

			$data['inventory_list']= $i->getList($offset,$u->getUserCompany());

			$data['add_permission'] = $u->hasPremission('inventory_add');
			$data['edit_permission'] = $u->hasPremission('inventory_edit');



			$this->loadTemplate('inventory',$data);
		}else{
			header("Location: ".BASE_URL);
		}

	}

	public function add_inventory(){

		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getUserCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('inventory_add')){

			if(isset($_POST['name']) && !empty($_POST['name'])){
				$i = new Inventory();
				$name = addslashes($_POST['name']);
				$price = addslashes($_POST['price']);
				$quant = addslashes($_POST['quant']);
				$min_quant = addslashes($_POST['min_quant']);
				//formanto para armazenar no banco.
				$price = str_replace('.', '', $price);
				$price = str_replace(',', '.', $price);	
				
				//adicionando ao banco.
				$i->add($u->getUserCompany(),$name,$price,$quant,$min_quant,$u->getId());

				header("Location: ".BASE_URL."inventory");
			}

			$this->loadTemplate('inventory_add',$data);
		}


	}


	public function edit_inventory($id){

		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getUserCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('inventory_edit')){
			$i = new Inventory();

			if(isset($_POST['name']) && !empty($_POST['name'])){
				
				$name = addslashes($_POST['name']);
				$price = addslashes($_POST['price']);
				$quant = addslashes($_POST['quant']);
				$min_quant = addslashes($_POST['min_quant']);
				//formanto para armazenar no banco.
				$price = str_replace('.', '', $price);
				$price = str_replace(',', '.', $price);	
				//adicionando ao banco.
				$i->edit($id,$u->getUserCompany(),$name,$price,$quant,$min_quant,$u->getId());

				header("Location: ".BASE_URL."inventory");
			}

			$data['inventory_item'] = $i->getProduct($id,$u->getUserCompany());

			$this->loadTemplate('inventory_edit',$data);
		}
	}

	public function excluir_inventory($id){
		$u = new Users();
		$u->setLoggedUser();

		if($u->hasPremission('inventory_edit')){
			$i = new Inventory();
			$i->delet($id,$u->getUserCompany(),$u->getId());

			header("Location: ".BASE_URL."inventory");
		}			
	}

}	