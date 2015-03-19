<?php if (isset($_SESSION['Auth']['User']['id']))
{ ?>

<nav class="navbar navbar-inverse navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo $this->html->link('<span class="glyphicon glyphicon-home"></span> E E C', array('controller' => 'users', 'action' => 'home'), array('class' => 'navbar-brand', 'escape' => FALSE)); ?>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <?php
        if ($current_user['role'] == 'admin')
        {
        ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuarios <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <?php echo $this->html->link('Ver usuarios', array('controller' => 'users', 'action' => 'index')); ?>
              </li>
              <li>
                <?php echo $this->html->link('Agregar usuario', array('controller' => 'users', 'action' => 'add')); ?>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php
        if ($current_user['role'] == 'admin' or $current_user['role'] == 'produccion')
        {
        ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productos <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <?php echo $this->html->link('Ver productos', array('controller' => 'products', 'action' => 'index')); ?>
              </li>
              <li>
                <?php echo $this->html->link('Agregar producto', array('controller' => 'products','action' => 'add')); ?>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php
        if ($current_user['role'] == 'ventas')
        {
        ?>
          <li>
            <?php echo $this->html->link('Registrar venta', array('controller' => 'sales', 'action' => 'add')); ?>
          </li>
          <li>
            <?php echo $this->html->link('Lista de ventas', array('controller' => 'sales', 'action' => 'index')); ?>
          </li>
        <?php } ?>

        <?php
        if ($current_user['role'] == 'admin')
        {
        ?>
          <li>
            <?php echo $this->html->link('Lista de avaluos', array('controller' => 'sales', 'action' => 'evaluation')); ?>
          </li>
          <li>
            <?php echo $this->html->link('Lista de ventas', array('controller' => 'sales', 'action' => 'index')); ?>
          </li>
          <li>
            <?php echo $this->html->link('Lista de piezas', array('controller' => 'productions', 'action' => 'demand')); ?>
          </li>
        <?php } ?>

        <?php
        if ($current_user['role'] == 'produccion')
        {
        ?>
          <li>
            <?php echo $this->html->link('Pedidos pendientes', array('controller' => 'productions', 'action' => 'pending')); ?>
          </li>
          <li>
            <?php echo $this->html->link('Producir unidades', array('controller' => 'productions', 'action' => 'add')); ?>
          </li>
          <li>
            <?php echo $this->html->link('Solicitar piezas', array('controller' => 'shoppings', 'action' => 'add')); ?>
          </li>
          <li>
            <?php echo $this->html->link('Lista de piezas', array('controller' => 'pieces', 'action' => 'index')); ?>
          </li>
        <?php } ?>

        <?php
        if ($current_user['role'] == 'compras')
        {
        ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Piezas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <?php echo $this->html->link('Ver piezas', array('controller' => 'pieces', 'action' => 'index')); ?>
              </li>
              <li>
                <?php echo $this->html->link('Agregar pieza', array('controller' => 'pieces','action' => 'add')); ?>
              </li>
            </ul>
          </li>
        <?php } ?>

<!--         <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <?php echo $this->html->link('Cerrar sesión', array('controller' => 'users', 'action' => 'logout')); ?>
      </ul>
    </div>
  </div>
</nav>
<?php } ?>