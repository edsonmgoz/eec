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

	<div class="related">
		<h3><?php echo __('Related Productions'); ?></h3>
	<?php if (!empty($product['Production'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $product['Production']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
	<?php echo $product['Production']['quantity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Product Id'); ?></dt>
		<dd>
	<?php echo $product['Production']['product_id']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Production'), array('controller' => 'productions', 'action' => 'edit', $product['Production']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Sales'); ?></h3>
	<?php if (!empty($product['Sale'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $product['Sale']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
	<?php echo $product['Sale']['client']; ?>
&nbsp;</dd>
		<dt><?php echo __('Dni'); ?></dt>
		<dd>
	<?php echo $product['Sale']['dni']; ?>
&nbsp;</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
	<?php echo $product['Sale']['quantity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Delivery Date'); ?></dt>
		<dd>
	<?php echo $product['Sale']['delivery_date']; ?>
&nbsp;</dd>
		<dt><?php echo __('State Production'); ?></dt>
		<dd>
	<?php echo $product['Sale']['state_production']; ?>
&nbsp;</dd>
		<dt><?php echo __('State Sale'); ?></dt>
		<dd>
	<?php echo $product['Sale']['state_sale']; ?>
&nbsp;</dd>
		<dt><?php echo __('Product Id'); ?></dt>
		<dd>
	<?php echo $product['Sale']['product_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Production Id'); ?></dt>
		<dd>
	<?php echo $product['Sale']['production_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $product['Sale']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $product['Sale']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Sale'), array('controller' => 'sales', 'action' => 'edit', $product['Sale']['id'])); ?></li>
			</ul>
		</div>
	</div>
