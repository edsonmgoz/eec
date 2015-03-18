    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->html->link('<span class="glyphicon glyphicon-home"></span> E E C', array('action' => 'login'), array('class' => 'navbar-brand', 'escape' => FALSE)); ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User', array('class' => 'navbar-form navbar-right')); ?>
          <div class="form-group">
            <?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Usuario')); ?>
          </div>
          <div class="form-group">
            <?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Contraseña')); ?>
          </div>
          <?php echo $this->Form->end(array('label' => 'Acceder', 'class' =>'btn btn-success', 'div' => false)); ?>

        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Bienvenidos a EEC</h1>
        <p>EEC (Empresa Ensambladora de Computadoras) es una microempresa hecha en Bolivia creada con el proposito de ensamblaje de computadoras de escritorios, laptops y notebooks por mayor y a un precio accesible para nuestros clientes.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Conoce mas de nosotros &raquo;</a></p>
      </div>
    </div>

    <div class="container marketing">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="http://lorempixel.com/200/200/technics/1" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Esamblaje</h2>
          <p>Realizamos Ensamblajes de computadoras de ultima generación para colegios, instituciones, entidades bancarias, universidades y demas.</p>
          <p><a class="btn btn-default" href="#" role="button">Ver Detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="http://lorempixel.com/200/200/technics/2" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Pedidos</h2>
          <p>Puedes realizar tus pedidos visitandonos en nuestra oficina de ventas en horarios de trabajo de lunes a sabados o contactandonos por nuestro sitio web. </p>
          <p><a class="btn btn-default" href="#" role="button">Ver Detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="http://lorempixel.com/200/200/technics/3" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Cotizaciones</h2>
          <p>Tambien realizamos cotizaciones de tus pedidos dependiendo tu capital para invertir y con la garantia que nos caracteriza.</p>
          <p><a class="btn btn-default" href="#" role="button">Ver Detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

      <hr>

      <footer>
        <p>&copy; E.E.C. 2015</p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
