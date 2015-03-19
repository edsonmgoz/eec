<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Solicitar piezas'); ?></h2>
		</div>
		<?php echo $this->Form->create('Shopping', array('role' => 'form')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('quantity', array('class' => 'form-control', 'label' => 'Cantidad')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('piece_id', array('class' => 'form-control', 'label' => 'Pieza')); ?>
				</div>
			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Solicitar piezas', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('Producir unidades'), array('controller' => 'productions', 'action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('Pedidos pendientes'), array('controller' => 'productions', 'action' => 'pending')); ?> </li>
				</ul>
			</div>
	</div>
</div>