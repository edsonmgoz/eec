<div class="col-md-12">
	<div class="page-header margin-none ">
		<?php if ($current_user['role'] == 'admin'): ?>
		<h2 class="padding-none"><?php echo __('Lista de compras'); ?></h2>
		<?php endif ?>
		<?php if ($current_user['role'] == 'compras'): ?>
		<h2 class="padding-none"><?php echo __('Piezas pendientes'); ?></h2>
		<?php endif ?>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('Pieza'); ?></th>
				<th><?php echo $this->Paginator->sort('Cantidad'); ?> Uds</th>
				<th><?php echo $this->Paginator->sort('Costo del pedido'); ?> $</th>
				<?php if ($current_user['role'] == 'compras'): ?>
				<th><?php echo 'Confirmado'; ?></th>
				<th><?php echo 'Autorización'; ?></th>
				<th class="actions"><?php echo __('Acciones'); ?></th>
				<?php endif ?>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($shoppings as $shopping): ?>
		<tr>
			<td><?php echo h($shopping['Piece']['name']); ?>&nbsp;</td>
			<td><?php echo h($shopping['Shopping']['quantity']); ?>&nbsp;</td>
			<td><?php echo $shopping['Shopping']['quantity'] * $shopping['Piece']['price'] ?></td>
			<?php if ($current_user['role'] == 'compras'): ?>
			<td class="text-center">
				<?php
				if ($shopping['Shopping']['state_provider'] == 0)
				{
					echo "<span class='glyphicon glyphicon-time text-warning' title='En espera...'></span>";
				}
				elseif ($shopping['Shopping']['state_provider'] == 1)
				{
					echo "<span class='glyphicon glyphicon-ok text-success' title='Con stock'></span>";
				}
				?>
			</td>
			<td class="text-center">
				<?php
				if ($shopping['Shopping']['state_shopping'] == 0)
				{
					echo "<span class='glyphicon glyphicon-remove text-danger' title='Sin autorización.'></span>";
				}
				elseif ($shopping['Shopping']['state_shopping'] == 1)
				{
					if ($shopping['Shopping']['state_admin'] == 1)
					{
						echo "<span class='glyphicon glyphicon-ok text-success' title='Autorizado'></span>";
					}
					else
					{
					echo "<span class='glyphicon glyphicon-time text-warning' title='En espera...'></span>";
					}
				}
				?>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Consultar compra'), array('action' => 'consult', $shopping['Shopping']['id']), array('class' => 'btn btn-sm btn-info')); ?>
				<?php echo $this->Html->link(__('Comprar'), array('action' => 'shop', $shopping['Shopping']['id']), array('class' => 'btn btn-sm btn-success')); ?>
			</td>
			<?php endif ?>
		</tr>
	<?php endforeach; ?>
		</tbody>
		</table>
	</div>

	<p class="text-success">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, mostrando {:current} registros de {:count} totales, iniciando en {:start}, finalizando en {:end}')
	));
	?>	</p>
	<ul class="pagination">
		<li>
			<?php echo $this->Paginator->prev('< ' . __('Anterior'), array('tag' => false), null, array('class' => 'prev disabled')); ?>
		</li>
		<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
		<li>
			<?php echo $this->Paginator->next(__('Siguiente') . ' >', array('tag' => false), null, array('class' => 'next disabled')); ?>
		</li>
	</ul>
<?php if ($current_user['role'] == 'compras'): ?>
	<div class="actions">
		<h3><?php echo __('Acciones'); ?></h3>
		<?php echo $this->Html->link(__('Ver piezas'), array('controller' => 'pieces', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva pieza'), array('controller' => 'pieces', 'action' => 'add'), array('class' => 'btn btn-primary')); ?>
	</div>
<?php endif ?>
</div>