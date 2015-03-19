<div class="well">
<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($product['Product']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?> $
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad'); ?></dt>
		<dd>
			<?php echo h($product['Product']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <?php echo __('Actions'); ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
	<li><?php echo $this->Html->link(__('Editar producto'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
	<li><?php echo $this->Form->postLink(__('Eliminar producto'), array('action' => 'delete', $product['Product']['id']), array(), __('Esta seguro ?')); ?> </li>
	<li><?php echo $this->Html->link(__('Lista de productos'), array('action' => 'index')); ?> </li>
	<li><?php echo $this->Html->link(__('Crear producto'), array('action' => 'add')); ?> </li>
  </ul>
</div>