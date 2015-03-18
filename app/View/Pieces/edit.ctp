<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2><?php echo __('Editar pieza'); ?></h2>
		</div>
		<?php echo $this->Form->create('Piece', array('role' => 'form')); ?>
			<fieldset>
				<div class="form-group">
					<?php echo $this->Form->input('id'); ?>
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'label' => 'Código')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Nombre')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('price', array('class' => 'form-control', 'label' => 'Precio')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quantity', array('class' => 'form-control', 'label' => 'Cantidad')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('provider', array('class' => 'form-control', 'label' => 'Proveedor', 'type' => 'select', 'options' => array('Importadora WSC computer' => 'Importadora WSC computer', 'Itm parts of machine' => 'Itm parts of machine', 'Tokio Master Engine Parts' => 'Tokio Master Engine Parts'), array('class' => 'form-control'))); ?>
				</div>
			</fieldset>
			<p>
				<?php echo $this->Form->end(array('label' => 'Editar pieza', 'class' =>'btn btn-success')); ?>
			</p>

			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <?php echo __('Acciones'); ?> <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu" role="menu">
					<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Piece.id')), array(), __('Estas seguro ?')); ?></li>
					<li><?php echo $this->Html->link(__('Lista de piezas'), array('action' => 'index')); ?></li>
				</ul>
			</div>
	</div>
</div>
