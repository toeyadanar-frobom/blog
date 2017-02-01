<?php
class Event extends AppModel {
	var $name = 'Event';
	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'foreign_id',
			'conditions' => array('Comment.class'=>'Event'),
		),
	);
}

?>