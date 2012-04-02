<?php
class Model_Users_Permission extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'type',
		'type_id',
		'permissions',
		'user_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_belongs_to = array('user');

	protected static $_has_one = array(
		'company' => array(
		    'model_to' => 'Model_Company',
		    'key_from' => 'type_id',
		    'key_to' => 'id'
		),
		'project' => array(
		    'model_to' => 'Model_Project',
		    'key_from' => 'type_id',
		    'key_to' => 'id'
		),
		'task' => array(
		    'model_to' => 'Model_Task',
		    'key_from' => 'type_id',
		    'key_to' => 'id'
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('type', 'Type', 'required');
		$val->add_field('type_id', 'Type Id', 'required');
		$val->add_field('permissions', 'Permission', 'required');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');

		return $val;
	}

}
