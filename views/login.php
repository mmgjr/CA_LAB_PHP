<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/login.css">
</head>
<body>
	<div class="loginarea">
		<form method="POST">
			<input type="email" name="email" placeholder="E-mail">
			<input type="password" name="pass" placeholder="Password">	
			<input type="submit" value="login"><br>
			<?php if(isset($error) && !empty($error)): ?>
				<div class="warning"><?php echo $error; ?></div>
			<?php endif; ?>
		</form>
	</div>
</body>
</html>