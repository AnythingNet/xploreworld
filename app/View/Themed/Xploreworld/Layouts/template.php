<!DOCTYPE HTML>
<html>

<head>

	<?php echo $this->Html->charset(); ?>

  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <!-- remove on production!!-->

	<title><?php echo $title_for_layout; ?></title>

	<?php

		echo $this->Html->meta('description', $meta_description);

		echo $this->Html->script('script');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->css('bootstrap/bootstrap.min');
		echo $this->Html->css('jquery-ui/smoothness/jquery-ui-1.10.4.min');
		echo $this->Html->css('bootstrap/bootstrap-theme.min');

		//echo $this->Html->css('style');
		echo $this->Html->css('//fonts.googleapis.com/css?family=Roboto:100,300,400,500,900');
		echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
		echo $this->Html->css('custom');

    // Bootstrap core JavaScript, and plugins
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery-ui-1.10.4.min');
		echo $this->Html->script('bootstrap/bootstrap.min');

    //custom javascript
		echo $this->Html->script('script');

	?>


</head>

<body role="document">

  <div id="displayed-content">

  <nav class="navbar navbar-default header-shelf" role="navigation">
    <div class="container-fluid">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header header-items">

        <div class="row">

          <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <a class="navbar-brand logo-link" href="<?php echo Router::url('/'); ?>"><?php echo $this->Html->image('/css/img/logo.png', array('class' => 'logo')); ?></a>
          </div>

          <div class="hidden-xs col-sm-3 col-md-3 col-lg-3 airplain">
            <?php echo $this->Html->image('/css/img/airplain-active.png', array('class' => 'airplain-icon')); ?>
            <?php echo $this->Html->image('/css/img/airplain-line-inactive.png', array('class' => 'airplain-line hidden-sm')); ?>
            <div class="caption">
              <h3>Step 1</h3>
              <p>Select Your Adventure</p>
            </div>
          </div>

          <div class="hidden-xs col-sm-3 col-md-3 col-lg-3 airplain">
            <?php echo $this->Html->image('/css/img/airplain-inactive.png', array('class' => 'airplain-icon')); ?>
            <?php echo $this->Html->image('/css/img/airplain-line-inactive.png', array('class' => 'airplain-line hidden-sm')); ?>
            <div class="caption">
              <h3>Step 2</h3>
              <p>Select Your Destinations</p>
            </div>
          </div>

          <div class="hidden-xs col-sm-3 col-md-3 col-lg-3 airplain">
            <?php echo $this->Html->image('/css/img/airplain-inactive.png', array('class' => 'airplain-icon')); ?>
            <div class="caption">
              <h3>Step 3</h3>
              <p>Confirm Details</p>
            </div>
          </div>

        </div>

      </div>

    </div><!-- /.container-fluid -->
  </nav>

  <div class="clearfix"></div>

  <?php echo $this->Session->flash(); ?>

  <div id="content-body">
    <?php echo $this->fetch('content'); ?>
  </div>

  </div>

  <footer>
    <span>Copyright: Xploreworld</span> 
  </footer>

</body>

</html>

