<!DOCTYPE html>
<html>
<head>
	<title>Painel - <?php echo $viewData['company_name']; ?> </title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/template.css">
</head>
<body>
	<div class="leftmenu">
		<div class="company_name">
			<?php echo $viewData['company_name']; ?>		
		</div>
		<div class="menuArea">
			<ul>
			    <li>
			    	<a href="<?php echo BASE_URL; ?>">Home</a>
			    </li>
			    <li>
			    	<a href="<?php echo BASE_URL; ?>permissions">Permissões</a>
			    </li>
			  	 <li>
			    	<a href="<?php echo BASE_URL; ?>users">Usuários</a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="top">
			<div class="top_right">
				<a href="<?php echo BASE_URL; ?>login/logout">Sair</a>
			</div>
			<div class="top_right">
				<?php echo $viewData['user_email']; ?>
			</div>		
			
		</div>
		<div class="area">
			<?php $this->loadViewInTemplate($viewName, $viewData); ?>
		</div>
	</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.js">/*3.3.1-min.js*/</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>
</html>	