<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Evaluar pedido'); ?></h2>
		</div>
		<p><strong>Producto:</strong></p>
		<p><?php echo $assess[0]['Product']['name']; ?></p>
		<p><strong>Cantidad:</strong></p>
		<p><?php echo $assess[0]['Sale']['quantity']; ?> Uds.</p>
		<p><strong>Total:</strong></p>
		<p><?php echo $assess[0]['Sale']['total']; ?> $</p>
		<?php echo $this->Form->create('Production', array('role' => 'form')); ?>
			<fieldset>
				<?php // echo $this->Form->hidden('id_sale',array('value' => 0)); ?>
				<div class="form-group">
					<div class="input-group">
					<?php echo $this->Form->input('date_production', array(
					    'label' => 'Fecha de entrega',
					    'type'=>'date',
					    'dateFormat' => 'DMY',
					    'minYear' => date('Y'),
					    'maxYear' => date('Y') + 10,
					    'class' => 'form-control'
					)); ?>
					</div>
				</div>

			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Enviar avaluo', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('Pedidos pendientes'), array('action' => 'pending')); ?></li>
				</ul>
			</div>
	</div>
</div>