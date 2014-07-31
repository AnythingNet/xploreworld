<?php echo $this->Html->css('pages'); ?>
<?php echo $this->Html->css('summernote/summernote'); ?>
<?php echo $this->Html->script('summernote/summernote.min'); ?>

<?php echo $this->Session->flash(); ?>

<h1>Edit Page</h1>

<?php echo $this->Form->create('Page', array('type' => 'post', 'url' => 'edit')); ?>

  <div class="section-left row">

    <div class="form-group col-lg-6">
      <?php echo $this->Form->label('name', 'Page Name'); ?>
      <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'page-inputs form-control', 'placeholder' => 'Add page name')); ?>
    </div>

    <div class="form-group col-lg-6">
      <?php echo $this->Form->label('title', 'Page Title Tag'); ?>
      <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'page-inputs form-control', 'placeholder' => 'Add page title')); ?>
    </div>

    <div class="form-group col-lg-12">
      <?php echo $this->Form->label('meta_description', 'Page Meta Tag Descriptions'); ?>
      <?php echo $this->Form->input('meta_description', array('type' => 'text', 'class' => 'page-inputs form-control', 'placeholder' => 'Add meta description')); ?>
    </div>

    <div class="form-group col-lg-12">
      <?php echo $this->Form->label('slug', 'Page URL'); ?>
      <div class="input-group page-inputs">
        <span class="input-group-addon"><?php echo FULL_BASE_URL.DS; ?></span>
        <?php echo $this->Form->input('slug', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Add permalink', 'div' => false)); ?>
      </div>
    </div>

    <div id="content-input-area" class="col-lg-12">
      <div class="form-group">
        <a id="add-image" class="btn btn-default" data-toggle="modal" data-target="#img-selectmodal">Add images</a>
      </div>

      <?php echo $this->Form->input('content', array('id' => 'editor')); ?>

      </div>

  </div>

  <div class="section-right">

      <div class="panel panel-default">

        <div class="panel-heading"><span class="upload-heading-text">Action</span></div>

        <ul class="list-group">

          <?php echo $this->Form->hidden('id', array('value' => $id)); ?>
          <li class="list-group-item"><?php echo $this->Form->submit('Save and publish', array('class' => 'btn btn-success', 'name' => 'publish')); ?></li>
          <li class="list-group-item"><?php echo $this->Form->submit('Save as draft', array('class' => 'btn btn-default', 'name' => 'draft')); ?></li>
          <li class="list-group-item">
            <a class="btn btn-danger" data-toggle="modal" data-target="#delete-modal">Delete</a>
          </li>
          <li class="list-group-item"><?php echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-warning')); ?></li>

        </ul>

      </div>

  </div>

<?php echo $this->Form->end(); ?>

<!-- Image select modal -->
<div class="modal fade" id="img-selectmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">Select image</div>

      <div class="modal-body">

        <?php foreach ($images as $i => $image) { ?>
        <div class="form-group input-group page-inputs image-optiongroup">
          <span class="input-group-addon">
            <input name="image-option" class="image-option" type="radio" value="1" />
          </span>
          <img src="<?php echo $image['Media']['abs_path']; ?>" />
        </div>
        <?php } ?>

      </div>

      <div class="modal-footer clearfix">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
        <a id="image-select" class="btn btn-success" disabled>Add the selected pages</a>
      </div>

    </div>
  </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <?php echo $this->Form->create('Page', array('type' => 'post', 'url' => 'delete')); ?>
        <div class="modal-header">Delete this page</div>

        <div class="modal-body">Are you sure you want to delete this page?</div>

        <div class="modal-footer">
          <a class="btn btn-default" data-dismiss="modal">Close</a>
          <?php echo $this->Form->submit('Delete', array('class' => 'btn btn-danger', 'name' => 'delete', 'div' => false)); ?>
          <?php echo $this->Form->hidden('id', array('value' => $id)); ?>
        </div>
      <?php echo $this->Form->end(); ?>

    </div>
  </div>
</div>

<?php echo $this->Html->script('pages'); ?>
