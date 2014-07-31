<?php echo $this->Form->create('User', array('type' => 'post', 'url' => array('action' => 'add'))) ?>
<div class="panel-body"> 
  <div class="form-group">
    <?php echo $this->Form->input('username', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'username', 'label' => false)) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'password', 'label' => false)) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->submit('Login', array('id' => 'login-button', 'class' => 'btn btn-primary')) ?>
  </div>
</div> 
<?php echo $this->Form->end() ?>
