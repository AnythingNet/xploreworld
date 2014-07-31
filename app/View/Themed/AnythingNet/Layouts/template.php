<!DOCTYPE HTML>
<html>
<head>

	<?php echo $this->Html->charset(); ?>

  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta http-equiv='cache-control' content='no-cache'>
  <!-- remove on production!!-->

	<title><?php echo $title_for_layout; ?></title>

	<?php

		echo $this->Html->meta('description', $meta_description);

		echo $this->Html->css('bootstrap/bootstrap.min');

		echo $this->Html->script('script');

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
            <?php foreach ($header as $group => $menu) { ?>
        
              <?php if (!isset($menu['children'])) { ?>

                <li><?php echo $this->Html->link($menu['parent']['label'], $menu['parent']['url']); ?></li>

              <?php } else {  ?>

                <li class="dropdown">
                  <a href="<?php echo $menu['parent']['url']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['parent']['label']; ?><b class="caret"></b></a>
                  <ul class="dropdown-menu">

                    <?php foreach ($menu['children'] as $order => $child) { ?>

                      <li><?php echo $this->Html->link($child['label'], $child['url']); ?></li>

                    <?php }  ?>

                  </ul>
                </li>

              <?php } ?>

            <?php } ?>

          </ul>

        </div>

      </div>

    </div>

    <?php echo $this->Session->flash(); ?>

    <div id="content-body">
      <?php echo $this->fetch('content'); ?>
    </div>

    <!-- footer for desktop -->

    <div class="row footer top footer-collapse footer-desktop hidden-sm hidden-xs" role="navigation"> 

      <div class="footer-body">

        <?php foreach ($footer as $group => $menu) { ?>

          <div class="footer-list left">
            <dl>

              <dt><?php echo $this->Html->link($menu['parent']['label'], $menu['parent']['url']); ?></dt>
      
            <?php if (isset($menu['children'])) { ?>

              <?php foreach ($menu['children'] as $order => $child) { ?>

                <dd><?php echo $this->Html->link($child['label'], $child['url']); ?></dd>

              <?php }  ?>

            <?php } ?>

            </dl>
          </div>

        <?php } ?>

      </div>
    </div>


  </div>

</body>

</html>

