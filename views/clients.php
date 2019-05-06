<h1>Clientes</h1>
	<?php if($edit_permission): ?>
		<div class="button">
			<a href="<?php echo BASE_URL; ?>clients/add_client">Adicionar Clientes
			</a>
		</div>
	<?php endif; ?>
	
	<input type="text" name="search" id="search" placeholder="Search Here" data-type="search_clients">

		<table border="0" width="100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Cidade</th>
					<th>Estrelas</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($clients_list as $c):?>
					<tr>
						<td><?php echo $c['name']; ?></td>
						<td width="100"><?php echo $c['phone']; ?></td>
						<td width="150"><?php echo $c['address_city']; ?></td>
						<td width="50" style="text-align: center;"><?php echo $c['stars']; ?></td>
						<td width="160" align="center">
							<?php if($edit_permission): ?>
								<div class="button button_small">
									<a href="<?php echo BASE_URL; ?>clients/edit_client/<?php echo $c['id'];?>">
										Editar
									</a>
								</div>
								<div class="button button_small">
									<a href="<?php echo BASE_URL; ?>clients/delete_client/<?php echo $c['id'];?>" onclick="return confirm('Deseja excluir?')">
										Excluir
									</a>
								</div>
							<?php else: ?>	
								<div class="button button_small">
									<a href="<?php echo BASE_URL; ?>clients/view/<?php echo $c['id'];?>">
										Visualizar
									</a>
								</div>
							<?php endif; ?>	
						</td>
					</tr>
				<?php endforeach; ?>	
			</tbody>
		</table>
		<div class="pagination">
			<?php for ($q = 1; $q <= $p_count; $q++):?>
				<div class="pag_item <?php echo ($q==$p)?'pag_active':'';?>">
					<a href="<?php echo BASE_URL;?>clients?p=<?php echo $q;?>">
						<?php echo $q; ?>
					</a>
				</div>
			<?php endfor; ?>
		<!--DIV com clear both para jogar as div com float para o alto.-->	
			<div style="clear: both;"></div>
		</div>	

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script_clients_add.js"></script>