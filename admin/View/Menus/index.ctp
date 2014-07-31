<?php echo $this->Html->css('menu'); ?>

<?php echo $this->Session->flash(); ?>

<h1>Menu Management</h1>

<div class="section-left">

  <ul id="menu-area" class="nav nav-tabs">
    <li class="active"><a class="tab-toggler" href="#menu-header" data-toggle="tab">Header</a></li>
    <li><a class="tab-toggler" href="#menu-footer" data-toggle="tab">Footer</a></li>
  </ul>

  <?php echo $this->Form->create('Menu', array('type' => 'post', 'url' => 'index', 'id' => 'menu-form')); ?>
  <div class="tab-content">
    <div class="tab-pane menu-section-pane active" id="menu-header" data-section-id="<?php echo $header_id; ?>">

      <?php foreach ($menu[$header_id] as $group_id => $item) { ?>

        <div class="menutag-group">

        <?php foreach ($item as $order => $item) { ?>

          <div class="bg-primary menutag" data-label="<?php echo $item['label']; ?>" data-url="<?php echo $item['url']; ?>">
            <?php echo $item['label'] . ' - ' . $item['url']; ?>
          </div>

        <?php } ?>

        </div>

      <?php } ?>

    </div>

    <div class="tab-pane menu-section-pane" id="menu-footer" data-section-id="<?php echo $footer_id; ?>">

      <?php foreach ($menu[$footer_id] as $group_id => $item) { ?>

        <div class="menutag-group">

        <?php foreach ($item as $order => $item) { ?>

          <div class="bg-primary menutag" data-label="<?php echo $item['label']; ?>" data-url="<?php echo $item['url']; ?>">
            <?php echo $item['label'] . ' - ' . $item['url']; ?>
          </div>

        <?php } ?>

        </div>

      <?php } ?>

    </div>

  </div> 

  <div id="menu-formdata-area" class="form-group">
    <?php echo $this->Form->submit('Save changes', array('class' => 'btn btn-success save', 'id' => 'btn-save')); ?>
  </div>

  <?php echo $this->Form->end(); ?>

</div>

<div class="section-right">

  <div id="menu-custom-panel" class="panel panel-default">

    <div class="panel-heading"><span class="panel-heading-text">Add Custom Menu</span></div>
    
    <div class="panel-body">

      <div id="menu-custom-label" class="form-group">
        <input type="text" class="page-inputs form-control" placeholder="Menu label" />
      </div>

      <div id="menu-custom-url" class="form-group">
        <input type="text" class="page-inputs form-control" placeholder="Menu URL" />
      </div>

      <div id="menu-custom-button" class="form-group">
        <input type="button" class="btn btn-success" value="Add to menu" />
      </div>

    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-heading"><span class="upload-heading-text">Add From Pages</span></div>
    
    <div class="panel-body">

      <a id="menu-page-selectbtn" class="btn btn-success" data-toggle="modal" data-target="#menu-page-selectmodal">Add from pages</a>

    </div>

  </div>

</div>

<div class="modal fade" id="menu-page-selectmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">Select from pages</div>

      <div class="modal-body">

        <?php foreach ($pages as $i => $page) { ?>
        <div class="form-group input-group page-inputs menu-page-optiongroup">
          <span class="input-group-addon">
            <input class="menu-page-option" type="checkbox" value="1" />
          </span>
          <input class="form-control menu-page-optionlabel" value="<?php echo $page['Page']['name'].' - /'.$page['Page']['slug'].'/'; ?>" type="text" data-label="<?php echo $page['Page']['name']; ?>" data-url="<?php echo $page['Page']['slug']; ?>" disabled />
        </div>
        <?php } ?>

      </div>

      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
        <a id="menu-page-select" class="btn btn-success" disabled>Add the selected pages</a>
      </div>

    </div>
  </div>
</div>

<?php echo $this->Html->script('menu');?>
