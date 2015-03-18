<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Producir unidades'); ?></h2>
		</div>
		<?php echo $this->Form->create('Production', array('role' => 'form')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('quantity', array('class' => 'form-control', 'label' => 'Cantidad')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_id', array('class' => 'form-control', 'label' => 'Producto')); ?>
				</div>
			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Producir unidades', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('Unidades producidas'), array('action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('Lista de productos'), array('controller' => 'products', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Nuevo producto'), array('controller' => 'products', 'action' => 'add')); ?> </li>
				</ul>
			</div>
	</div>
</div>