<?php echo $this->Html->css('maps'); ?>
<?php echo $this->Html->script('airport'); ?>

<?php echo $this->Session->flash(); ?>

	<h1>Edit Map</h1>

  <div id="map-area" class="panel panel-body">

		<?php echo $this->Form->create('Map', array('type' => 'post', 'url' => 'edit')); ?>

			<div class="row">

				<div class="form-group col-lg-6">
					<?php echo $this->Form->label('name', 'Map Name'); ?>
					<?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Add map name')); ?>
				</div>

        <div class="form-group col-lg-6">
          <?php echo $this->Form->label('slug', 'Page URL'); ?>
          <div class="input-group page-inputs">
            <span class="input-group-addon"><?php echo FULL_BASE_URL.DS; ?></span>
            <?php echo $this->Form->input('slug', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Add url')); ?>
          </div>
        </div>

				<div class="form-group col-lg-12">
					<a class="btn btn-info media-select" data-select-target="add-image" data-toggle="modal" data-target="#media-select-modal">Image Select</a>
				</div>

				<div class="form-group col-lg-6">
					<div id="add-image">
						<?php
							echo $this->Html->image(
								Configure::read('File.url').$image_path
								,array(
									 'class' => 'selected-image'
									,'width' => 100
									,'height' => 100
								)
							);
						?>
						<?php echo $this->Form->input('media_id', array('type' => 'hidden', 'class' => 'media-id')); ?>
						<?php echo $this->Form->error('Map.media_id', 'Please select an image', array('class' => 'alert alert-danger')); ?>
					</div>
				</div>

			</div>

			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<?php echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-default')); ?>
			<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success', 'div' => false)); ?>

		<?php echo $this->Form->end(); ?>

  </div>

	<!-- Media Select Popup -->
	<div class="modal fade" id="media-select-modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<?php echo $this->Form->create('Map', array('type' => 'post', 'url' => 'index')); ?>
					<div class="modal-header">
						<h4 class="modal-title" id="">Image Select</h4>
					</div>

					<div class="modal-body">

						<?php echo $this->Form->input('select_target', array('type' => 'hidden', 'id' => 'select-target')); ?>

						<div id="image-thumbs" style="width:80%; margin: 0 auto;">
							<?php $image_count = 1; ?>
							<?php foreach ($Media as $_media) { ?>

								<?php
									echo $this->Html->image(
										$_media['Media']['abs_path']
										,array(
											 'class' => 'btn media-thumbnail'
											,'data-thumbnail-id' => $_media['Media']['id']
											,'data-thumbnail-path' => $_media['Media']['abs_path']
											,'width' => 100
											,'height' => 100
											,'title' => $_media['Media']['alt']
										)
									);
								?>
								
								<?php if ($image_count % 4 == 0) { ?>
									<br />
								<?php } ?>

								<?php $image_count++; ?>

							<?php } ?>
						</div>

					</div>

					<div class="modal-footer">
							<?php echo $this->Form->button('Close', array('type' => 'button', 'id' => 'close-popup', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
					</div>
				<?php echo $this->Form->end(); ?>

			</div>
		</div>
	</div>
