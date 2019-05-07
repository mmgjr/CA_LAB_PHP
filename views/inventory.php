<h1>Estoque</h1>

<?php if($add_permission): ?>
	<div class="button">
		<a href="<?php echo BASE_URL; ?>inventory/add_inventory">Adicionar Produto
		</a>
	</div>
<?php endif; ?>

<input type="text" name="search" id="search" placeholder="Search Here" data-type="search_inventory">

<table border="0" width="100%">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Preço R$</th>
			<th>Quantidade</th>
			<th>Qdt. Min.</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>	
	<?php foreach ($inventory_list as $product): ?>
		<tr>
			<td><?php echo $product['name']; ?></td>
			<td><?php echo number_format($product['price'],2,',','.'); ?></td>
			<td width="60" style="text-align:center;"><?php echo $product['quant']; ?></td>
			<td width="90" style="text-align:center;"><?php
			if($product['min_quant'] > $product['quant']){
				echo '<span style="color:red">'.($product['min_quant']).'</span>';
			}else{

				echo $product['min_quant'];
			}
			
			?></td>
			<td width="160">
				<div class="button button_small"><a href="<?php echo BASE_URL;?>inventory/edit_inventory/<?php echo $product['id'];?>">Editar</a></div>
				<div class="button button_small"><a href="<?php echo BASE_URL;?>inventory/excluir_inventory/<?php echo $product['id'];?>" onclick="return confirm('Deseja excluir?')">Excluir</a></div>
			</td>

		</tr>
	<?php endforeach; ?>
	</tbody>

</table>