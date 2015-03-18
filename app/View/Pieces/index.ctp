<div class="col-md-12">
	<div class="page-header margin-none ">
		<h2 class="padding-none"><?php echo __('Piezas'); ?></h2>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Codigo'); ?></th>
			<th><?php echo $this->Paginator->sort('Nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('Precio'); ?> $</th>
			<th><?php echo $this->Paginator->sort('Cantidad'); ?> Uds</th>
			<th><?php echo $this->Paginator->sort('Proveedor'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($pieces as $piece): ?>
		<tr>
			<td><?php echo h($piece['Piece']['code']); ?>&nbsp;</td>
			<td><?php echo h($piece['Piece']['name']); ?>&nbsp;</td>
			<td><?php echo h($piece['Piece']['price']); ?>&nbsp;</td>
			<td><?php echo h($piece['Piece']['quantity']); ?>&nbsp;</td>
			<td><?php echo h($piece['Piece']['provider']); ?>&nbsp;</td>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $piece['Piece']['id']), array('class' => 'btn btn-sm btn-info')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $piece['Piece']['id']), array('class' => 'btn btn-sm btn-success')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $piece['Piece']['id']), array('class' => 'btn btn-sm btn-danger'), __('Esta seguro ?')); ?>

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

	<div class="actions">
		<h3><?php echo __('Acciones'); ?></h3>
		<?php echo $this->Html->link(__('Nueva pieza'), array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
	</div>
</div>