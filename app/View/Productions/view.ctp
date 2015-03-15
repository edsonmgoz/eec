<div class="productions view">
<h2><?php echo __('Production'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($production['Production']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($production['Production']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($production['Product']['name'], array('controller' => 'products', 'action' => 'view', $production['Product']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Production'), array('action' => 'edit', $production['Production']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Production'), array('action' => 'delete', $production['Production']['id']), array(), __('Are you sure you want to delete # %s?', $production['Production']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Productions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Production'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Sales'); ?></h3>
	<?php if (!empty($production['Sale'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Client'); ?></th>
		<th><?php echo __('Dni'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Delivery Date'); ?></th>
		<th><?php echo __('State Production'); ?></th>
		<th><?php echo __('State Sale'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Production Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($production['Sale'] as $sale): ?>
		<tr>
			<td><?php echo $sale['id']; ?></td>
			<td><?php echo $sale['client']; ?></td>
			<td><?php echo $sale['dni']; ?></td>
			<td><?php echo $sale['quantity']; ?></td>
			<td><?php echo $sale['delivery_date']; ?></td>
			<td><?php echo $sale['state_production']; ?></td>
			<td><?php echo $sale['state_sale']; ?></td>
			<td><?php echo $sale['product_id']; ?></td>
			<td><?php echo $sale['production_id']; ?></td>
			<td><?php echo $sale['created']; ?></td>
			<td><?php echo $sale['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sales', 'action' => 'view', $sale['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sales', 'action' => 'edit', $sale['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sales', 'action' => 'delete', $sale['id']), array(), __('Are you sure you want to delete # %s?', $sale['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
