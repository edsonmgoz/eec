<div class="well">
<h2><?php echo __('Detalle de pieza'); ?></h2>
	<dl>
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
		<dt><?php echo __('Precio'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['price']); ?> $
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['quantity']); ?> Uds.
			&nbsp;
		</dd>
		<dt><?php echo __('Proveedor'); ?></dt>
		<dd>
			<?php echo h($piece['Piece']['provider']); ?>
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

<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <?php echo __('Actions'); ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
	<li><?php echo $this->Html->link(__('Editar pieza'), array('action' => 'edit', $piece['Piece']['id'])); ?> </li>
	<li><?php echo $this->Form->postLink(__('Eliminar pieza'), array('action' => 'delete', $piece['Piece']['id']), array(), __('Esta seguro?')); ?> </li>
	<li><?php echo $this->Html->link(__('Lista de piezas'), array('action' => 'index')); ?> </li>
	<li><?php echo $this->Html->link(__('Nueva pieza'), array('action' => 'add')); ?> </li>
  </ul>
</div>