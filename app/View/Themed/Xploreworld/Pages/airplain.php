<?php echo $this->Html->css('home'); ?>
<div class="home-container">

  <div class="label">
    <?php echo $this->Html->image('/css/img/label-top.png'); ?>
  </div>
  
  <div class="row lights">  

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="lightbulb"></div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="lightbulb"></div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="lightbulb"></div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="lightbulb"></div>
    </div>

  </div>  

  <div class="row window-body">  

    <?php foreach ($maps as $map) { ?>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 window-column">
        <div class="window">
          <a href="<?php echo $map['Map']['url']; ?>">
          <div class="window-frame inner"></div>
          <div class="window-frame cover"></div>
          <div class="window-frame outer"></div>
          <div class="window-frame outer"></div>
            <?php echo $this->Html->image($map['Media']['path'], array('class' => 'window-content')); ?>
          </a>
        </div>
      </div>
    <?php } ?>

  </div> 

</div>
<?php
echo $this->Html->script('home.js');
?>
