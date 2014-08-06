<?php
echo $this->Html->css('pages');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->Html->css('select2/select2');
echo $this->Html->css('summernote/summernote');
echo $this->Html->script('select2/select2.min');
echo $this->Html->script('pin');
echo $this->Html->script('summernote/summernote.min');
?>

<?php echo $this->Session->flash(); ?>

	<h1>Add New Pin</h1>

  <div id="map-area" class="panel panel-body">

		<?php echo $this->Form->create('MapsAirport', array('type' => 'post', 'url' => 'add_airport')); ?>

			<div class="row">

				<div class="form-group col-lg-6">
					<?php echo $this->Form->input('country', $selectCountryOptions); ?>
				</div>

				<div class="form-group col-lg-6">
					<?php echo $this->Form->input('airport_id', $selectAirportOptions); ?>
				</div>

				<div class="form-group col-lg-12">
          <div class="form-group">
            <a id="add-image" class="btn btn-default" data-toggle="modal" data-target="#img-selectmodal">Add images</a>
          </div>
					<?php echo $this->Form->label('description', 'Description'); ?>
          <?php echo $this->Form->textarea('description', array('id' => 'editor', 'class' => 'form-control')); ?>
				</div>

			</div>

			<?php echo $this->Form->input('map_id', array('type' => 'hidden', 'value' => $map_id)); ?>

			<?php echo $this->Html->link('Cancel', array('action' => 'setting_airports', $map_id), array('class' => 'btn btn-default')); ?>
			<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success', 'div' => false)); ?>

		<?php echo $this->Form->end(); ?>

	</div>

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

<?php echo $this->Html->script('editor_airports'); ?>
<?php echo $this->Html->script('pages'); ?>
