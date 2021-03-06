<h1>Adicionar Cliente</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>
<form method="POST">
	<label for="name">Nome:</label><br>
	<input type="text" name="name" required><br><br>

	<label for="email">E-mail do cliente:</label><br>
	<input type="email" name="email" ><br><br>
	
	<label for="phone">Telefone:</label><br>
	<input type="text" name="phone" ><br><br>
	
	<label for="stars">Estrelas:</label><br>
	<select name="stars" id="stars">
		<option value="1">1 Estrela</option>
		<option value="2">2 Estrelas</option>
		<option value="3" selected="selected">3 Estrelas</option>
		<option value="4">4 Estrelas</option>
		<option value="5">5 Estrelas</option>
	</select><br><br>

	<label for="internal_obs">Observações internas:</label><br>
	<textarea name="internal_obs" id="internal_obs">
		
	</textarea><br><br>

	<label for="address_zipcode">CEP:</label><br>
	<input type="text" name="address_zipcode" id="address_zipcode"><br><br>

	<label for="address">Rua:</label><br>
	<input type="text" name="address" ><br><br>

	<label for="address_number">Número:</label><br>
	<input type="text" name="address_number" ><br><br>

	<label for="address2">Complemento:</label><br>
	<input type="text" name="address2" ><br><br>

	<label for="address_neigh">Bairro:</label><br>
	<input type="text" name="address_neigh" ><br><br>

	<label for="address_city">Cidade:</label><br>
	<input type="text" name="address_city" ><br><br>

	<label for="address_state">Estado:</label><br>
	<input type="text" name="address_state" ><br><br>

	<label for="address_country">País:</label><br>
	<input type="text" name="address_country" ><br><br>

	<input type="submit" value="Adicionar">

</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script_clients_add.js"></script>
