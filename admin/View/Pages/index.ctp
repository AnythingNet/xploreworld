<?php echo $this->Session->flash(); ?>

<h1>Page Management</h1>

<div class="outer-button">
  <?php echo $this->Html->link('Add new page', array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
</div>

<!-- Table -->
<div class="panel panel-default">

  <div class="panel-heading">Pages</div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Page Name</th>
          <th>Page Title</th>
          <th>Created Time</th>
          <th>Modified Time</th>
          <th>Status</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pages as $i => $page) { ?>
        <tr>
          <td><?php echo $page['Page']['name']; ?></td>
          <td><?php echo $page['Page']['title']; ?></td>
          <td><?php echo $page['Page']['created']; ?></td>
          <td><?php echo $page['Page']['modified']; ?></td>
          <td><?php echo $page['Page']['status']; ?></td>
          <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $page['Page']['id']), array('class' => 'btn btn-success')); ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
