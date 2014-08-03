<?php
echo $this->Html->css('select2/select2-bootstrap');
echo $this->Html->css('select2/select2');
echo $this->Html->script('select2/select2.min');
echo $this->Html->script('pin');
?>

<?php echo $this->Session->flash(); ?>

	<h1>Edit Pin</h1>

  <div id="map-area" class="panel panel-body">

		<?php echo $this->Form->create('MapsAirport', array('type' => 'post', 'url' => 'edit_airport')); ?>

			<div class="row">

				<div class="form-group col-lg-6">
					<?php echo $this->Form->input('country', $selectCountryOptions); ?>
				</div>

				<div class="form-group col-lg-6">
					<?php echo $this->Form->input('airport_id', $selectAirportOptions); ?>
				</div>

				<div class="form-group col-lg-12">
					<?php echo $this->Form->label('description', 'Description'); ?>
					<?php echo $this->Form->textarea('description', array('class' => 'form-control', 'rows' => 3)); ?>
				</div>

			</div>

			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>

			<?php echo $this->Html->link('Cancel', array('action' => 'setting_airports', $map_id), array('class' => 'btn btn-default')); ?>
			<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success', 'div' => false)); ?>

		<?php echo $this->Form->end(); ?>

	</div>
