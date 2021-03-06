<?php
echo $this->Html->css('checkboost');
echo $this->Html->css('maps');
?>

<div id="whitesheet">
  <?php echo $this->Html->image('/css/img/loader.gif', array('id' => 'loader')); ?>
</div>
<div id="user-map" class="xplorearea collapse in">

  <div class="contentarea">

    <?php echo $this->Html->image('/css/img/label-map.png', array('class' => 'section-label')); ?>

    <div id="map-canvas"></div>

    <?php echo $this->Html->image('/css/img/label-adventure.png', array('class' => 'section-label')); ?>

    <div id="selected-list-box">
      <div class="airplane-mark"></div>
      <div class="selected-adventure">Selected adventure: <span><?php echo $map_object['Map']['name']; ?></span></div>
      <div class="ticketborder hidden-xs hidden-sm"></div>
      <div class="ticket-body row">
        <div class="hidden-xs hidden-sm col-md-3">
          <?php echo $this->Html->image('/css/img/barcode.gif', array('class' => 'barcode')); ?>
        </div>
        <div class="col-xs-12 col-md-9">
          <ul id="selected-list"></ul>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="submitarea">
      <a href="" id="mapdone">
        <?php echo $this->Html->image('/css/img/button-next.png', array('class' => 'button-next')); ?>
      </a>
    </div>

  </div>

</div>

<div id="user-form" class="xplorearea collapse">

  <div class="contentarea">

    <div class="form-area">

      <?php echo $this->Html->image('/css/img/label-seats.png', array('class' => 'section-label')); ?>

      <div class="form-group row">

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 seat-class">
          <label for="seat-economy">
          <?php echo $this->Html->image('/css/img/class-economy.png'); ?>
          </label>
          <input id="seat-economy" class="seat-radio" name="seat" type="radio" value="Economy Class" checked />
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 seat-class">
          <label for="seat-business">
          <?php echo $this->Html->image('/css/img/class-business.png'); ?>
          </label>
          <input id="seat-business" class="seat-radio" name="seat" type="radio" value="Business Class" />
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 seat-class">
          <label for="seat-first">
          <?php echo $this->Html->image('/css/img/class-first.png'); ?>
          </label>
          <input id="seat-first" class="seat-radio" name="seat" type="radio" value="First Class" />
        </div>

      </div>

      <?php echo $this->Html->image('/css/img/label-details.png', array('class' => 'section-label')); ?>

      <div class="form-group">
        <label class="control-label hidden"></label>
        <input id="first_name" class="form-control" type="text" placeholder="First Name" />
      </div>
      <div class="form-group">
        <label class="control-label hidden"></label>
        <input id="last_name" class="form-control" type="text" placeholder="Last Name" />
      </div>
      <div class="form-group">
        <label class="control-label hidden"></label>
        <input id="email" class="form-control" type="text" placeholder="Email" />
      </div>
      <div class="form-group">
        <label class="control-label hidden"></label>
        <input id="phone" class="form-control" type="text" placeholder="Phone" />
      </div>
      <div class="form-group">
        <textarea id="comment" class="form-control" placeholder="Comment"></textarea>
      </div>
      <div class="form-group">
        <input class="hidden-dummy" type="hidden" placeholder="Phone" />
      </div>
    </div>

    <div class="submitarea">
      <div class="submitarea">
        <a href="" id="formdone">
          <?php echo $this->Html->image('/css/img/button-next.png', array('class' => 'button-next')); ?>
        </a>
        <a href="" id="formback">Go back to map</a>
      </div>
    </div>

    <input id="selected-adventure" type="hidden" value="<?php echo $map_object['Map']['name']; ?>" />

  </div>

</div>

<!-- Thank you modal -->
<div id="success-modal" class="modal fade forms-general" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">
        <h4>Thank you</h4>
      </div>

      <div class="modal-body">
      </div>

    </div>
  </div>
</div>

<?php
echo $this->Html->script('pretty-checkable/prettyCheckable.min');

echo $this->Html->scriptBlock(
  'var markerObj = ' . $this->Js->object($map_object['Airport'])
);
echo $this->Html->scriptBlock(
  'var addUrl = ' . $this->Js->object($add_url)
);
echo $this->Html->scriptBlock(
  'var homeUrl = ' . $this->Js->object($home_url)
);
echo $this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAJmHl3cUQ1tttdfZig6Lv0X14S3ekddYk&v=3.exp&sensor=true&libraries=places');
echo $this->Html->script('checkboost');
echo $this->Html->script('maptheme-simple');
echo $this->Html->script('maps');
?>
