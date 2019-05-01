<h1>Adicionar - Grupo de Permissões</h1>

<form method="POST">
	<label for="name_group">Nome do grupo de permissões</label><br>
	<input type="text" name="name" id="name_group"><br><br>
	
	<label>Permissões</label><br>
	<?php foreach ($permissions_list as $p): ?>
		<div class="p_item">
			<input type="checkbox" name="permissions[]" value="<?php echo $p['id'];?>" id="p_<?php echo $p['id'];?>">
		<label for="p_<?php echo $p['id'];?>"><?php echo $p['name']; ?></label>
		</div>
	<?php endforeach ?>	
		<br><br>
	<input type="submit" value="Adicionar">
</form>