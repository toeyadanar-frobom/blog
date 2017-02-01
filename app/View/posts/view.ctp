
<h1><b><?php echo h($post['Post']['title']); ?></b></h1>
 <p><small>Created: <?php echo $post['Post']['created']; ?></small></p> 
<p><?php echo h($post['Post']['description']); ?></p>

<?php echo $this->Html->image('./images/'.$post['Post']['imagePath'], array('alt' => 'Image', 'style' => 'width:300px;'))?>
<?php foreach ($post['Comment'] as $comment): ?>
    
<div class="comment" style="margin-left:50px;">
      <b><i><?php echo h($comment['name'])?></i></b>: <?php echo h($comment['comment'])?>
        <?php 
        echo $this->Form->postLink(
        'Delete',
        array('action' => 'delete',$comment['id'],
        	'controller'=>'Comments',
        'confirm' => 'Are you sure?'
        ) )?>
    
       
    </div>
<?php endforeach; ?>

<?php
		 echo $this->Form->create('Comment',array('url'=>array('controller'=>'Posts','action'=>'view',$post['Post']['id'])));
		/* echo $this->Form->input('Comment.name');*/
		 echo $this->Form->input('Comment.comment');
        
        
?>


<?php echo $this->Form->end('Submit');?>
<p><?php echo $this->Html->link("Back", array('action' => 'index')); ?></p>


