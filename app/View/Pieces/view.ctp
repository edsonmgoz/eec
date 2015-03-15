<div class="pieces view">
<h2><?php echo __('Piece'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Piece'), array('action' => 'edit', $piece['Piece']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Piece'), array('action' => 'delete', $piece['Piece']['id']), array(), __('Are you sure you want to delete # %s?', $piece['Piece']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pieces'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Piece'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Productions'), array('controller' => 'productions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Production'), array('controller' => 'productions', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Productions'); ?></h3>
	<?php if (!empty($piece['Production'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $piece['Production']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
	<?php echo $piece['Production']['quantity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Product Id'); ?></dt>
		<dd>
	<?php echo $piece['Production']['product_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Piece Id'); ?></dt>
		<dd>
	<?php echo $piece['Production']['piece_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $piece['Production']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $piece['Production']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Production'), array('controller' => 'productions', 'action' => 'edit', $piece['Production']['id'])); ?></li>
			</ul>
		</div>
	</div>
	