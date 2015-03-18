<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Añadir utilidad'); ?></h2>
		</div>
		<p><strong>Producto:</strong></p>
		<p><?php echo $assess[0]['Product']['name']; ?></p>
		<p><strong>Cantidad:</strong></p>
		<p><?php echo $assess[0]['Sale']['quantity']; ?> Uds.</p>
		<p><strong>Total:</strong></p>
		<p><?php echo $assess[0]['Sale']['total']; ?> $</p>
		<?php echo $this->Form->create('Sale', array('role' => 'form')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('utility', array('class' => 'form-control', 'label' => 'Utilidad $')); ?>
				</div>
				<?php echo $this->Form->hidden('total',array('value' => $assess[0]['Sale']['total'])); ?>

			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Confirmar venta', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('Avaluos pendientes'), array('action' => 'evaluation')); ?></li>
				</ul>
			</div>
	</div>
</div>