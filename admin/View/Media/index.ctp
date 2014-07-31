<?php echo $this->Html->css('media'); ?>

<?php echo $this->Session->flash(); ?>

<h1>Image Management</h1>

  <div id="upload-area" class="panel panel-default">
    <div class="panel-heading"><span class="upload-heading-text">Upload an image</span></div>

    <?php echo $this->Form->create('Media', array('type' => 'file', 'url' => 'new_upload', 'id' => 'fileupload')); ?>

    <div class="panel-body">
      <p></p>
      <span class="btn btn-success fileinput-button">
        <span class="glyphicon glyphicon-upload"></span>
        <span>Add image</span>
        <?php echo $this->Form->input('file', array('type' => 'file', 'label' => false)); ?>
      </span>
      <span>&nbsp;or simply drag & drop here</span>

      <div id="createarea" class="media">

        <a class="pull-left" href="#">
          <?php //echo $this->Html->image(null, array('alt' => '', 'id' => 'upload-thumb', 'class' => 'media-thumb')); ?>
        </a>
        <div class="media-body add-attribute">
          <div class="form-group">
            <span id="file-name-waiting"></span>
            <?php echo $this->Form->input('alt', array('type' => 'text', 'id' => 'upload-alt', 'class' => 'form-control', 'placeholder' => 'Add alt description if needed', 'label' => false)); ?>
          </div>
          <div class="form-group">
            <a id="btn-upload" class="btn btn-success">Upload</a>
          </div>
        </div>
      </div>

    </div>

    <?php echo $this->Form->end(); ?>

  </div>

  <!-- Table -->
  <div class="panel panel-default">
    <div class="panel-heading">Uploaded images</div>
    <div class="panel-body">
      <table class="table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Size</th>
            <th>Width</th>
            <th>Height</th>
            <th>File name</th>
            <th>Alt</th>
            <th>Created Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($files as $i => $file) { ?>
          <tr>
            <th><?php echo $this->Html->image($file['Media']['abs_path'], array('alt' => '', 'class' => 'media-thumb')); ?></th>
            <td><?php echo $file['Media']['size']; ?></td>
            <td><?php echo $file['Media']['width']; ?></td>
            <td><?php echo $file['Media']['height']; ?></td>
            <td><?php echo $file['Media']['path']; ?></td>
            <td><?php echo $file['Media']['alt']; ?></td>
            <td><?php echo $file['Media']['created']; ?></td>
            <td>
              <a class="btn btn-success" data-toggle="modal" data-target="#edit-modal<?php echo $file['Media']['id']; ?>">Edit Alt</a>
              <a class="btn btn-danger" data-toggle="modal" data-target="#delete-modal<?php echo $file['Media']['id']; ?>">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Edit Popup -->
  <?php foreach ($files as $i => $file) { ?>
    <div class="modal fade" id="edit-modal<?php echo $file['Media']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <?php echo $this->Form->create('Media', array('type' => 'post', 'url' => 'edit')) ?>

            <div class="modal-header">
              <h4 class="modal-title" id="">Edit Alt Description</h4>
            </div>
            <div class="modal-body">


              <div id="createarea" class="media">

                <a class="pull-left">
                  <?php echo $this->Html->image($file['Media']['abs_path'], array('id' => 'edit-img', 'class' => 'media-thumb')); ?>
                </a>
                <div class="media-body add-attribute">
                  <div class="form-group">
                    <?php echo $this->Form->input('alt', array('type' => 'text', 'value' => $file['Media']['alt'], 'class' => 'form-control', 'placeholder' => 'alt description', 'label' => false)) ?>
                    <?php echo $this->Form->hidden('id', array('value' => $file['Media']['id'])) ?>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <?php echo $this->Form->button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
              <?php echo $this->Form->submit('Save Change', array('type' => 'submit', 'class' => 'btn btn-success', 'div' => false, 'value' => $file['Media']['id'])) ?>
            </div>

          <?php echo $this->Form->end(); ?>

        </div>
      </div>
    </div>
  <?php } ?>

  <!-- Delete Popup -->
  <?php foreach ($files as $i => $file) { ?>
    <div class="modal fade" id="delete-modal<?php echo $file['Media']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <?php echo $this->Form->create('Media', array('type' => 'post', 'url' => 'delete')) ?>

            <div class="modal-header">
              <h4 class="modal-title" id="">Delete Image</h4>
            </div>
            <div class="modal-body">

              <div id="createarea" class="media">

                <a class="pull-left">
                  <?php echo $this->Html->image($file['Media']['abs_path'], array('id' => 'edit-img', 'class' => 'media-thumb')); ?>
                </a>
                <div class="media-body add-attribute">
                  <div class="form-group">
                    <?php echo $this->Form->label(null, 'Are you sure you want to delete this image?') ?>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <?php echo $this->Form->hidden('id', array('value' => $file['Media']['id'])) ?>
              <?php echo $this->Form->button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
              <?php echo $this->Form->submit('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'div' => false, 'value' => $file['Media']['id'])) ?>
            </div>

          <?php echo $this->Form->end(); ?>

        </div>
      </div>
    </div>
  <?php } ?>

<?php echo $this->Html->script('media'); ?>
