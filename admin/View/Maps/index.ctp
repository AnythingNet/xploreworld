
<?php echo $this->Session->flash(); ?>

<h1>Maps</h1>

  <div id="map-area" class="panel panel-default">
    <div class="panel-heading">Maps</div>

		<div class="form-group col-lg-12">
			<a class="btn btn-info" data-toggle="modal" data-target="#add-map-modal">Add new map</a>
		</div>

  </div>

	<?php if (isset($Maps)) { ?>

		<div class="panel">
			<table class="table">

				<thead>
					<tr>
						<th>Map Name</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
				
					<?php foreach ($Maps as $_map) { ?>

						<tr>

							<td><?php echo $_map['Map']['name']; ?></td>
							<td>
								<?php
									$image_path = str_replace('\\', '/', Configure::read('File.url').$_map['Media']['path']);
									echo $this->Html->image($image_path, array('width' => 100,'height' => 100));
								?>
							</td>

							<td>
								<a href="setting_airports?id=<?php echo $_map['Map']['id']; ?>" class="btn btn-info">Pin</a>

								<a class="btn btn-info" data-toggle="modal" data-target="#edit-modal-<?php echo $_map['Map']['id']; ?>">Edit</a>

								<a class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_map['Map']['id']; ?>">Delete</a>

							</td>

						</tr>

						<!-- Edit modal -->
						<div class="modal fade" id="edit-modal-<?php echo $_map['Map']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">

									<?php echo $this->Form->create('Map', array('type' => 'post', 'url' => 'edit')); ?>
										<div class="modal-header">Edit this page</div>

										<div class="modal-body">
											<div class="row">

												<div class="form-group col-lg-6">
													<?php echo $this->Form->input('name', array('type' => 'text', 'value' => $_map['Map']['name'], 'class' => 'form-control')); ?>
												</div>

												<div class="form-group col-lg-6">
													<?php echo $this->Form->input('slug', array('type' => 'text', 'value' => $_map['Map']['slug'], 'class' => 'form-control')); ?>
												</div>

												<div class="form-group col-lg-12">
												<a class="btn btn-info media-select" data-select-target="edit-image-<?php echo $_map['Map']['id']?>" data-toggle="modal" data-target="#media-select-modal">Image Select</a>
												</div>
												<div class="form-group col-lg-6">
												<div id="edit-image-<?php echo $_map['Map']['id'];?>">
														<?php
															echo $this->Html->image($image_path
																,array(
																	 'class' => 'selected-image'
																	,'width' => 100
																	,'height' => 100
																)
															);
														?>
														<?php echo $this->Form->input('media_id', array('type' => 'hidden', 'class' => 'media-id', 'value' => $_map['Media']['id'])); ?>
														<?php echo $this->Form->error('Map.media_id', null, array('class' => 'alert alert-danger')); ?>
													</div>
												</div>

											</div>
										</div>

										<div class="modal-footer">
											<?php echo $this->Form->button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
											<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success', 'name' => 'edit', 'div' => false)); ?>
											<?php echo $this->Form->hidden('id', array('value' => $_map['Map']['id'])); ?>
										</div>
									<?php echo $this->Form->end(); ?>

								</div>
							</div>
						</div>

						<!-- Delete modal -->
						<div class="modal fade" id="delete-modal-<?php echo $_map['Map']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">

									<?php echo $this->Form->create('Map', array('type' => 'post', 'url' => 'delete')); ?>
										<div class="modal-header">Delete this map</div>

										<div class="modal-body">Are you sure you want to delete this map?</div>

										<div class="modal-footer">
											<a class="btn btn-default" data-dismiss="modal">Close</a>
											<?php echo $this->Form->submit('Delete', array('class' => 'btn btn-danger', 'name' => 'delete', 'div' => false)); ?>
											<?php echo $this->Form->hidden('id', array('value' => $_map['Map']['id'])); ?>
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

	<!-- Add Map Popup -->
	<div class="modal fade" id="add-map-modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">

				<?php echo $this->Form->create('Map', array('type' => 'post', 'url' => 'index')); ?>

					<div class="modal-header">
						<h4 class="modal-title" id="">Add Map</h4>
					</div>

					<div class="modal-body">

						<div class="panel-body">

							<div class="row">

								<div class="form-group col-lg-6">
									<?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control')); ?>
								</div>

								<div class="form-group col-lg-6">
									<?php echo $this->Form->input('slug', array('type' => 'text', 'class' => 'form-control')); ?>
								</div>

								<div class="form-group col-lg-12">
									<a class="btn btn-info media-select" data-select-target="add-image" data-toggle="modal" data-target="#media-select-modal">Image Select</a>
								</div>

								<div class="form-group col-lg-6">
									<div id="add-image">
										<?php
											echo $this->Html->image('http://localhost/xploreworld/img/no_image.gif'
												,array(
													 'class' => 'selected-image'
													,'width' => 100
													,'height' => 100
												)
											);
										?>
										<?php echo $this->Form->input('media_id', array('type' => 'hidden', 'class' => 'media-id')); ?>
										<?php echo $this->Form->error('Map.media_id', null, array('class' => 'alert alert-danger')); ?>
									</div>
								</div>

							</div>

						</div>

					</div>

					<div class="modal-footer">
							<?php echo $this->Form->button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) ?>
							<?php echo $this->Form->submit('Save', array('class' => 'btn btn-success', 'div' => false)); ?>

					</div>

				<?php echo $this->Form->end(); ?>

			</div>
		</div>
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
										str_replace('\\', '/', $_media['Media']['abs_path'])
										,array(
											 'class' => 'btn media-thumbnail'
											,'data-thumbnail-id' => $_media['Media']['id']
											,'data-thumbnail-path' => str_replace('\\', '/', $_media['Media']['abs_path'])
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

<?php
echo $this->Html->script('airport');
?>
