<h1>Usuários</h1>

		<div class="button">
			<a href="<?php echo BASE_URL; ?>users/add_user">Adicionar Usuário
			</a>
		</div>

		<table border="0" width="100%">
			<thead>
				<tr>
					<th>E-mail</th>
					<th>Grupo</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users_list as $us):?>
				<tr>
					<td><?php echo $us['email'];?></td>
					<td><?php echo $us['name'];?></td>
					<td width="160">
						<div class="button button_small">
							<a href="<?php echo BASE_URL; ?>users/edit_user/<?php echo $us['id'];?>">
								Editar
							</a>
						</div>
						<div class="button button_small">
							<a href="<?php echo BASE_URL; ?>users/delete_user/<?php echo $us['id'];?>" onclick="return confirm('Deseja excluir?')">
								Excluir
							</a>
						</div>
					</td>
				</tr>	
				<?php endforeach; ?>	
			</tbody>
		</table>