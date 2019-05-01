<?php 

class usersController extends controller{


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

		if($u->hasPremission('users_view')){
			$data['users_list'] = $u->getList($u->getUserCompany());

			$this->loadTemplate('users',$data);
		}else{
			header("Location: ".BASE_URL);
		}		
	}

	public function edit_user($id){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('users_view')){
			$p = new Permissions();

			if(isset($_POST['group']) && !empty($_POST['group'])){	
				$pass = addslashes($_POST['password']);
				$group = addslashes($_POST['group']);

				$u->editUser($pass,$group,$id,$u->getUserCompany());
				
				header("Location: ".BASE_URL."users");
			}
			$data['user_info'] = $u->getInfo($id,$u->getUserCompany());
			$data['group_list'] = $p->getGroupList($u->getUserCompany());

			$this->loadTemplate('users_edit',$data);
		}else{
			header("Location: ".BASE_URL);
		}	
	}

	public function add_user(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('users_view')){
			$p = new Permissions();

			if(isset($_POST['email']) && !empty($_POST['email'])){	
				$email = addslashes($_POST['email']);
				$pass = addslashes($_POST['password']);
				$group = $_POST['group'];

				$a = $u->addUser($email,$pass,$group,$u->getUserCompany());
				
				if($a == '1'){
					header("Location: ".BASE_URL."users");
				}else{
					$data['error_msg'] = "Usuário já existe!";
				}
			}

			$data['group_list'] = $p->getGroupList($u->getUserCompany());

			$this->loadTemplate('users_add',$data);
		}else{
			header("Location: ".BASE_URL);
		}		
	}


	public function delete_user($id){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$comp = new Companies($u->getUserCompany());
		$data['company_name'] = $comp->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPremission('users_view')){
			$p = new Permissions();

			$u->deleteUser($id,$u->getUserCompany());

			header("Location: ".BASE_URL."users");
		}else{
			header("Location: ".BASE_URL);
		}		
	}
}