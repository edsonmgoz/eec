<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Nuevo producto'); ?></h2>
		</div>
		<?php echo $this->Form->create('Product', array('role' => 'form', 'class' => 'form-horizontal')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'label' => 'Código')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Nombre')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('price', array('class' => 'form-control', 'label' => 'Precio $')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quantity', array('class' => 'form-control', 'label' => 'Cantidad')); ?>
				</div>
			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Crear producto', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('Lista de productos'), array('action' => 'index')); ?></li>
				</ul>
			</div>
	</div>
</div>