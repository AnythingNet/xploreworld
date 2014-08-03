
<?php echo $this->Session->flash(); ?>

	<h1>Maps</h1>

	<div class="outer-button">
		<?php echo $this->Html->link('Add new map', array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
	</div>

  <div class="panel panel-default">

    <div class="panel-heading">Maps</div>

		<div class="panel-body">

			<?php if (isset($Maps)) { ?>

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
										$image_path = Configure::read('File.url').$_map['Media']['path'];
										echo $this->Html->image($image_path, array('width' => 100,'height' => 100));
									?>
								</td>

								<td>
									<?php echo $this->Html->link('Pin', array('action' => 'setting_airports', $_map['Map']['id']), array('class' => 'btn btn-info')); ?>

									<?php echo $this->Html->link('Edit', array('action' => 'edit', $_map['Map']['id']), array('class' => 'btn btn-success')); ?>

									<a class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_map['Map']['id']; ?>">Delete</a>
								</td>

							</tr>

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

			<?php } ?>

		</div>

  </div>

