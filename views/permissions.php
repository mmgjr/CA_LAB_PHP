<h1>Permissões</h1>

<div class="tabArea">
	<div class="tabItem activeTab">Grupos de permissões</div>
	<div class="tabItem">Permissões</div>
</div>
<div class="tabContent">
	<div class="tabBody" style="display: block;">
		<div class="button">
			<a href="<?php echo BASE_URL; ?>permissions/add_group">Adicionar Grupo de Permissões
			</a>
		</div>

		<table border="0" width="100%">
			<thead>
				<tr>
					<th>Nome do Groupo de Permissões</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($permissions_groups_list as $g):?>
				<tr>
					<td><?php echo $g['name'];?></td>
					<td width="160">
						<div class="button button_small">
							<a href="<?php echo BASE_URL; ?>permissions/edit_group/<?php echo $g['id'];?>">
								Editar
							</a>
						</div>
						<div class="button button_small">
							<a href="<?php echo BASE_URL; ?>permissions/delete_group/<?php echo $g['id'];?>" onclick="return confirm('Deseja excluir?')">
								Excluir
							</a>
						</div>
					</td>
				</tr>	
				<?php endforeach; ?>	
			</tbody>
		</table>
	</div>

	<div class="tabBody">
		
		<div class="button">
			<a href="<?php echo BASE_URL; ?>permissions/add">Adicionar Permissão
			</a>
		</div>

		<table border="0" width="100%">
			<thead>
				<tr>
					<th>Permissão</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($permissions_list as $p):?>
				<tr>
					<td><?php echo $p['name'];?></td>
					<td width="50">
						<div class="button button_small">
							<a href="<?php echo BASE_URL; ?>permissions/delete/<?php echo $p['id'];?>" onclick="return confirm('Deseja excluir?')">
								Excluir
							</a>
						</div>
					</td>
				</tr>	
				<?php endforeach; ?>	
			</tbody>
		</table>
	</div>
</div>