<div class="col-md-12">
	<div class="page-header margin-none ">
		<h2 class="padding-none"><?php echo __('Productos'); ?></h2>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Código'); ?></th>
			<th><?php echo $this->Paginator->sort('Nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('Precio'); ?> $</th>
			<th><?php echo $this->Paginator->sort('Cantidad'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($products as $product): ?>
		<tr>
			<td><?php echo h($product['Product']['code']); ?>&nbsp;</td>
			<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
			<td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
			<td><?php echo h($product['Product']['quantity']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-sm btn-info')); ?>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-sm btn-success')); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-sm btn-danger'), __('Esta seguro ?')); ?>
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
		<?php echo $this->Html->link(__('Nuevo producto'), array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
	</div>
</div>