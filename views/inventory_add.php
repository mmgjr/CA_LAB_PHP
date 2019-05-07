<h1>Adicionar Produto</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>
<form method="POST">
	<label for="name">Nome:</label><br>
	<input type="text" name="name" required><br><br>
	
	<label for="price_product">Preço:</label><br>
	<input type="text" name="price" id="price_product" required><br><br>	

	<label for="quant">Quantidade em Estoque: </label><br>
	<input type="number" name="quant" required><br><br>

	<label for="min_quant">Quantidade Mínima em Estoque:</label><br>
	<input type="number" name="min_quant" required><br><br>

	<input type="submit" value="Adicionar">

</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script_inventory_add.js"></script>
