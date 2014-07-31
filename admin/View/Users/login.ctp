 <!DOCTYPE HTML>
<html>
<head>

	<?php echo $this->Html->charset(); ?>

  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta http-equiv='cache-control' content='no-cache'>
  <!-- remove on production!!-->

	<title>
    Admin Login
	</title>

  <link href="/img/favicon.jpg" type="image/jpg" rel="icon">

	<?php

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->css('bootstrap/bootstrap.min');
		echo $this->Html->css('jquery-ui/smoothness/jquery-ui-1.10.4.min');
		echo $this->Html->css('bootstrap/bootstrap-theme.min');

		echo $this->Html->css('//fonts.googleapis.com/css?family=Roboto:100,300,400,500,900');
		echo $this->Html->css('users');

    // Bootstrap core JavaScript, and plugins
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery-ui-1.10.4.min');
		echo $this->Html->script('bootstrap/bootstrap.min');

    //custom javascript
		echo $this->Html->script('script');
	?>

</head>

<body>

  <div id="loginbox"> 

    <?php echo $this->Session->flash(); ?>

    <div id="logo">
      <?php echo $this->Html->image('logo.png'); ?>
    </div>

    <div id="login-panel" class="panel panel-primary"> 
      <div class="panel-heading"> 
        Login
      </div> 
      <?php echo $this->Form->create('User', array('type' => 'post')) ?>
      <div class="panel-body"> 
        <div class="form-group">
          <?php echo $this->Form->input('username', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'username', 'label' => false)) ?>
        </div>
        <div class="form-group">
          <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'password', 'label' => false)) ?>
        </div>
        <div class="form-group">
          <!-- <span class="login-message">Loging in...</span> -->
          <?php echo $this->Form->submit('Login', array('id' => 'login-button', 'class' => 'btn btn-primary')) ?>
        </div>
      </div> 
      <?php echo $this->Form->end() ?>
    </div> 
  </div> 

</body>
</html>
