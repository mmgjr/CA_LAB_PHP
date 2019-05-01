<?php 

class permissionsController extends controller{


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

		if($u->hasPremission('permissions_view')){
			$permissions = new Permissions();
			$data['permissions_list'] = $permissions->getList($u->getUserCompany());
			$data['permissions_groups_list'] = $permissions->getGroupList($u->getUserCompany());

			$this->loadTemplate('permissions',$data);
		}else{
			header("Location: ".BASE_URL);
		}
		
		
	}


	public function add(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('permissions_view')){
			$permissions = new Permissions();
		
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$pName = addslashes($_POST['name']);
				
				$permissions->add($pName,$u->getUserCompany());
				header("Location: ".BASE_URL."permissions");
			}

			$this->loadTemplate('permissions_add',$data);
		}else{
			header("Location: ".BASE_URL);
		}
	}

	public function add_group(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('permissions_view')){
			$permissions = new Permissions();
		
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$gName = addslashes($_POST['name']);
				$gList = $_POST['permissions'];

				$permissions->addGroup($gName,$gList,$u->getUserCompany());
				header("Location: ".BASE_URL."permissions");
			}

			$data['permissions_list'] = $permissions->getList($u->getUserCompany());

			$this->loadTemplate('permissions_add_group',$data);
		}else{
			header("Location: ".BASE_URL);
		}
	}

	public function delete($id){

		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('permissions_view')){
			$permissions = new Permissions();
			$permissions->delete($id);
			header("Location: ".BASE_URL."permissions");
		}else{
			header("Location: ".BASE_URL);
		}
	}

	public function delete_group($id){

		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('permissions_view')){
			$permissions = new Permissions();
			$permissions->deleteGroup($id);
			header("Location: ".BASE_URL."permissions");
		}else{
			header("Location: ".BASE_URL);
		}

	}

	public function edit_group($id){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('permissions_view')){
			$permissions = new Permissions();
		
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$gName = addslashes($_POST['name']);
				$gList = $_POST['permissions'];

				$permissions->editGroup($gName,$gList,$u->getUserCompany(),$id);
				header("Location: ".BASE_URL."permissions");
			}

			$data['permissions_list'] = $permissions->getList($u->getUserCompany());
			$data['group_info'] = $permissions->getGroup($id,$u->getUserCompany());

			$this->loadTemplate('permissions_edit_group',$data);
		}else{
			header("Location: ".BASE_URL);
		}
	}


}