<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
/*echo $this->Form->input('image',array('type'=>'file'));*/
echo $this->Form->end('Save Post');
?>