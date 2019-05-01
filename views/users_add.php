<h1>Adicionar Usuário</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>
<form method="POST">
	<label for="email">E-mail do usuário</label><br>
	<input type="email" name="email" required><br><br>
	
	<label for="password">Senha</label><br>
	<input type="password" name="password" required><br><br>
	
	<label for="group">Grupo de Permissões</label><br>
	<select name="group" id="group" required>
		<?php foreach ($group_list as $g):?>
		<option value="<?php echo $g['id']; ?>">
			<?php echo $g['name']; ?>			
		</option>
		<?php endforeach; ?>
	</select>
	<br>
	<br>
	<input type="submit" value="Adicionar">

</form>