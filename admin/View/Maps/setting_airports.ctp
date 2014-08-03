<?php echo $this->Session->flash(); ?>

<h1>Pins</h1>

	<div class="outer-button">
		<?php echo $this->Html->link('Add Pin', array('action' => 'add_airport', $map_id), array('class' => 'btn btn-primary')); ?>
	</div>

  <div class="panel panel-default">

    <div class="panel-heading">Pins</div>

		<div class="panel-body">
			<?php if (isset($Pins)) { ?>

				<ul class="pagination">
				<?php
					echo $this->Paginator->prev(
						 '<< Prev'
						 ,array(
							 'tag' => 'li'
						 )
						,'<a>&lt;&lt; Prev</a>'
						,array(
							 'tag' => 'li'
							,'class' => 'prev disabled'
							,'escape' => false
						)
					);
					echo $this->Paginator->numbers(array(
							'separator' => ''
						 ,'currentClass' => 'disabled'
						 ,'currentTag' => 'a'
						 ,'tag' => 'li'
					));
					echo $this->Paginator->next(
						 'Next >>'
						 ,array(
							 'tag' => 'li'
						 )
						,'<a>Next &gt;&gt;</a>'
						,array(
							 'tag' => 'li'
							,'class' => 'prev disabled'
							,'escape' => false
						)
					);
				?>
				</ul>

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
								<td>
									<?php
										$description = h($_pin['MapsAirport']['description']);
										$description = mb_strimwidth($description, 0, 103, '...');
										echo nl2br($description);
									?>
								</td>
								<td>
									<?php echo $this->Html->link('Edit', array('action' => 'edit_airport', $_pin['MapsAirport']['id']), array('class' => 'btn btn-success')); ?>
									<a class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_pin['MapsAirport']['id']; ?>">Delete</a>
								</td>
							</tr>

							<!-- Delete modal -->
							<div class="modal fade" id="delete-modal-<?php echo $_pin['MapsAirport']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">

										<?php echo $this->Form->create('MapsAirport', array('type' => 'post', 'url' => 'delete_airport')); ?>
											<div class="modal-header">Delete this pin</div>

											<div class="modal-body">Are you sure you want to delete this pin?</div>

											<div class="modal-footer">
												<a class="btn btn-default" data-dismiss="modal">Close</a>
												<?php echo $this->Form->submit('Delete', array('class' => 'btn btn-danger', 'name' => 'delete', 'div' => false)); ?>
												<?php echo $this->Form->hidden('id', array('value' => $_pin['MapsAirport']['id'])); ?>
												<?php echo $this->Form->hidden('map_id', array('value' => $map_id)); ?>
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

<?php
echo $this->Html->script('select2/select2.min');
echo $this->Html->script('airport');
?>
