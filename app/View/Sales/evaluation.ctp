<div class="col-md-12">
<?php if(empty($evaluations)){ ?>
	<h3>No hay ningún avalúo pendiente</h3>
	<hr>
<?php }else{ ?>
	<div class="page-header margin-none ">
		<h2 class="padding-none"><?php echo __('Avaluos pendientes'); ?></h2>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Cliente'); ?></th>
			<th><?php echo $this->Paginator->sort('Producto'); ?></th>
			<th><?php echo $this->Paginator->sort('Cantidad'); ?> Uds</th>
			<th><?php echo $this->Paginator->sort('Total producción'); ?> $</th>
			<th><?php echo $this->Paginator->sort('Fecha de entrega'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($evaluations as $evaluation): ?>
		<tr>
			<td><?php echo h($evaluation['Sale']['client']); ?>&nbsp;</td>
			<td><?php echo h($evaluation['Product']['name']); ?>&nbsp;</td>
			<td><?php echo h($evaluation['Sale']['quantity']); ?>&nbsp;</td>
			<td><?php echo h($evaluation['Sale']['total']); ?>&nbsp;</td>
			<td><?php echo h($evaluation['Sale']['date_production']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Añadir utilidad'), array('action' => 'add_utility', $evaluation['Sale']['id']), array('class' => 'btn btn-sm btn-success')); ?>
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