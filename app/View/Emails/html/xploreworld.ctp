<div style="margin: 0 0; background-color: #C6D3DA; width: 100%; max-width: 600px;">

  <a href="http://xploreworld.anythingnet.com.au">
    <img src="http://xploreworld.anythingnet.com.au/app/webroot/xploreworld/css/img/logo.png" style="width: 150px" />
  </a>

    <div style="padding:15px;">

      <h2 style="color: #393939; text-align: center;"><?php echo $email_heading; ?></h2>
      <h3 style="color: #393939; text-align: center;"><?php echo $email_subheading; ?></h3>
        
      <div style="color: #393939;">
        <span>Name: <?php echo $name; ?></span><br />
        <span>Email: <?php echo $email; ?></span><br />
        <span>Phone: <?php echo $phone; ?></span><br />
        <span>Selected seat: <?php echo $seat; ?></span><br />
        <span>Comment: <?php echo $comment; ?></span><br />
        <span>Selected adventure: <?php echo $adventure; ?></span><br />
        <span>Selected destinations:</span>
      
        <br />
        <br />

        <?php foreach ($destinations as $destination) { ?>
          <span><?php echo $destination; ?></span><br />
        <?php } ?>

      </div>

    </div>

</div>
