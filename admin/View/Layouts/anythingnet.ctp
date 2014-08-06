<!DOCTYPE HTML>
<html>
<head>

	<?php echo $this->Html->charset(); ?>

  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta http-equiv='cache-control' content='no-cache'>
  <!-- remove on production!!-->

	<title>
		<?php echo $title_for_layout; ?>
	</title>

  <link href="/img/favicon.jpg" type="image/jpg" rel="icon">

	<?php

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->css('bootstrap/bootstrap.min');
		echo $this->Html->css('jquery-ui/smoothness/jquery-ui-1.10.4.min');
		echo $this->Html->css('bootstrap/bootstrap-theme.min');

		echo $this->Html->css('file-upload/jquery.fileupload');

		echo $this->Html->css('style');
		echo $this->Html->css('//fonts.googleapis.com/css?family=Roboto:100,300,400,500,900');
		echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');

    // Bootstrap core JavaScript, and plugins
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery-ui-1.10.4.min');
		echo $this->Html->script('bootstrap/bootstrap.min');

		//echo $this->Html->script('file-upload/jquery.fileupload-image');
		echo $this->Html->script('file-upload/jquery.fileupload');

    //custom javascript
		echo $this->Html->script('script');
	?>

</head>

<body role="document">
  <div id="displayed-content">

    <div id="header" role="navigation" class="navbar navbar-inverse navbar-fixed-top">

      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link('AnythingNet!', '/', array('id' => 'header-logo', 'class' => 'navbar-brand')); ?>
        </div>
        <div class="navbar-collapse collapse">

          <ul class="nav navbar-nav">
            <li><?php echo $this->Html->link('Maps', '/maps/'); ?></li>
            <li><?php echo $this->Html->link('Pages', '/pages/'); ?></li>
            <li><?php echo $this->Html->link('Menu', '/menus/'); ?></li>
            <li><?php echo $this->Html->link('Images', '/images/'); ?></li>
            <li><?php echo $this->Html->link('Settings', '/settings/'); ?></li>
            <li><?php echo $this->Html->link('Logout', '/logout/'); ?></li>
          </ul>

        </div>

      </div>

    </div>

    <?php echo $this->Session->flash(); ?>

    <div id="content-body">
      <?php echo $this->fetch('content'); ?>
    </div>

    <!-- footer for desktop -->

    <div class="row footer footer-collapse clearfix">
      <div class="footer-body">
        <?php echo $this->Html->link('Powered by AnythingNet!', 'https://www.anythingnet.com.au', array('target' => '_blank')); ?>
      </div>
    </div>

  </div>

</body>

</html>

