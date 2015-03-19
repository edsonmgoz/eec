<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2>Solicitar pieza <?php echo $pieces['Piece']['name']; ?></h2>
		</div>
		<p><strong>Cantidad actual:</strong></p>
		<p><?php echo $pieces['Piece']['quantity']; ?> Uds</p>
		<?php echo $this->Form->create('Shopping', array('role' => 'form')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('quantity', array('class' => 'form-control', 'label' => 'Cantidad a solicitar')); ?>
					<?php echo $this->Form->hidden('piece_id',array('value' => $pieces['Piece']['id'])); ?>
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