<h1>Blog posts</h1>
<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>
<p><?php echo $this->Html->link("Manage Post", array('action' => 'manage')); ?></p>
<p><?php  echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
?></p>
<table>
<tr>
<th>Id</th>
<th>Title</th>
<th>Article</th>
<th>Image</th>
<th>Action</th>
</tr>
<!-- Here is where we loop through our $posts array, printing out post
˓→info -->
<?php foreach ($posts as $post): ?>
<tr>
<td><?php echo $post['Post']['id']; ?></td>
<td>
<?php echo $this->Html->link($post['Post']['title'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link($post['Post']['description'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link($post['Post']['imagePath'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
</td>
<td>
<?php
echo $this->Html->link(
'Edit',
array('action' => 'edit', $post['Post']['id'])
);
?>
&nbsp;&nbsp;
<?php
echo $this->Form->postLink(
'Delete',
array('action' => 'delete', $post['Post']['id']),
array('confirm' => 'Are you sure?')
);
?>
</td>
</tr>
<?php endforeach; ?>
<?php unset($post); ?>
</table>
