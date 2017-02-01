<table>
     <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Image</th>
        <th>Action</th>

    </tr>
<?php foreach ($posts as $post): ?>
<tr>
<td>
<?php echo $post['Post']['id'];?>
</td>
<td><?php echo  $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']));?>

        </td>

        <td><?php echo $this->Html->image('./images/'.$post['Post']['imagePath'], array('alt' => 'Image', 'style' => 'width:300px;'))?></td>

        <td>
        <?php
        echo $this->Html->link(
        'Edit',
        array('action' => 'edit', $post['Post']['id']));
        ?>&nbsp;&nbsp;
        <?php
        echo $this->Form->postLink(
        'Delete',
        array('action' => 'delete', $post['Post']['id']),
        array('confirm' => 'Are you sure?')
        );
        ?>
        </td>

    </tr>

            <?php endforeach;?>

            <?php unset($post);?>

</table>      
<p><?php echo $this->Html->link("Back", array('action' => 'index')); ?></p>              