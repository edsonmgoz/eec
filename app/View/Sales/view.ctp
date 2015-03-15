<div class="well">
<h2><?php echo __('Detalle de venta'); ?></h2>
	<dl>
		<dt><?php echo __('Nombre de cliente'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['client']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DNI'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['dni']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['total']); ?> $
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha de entrega'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['delivery_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Producto'); ?></dt>
		<dd>
			<?php echo h($sale['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <?php echo __('Actions'); ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
	<li><?php echo $this->Html->link(__('Editar venta'), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
	<li><?php echo $this->Form->postLink(__('Cancelar venta'), array('action' => 'delete', $sale['Sale']['id']), array(), __('Estas seguro de cancelar la venta ?')); ?> </li>
	<li><?php echo $this->Html->link(__('Lista de ventas'), array('action' => 'index')); ?> </li>
	<li><?php echo $this->Html->link(__('Nueva venta'), array('action' => 'add')); ?> </li>
  </ul>
</div>

<?php echo $this->Form->postLink(__('Enviar a producción'), array('controller' => 'sales', 'action' => 'confirm', $sale['Sale']['id']), array('class' => 'btn btn-info'), __('Enviar a producción ?')); ?>

<?php
	echo $this->Form->postLink(__('Procesar venta'), array('controller' => 'sales', 'action' => 'sale_process', $sale['Sale']['id']), array('class' => 'btn btn-success'), __('Procesar venta ?'));
?>



