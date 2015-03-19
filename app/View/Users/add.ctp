<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Nuevo usuario'); ?></h2>
		</div>
		<?php echo $this->Form->create('User', array('role' => 'form')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Nombre')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'Usuario')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'Contraseña')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('role', array('class' => 'form-control', 'label' => 'Rol', 'type' => 'select', 'options' => array('ventas' => 'Ventas', 'produccion' => 'Produccion', 'compras' => 'Compras'), array('class' => 'form-control'))); ?>
				</div>
				<div class="form-group">
					<div class="checkbox">
			          <label>
			            <?php echo $this->Form->checkbox('status', array('hiddenField' => false)); ?> Habilitar
			          </label>
			        </div>
				</div>

			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Crear usuario', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
				</ul>
			</div>
	</div>
</div>