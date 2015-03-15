<?php echo $this->Html->css('carousel'); ?>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
    	<?php echo $this->Html->image('1.jpg', array('alt' => 'imagen uno')); ?>
      <div class="container">
        <div class="carousel-caption">
          <h1>Produciendo tu Pedido.</h1>
          <p>EEC piensa en ti como uno mas de nuestra familia y produce la mas alta calidad en computadoras para tu satisfacción.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
        </div>
      </div>
    </div>
    <div class="item">
    	<?php echo $this->Html->image('2.jpg', array('alt' => 'imagen dos')); ?>
      <div class="container">
        <div class="carousel-caption">
          <h1>Al Día con la Tecnología</h1>
          <p>Contamos con la mas alta tecnología en ensamble para brindarte los productos mas certificados y con garantía.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
        </div>
      </div>
    </div>
    <div class="item">
    	<?php echo $this->Html->image('3.jpg', array('alt' => 'imagen uno')); ?>

      <div class="container">
        <div class="carousel-caption">
          <h1>Tu satisfacción es la nuestra.</h1>
          <p>Porque cumplimos tus espectativas y tus demandas son nuestra prioridad.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div><!-- /.carousel -->



<div class="Welcome">
	<p class="Welcome-message">
		<?php
		if ($logged_in)
		{?>
			<h2 class="Welcome-user">Bienvenido <?php echo $current_user['role'] ." ".$current_user['username']; ?> </h2>
		<?php
		}
		?>
	</p>
</div>