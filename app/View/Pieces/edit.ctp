<div class="pieces form">
<?php echo $this->Form->create('Piece'); ?>
	<fieldset>
		<legend><?php echo __('Edit Piece'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Piece.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Piece.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pieces'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Productions'), array('controller' => 'productions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Production'), array('controller' => 'productions', 'action' => 'add')); ?> </li>
	</ul>
</div>
