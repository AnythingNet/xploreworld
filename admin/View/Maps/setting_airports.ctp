<?php
echo $this->Html->css('select2/select2-bootstrap');
echo $this->Html->css('select2/select2');
?>

<?php echo $this->Session->flash(); ?>

<h1>Maps</h1>

  <div id="map-area" class="panel panel-default">

    <div class="panel-heading">Maps</div>

			<div class="form-group col-lg-12">
				<a class="btn btn-info" data-toggle="modal" data-target="#add-pin-modal">Add Pin</a>
			</div>

    <?php echo $this->Form->create('Maps', array('type' => 'post', 'url' => 'index')); ?>


    <?php echo $this->Form->end(); ?>

  </div>

	<?php if (isset($Pins)) { ?>

		<div class="panel">

			<?php echo  $this->Paginator->numbers(); ?>

			<table class="table">

				<thead>
					<tr>
						<th>Airport</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
				
					<?php foreach ($Pins as $_pin) { ?>

						<tr>
							<td><?php echo $_pin['Airport']['name']; ?></td>
							<td><?php echo nl2br($_pin['MapsAirport']['description']); ?></td>
							<td>
								<a class="btn btn-info" data-toggle="modal" data-target="#edit-pin-modal-<?php echo $_pin['MapsAirport']['id']; ?>">Edit</a>
								<a class="btn btn-danger" data-toggle="modal" data-target="#delete-pin-modal">Delete</a>
							</td>
						</tr>

						<!-- Edit Pin Popup -->
						<div class="modal fade" id="edit-pin-modal-<?php echo $_pin['MapsAirport']['id']; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">

									<?php echo $this->Form->create('MapsAirport', array('type' => 'post', 'url' => 'edit_airport')); ?>

										<div class="modal-header">
											<h4 class="modal-title" id="">Edit Pin</h4>
										</div>

										<div class="modal-body">

											<div class="panel-body">

												<div class="row">

													<div class="form-group col-lg-12">
														<?php echo $this->Form->label('description', 'Description'); ?>
														<?php
															echo $this->Form->textarea('description', array('class' => 'form-control', 'rows' => 3, 'value' => $_pin['MapsAirport']['description']));
														?>
													</div>

												</div>

												<div class="form-group col-lg-12">
													<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $_pin['MapsAirport']['id'])); ?>
													<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success')); ?>
												</div>

											</div>

										</div>

										<div class="modal-footer">
												<?php echo $this->Form->button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
										</div>

									<?php echo $this->Form->end(); ?>

								</div>
							</div>
						</div>

					<?php } ?>

				</tbody>

			</table>
		</div>


	<?php } ?>

	<!-- Add Pin Popup -->
	<div class="modal fade" id="add-pin-modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">

				<?php echo $this->Form->create('Map', array('type' => 'post', 'url' => 'add_airport')); ?>

					<div class="modal-header">
						<h4 class="modal-title" id="">Add Pin</h4>
					</div>

					<div class="modal-body">

						<div class="panel-body">

							<div class="row">

								<div class="form-group col-lg-6">
									<?php echo $this->Form->input('airport_id', $selectAirportOptions); ?>
								</div>

								<div class="form-group col-lg-12">
									<?php echo $this->Form->label('description', 'Description'); ?>
									<?php echo $this->Form->textarea('description', array('class' => 'form-control', 'rows' => 3)); ?>
								</div>

							</div>

							<div class="form-group col-lg-12">
								<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success')); ?>
							</div>

						</div>

					</div>

					<div class="modal-footer">
							<?php echo $this->Form->button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
					</div>

				<?php echo $this->Form->end(); ?>

			</div>
		</div>
	</div>

<?php
echo $this->Html->script('select2/select2.min');
echo $this->Html->script('airport');
?>
