<div class="col-md-12">
	<div class="page-header margin-none ">
		<h2 class="padding-none"><?php echo __('Pedidos pendientes'); ?></h2>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Producto'); ?></th>
			<th><?php echo $this->Paginator->sort('Cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('Fecha de entrega'); ?></th>
			<th class="actions"><?php echo __('Estado'); ?></th>
			<?php if($current_user['role'] == 'produccion') {?>
			<th class="actions"><?php echo __('Actions'); ?></th>
			<?php } ?>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($sales as $sale): ?>
		<tr>
			<td><?php echo h($sale['Product']['name']); ?>&nbsp;</td>
			<td><?php echo h($sale['Sale']['quantity']); ?>&nbsp;</td>
			<td><?php echo h($sale['Sale']['delivery_date']); ?>&nbsp;</td>
			<td class="text-center">
				<?php
					if($sale['Sale']['state_production'] == true)
					{
						echo "<span class='glyphicon glyphicon-ok text-success' title='Confirmado'></span>";
					}
					elseif($sale['Sale']['state_production'] == false)
					{
						if($sale['Sale']['confirm'] == true)
						{
							echo "<span class='glyphicon glyphicon-time text-warning' title='En espera...'></span>";
						}
						else
						{
							echo "<span class='glyphicon glyphicon-remove text-danger' title='Sin confirmar'></span>";
						}
					}
				?>
			</td>

			<?php if($current_user['role'] == 'produccion') { ?>
			<td class="actions">
				<?php echo $this->Html->link(__('Enviar pedido'), array('action' => 'submit', $sale['Sale']['id']), array('class' => 'btn btn-sm btn-success')); ?>
			</td>
			<?php } ?>
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

	<div class="actions">
		<h3><?php echo __('Acciones'); ?></h3>
		<?php echo $this->Html->link(__('Producir unidades'), array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
	</div>
</div>