<div class="users form">
<h3>Login in here or <p><?php echo $this->Html->link("Sign up", array('action' => 'add')); ?></p></h3>
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>

</div>


