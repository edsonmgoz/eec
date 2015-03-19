<div class="col-md-12">
	<div class="page-header margin-none ">
		<h2 class="padding-none"><?php echo __('Piezas pendientes'); ?></h2>
	</div>

<?php if (empty($shoppings)) { ?>
<h3>No hay compras pendientes</h3>
<?php }else{ ?>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('Pieza'); ?></th>
				<th><?php echo $this->Paginator->sort('Cantidad'); ?> Uds</th>
				<th><?php echo $this->Paginator->sort('Costo del pedido'); ?> $</th>
				<th><?php echo 'Autorización'; ?></th>
				<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($shoppings as $shopping): ?>
		<tr>
			<td><?php echo h($shopping['Piece']['name']); ?>&nbsp;</td>
			<td><?php echo h($shopping['Shopping']['quantity']); ?>&nbsp;</td>
			<td><?php echo $shopping['Shopping']['quantity'] * $shopping['Piece']['price'] ?></td>
			<td class="text-center">
				<?php
				if ($shopping['Shopping']['state_shopping'] == 0)
				{
					echo "<span class='glyphicon glyphicon-remove text-danger' title='Sin autorización.'></span>";
				}
				elseif ($shopping['Shopping']['state_shopping'] == 1)
				{
					echo "<span class='glyphicon glyphicon-time text-warning' title='En espera...'></span>";
				}
				elseif ($shopping['Shopping']['state_admin'] == 1)
				{
					echo "<span class='glyphicon glyphicon-ok text-success' title='Autorizado'></span>";
				}
				?>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Autorizar'), array('action' => 'authorize', $shopping['Shopping']['id']), array('class' => 'btn btn-sm btn-success')); ?>
			</td>
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


<?php } ?>

</div>