<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Nueva venta'); ?></h2>
		</div>
		<?php echo $this->Form->create('Sale', array('role' => 'form', 'class' => 'form-horizontal')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('client', array('class' => 'form-control', 'label' => 'Nombre del cliente')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('dni', array('class' => 'form-control', 'label' => 'DNI')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_id', array('class' => 'form-control', 'label' => 'Producto')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quantity', array('class' => 'form-control', 'label' => 'Cantidad')); ?>
				</div>
				<div class="form-group">
					<div class="input-group">
					<?php echo $this->Form->input('delivery_date', array('class' => 'form-control', 'label' => 'Fecha de entrega')); ?>
					</div>
				</div>

			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Registrar venta', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('Lista de ventas'), array('action' => 'index')); ?></li>
				</ul>
			</div>
	</div>
</div>