<?php echo $this->Html->css('settings'); ?>

<?php echo $this->Session->flash(); ?>

<h1>Settings</h1>

  <div id="setting-area" class="panel panel-default">
    <div class="panel-heading">Settings</div>

    <?php echo $this->Form->create('Setting', array('type' => 'post', 'url' => 'index')); ?>

    <div class="panel-body">

      <div class="row">

        <div class="form-group col-lg-6">
          <?php echo $this->Form->input('site_title', array('type' => 'text', 'class' => 'form-control')); ?>
        </div>

        <div class="form-group col-lg-6">
          <?php echo $this->Form->input('email', array('type' => 'text', 'class' => 'form-control')); ?>
        </div>

        <div class="form-group col-lg-12">
          <?php echo $this->Form->label('analytics_code', 'Analytics Code'); ?>
          <?php echo $this->Form->textarea('analytics_code', array('class' => 'form-control', 'rows' => 3)); ?>
        </div>

        <div class="form-group col-lg-3">
          <?php echo $this->Form->label('home_page_id', 'Home Page'); ?>
          <?php echo $this->Form->select('home_page_id', $pages, array('class' => 'form-control', 'empty' => false)); ?>
        </div>

        <div class="form-group col-lg-3">
          <?php echo $this->Form->label('theme', 'Theme'); ?>
          <?php echo $this->Form->select('theme', $themes, array('class' => 'form-control')); ?>
        </div>

        <div class="form-group col-lg-12">
          <?php echo $this->Form->submit('Save', array('class' => 'btn btn-success')); ?>
        </div>

      </div>

    </div>

    <?php echo $this->Form->end(); ?>

  </div>
