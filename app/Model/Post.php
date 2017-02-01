<?php
class Post extends AppModel {

	public function isOwnedBy($post, $user) {
    return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
}
    var $name = 'Post';
	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'foreign_id',
			'conditions' => array('Comment.class'=>'Post'),
		),
	);
}
?>