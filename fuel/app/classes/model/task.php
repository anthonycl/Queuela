<?php
class Model_Task extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'description',
		'blocks',
		'sort',
		'status',
		'project_id',
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

	protected static $_belongs_to = array('project');

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('description', 'Description', 'required');
		$val->add_field('blocks', 'Blocks', 'required|valid_string[numeric]|numeric_min[3]|numeric_max[200]');
		$val->add_field('sort', 'Sort', 'required|valid_string[numeric]');
		$val->add_field('status', 'Status', 'required');
		$val->add_field('project_id', 'Project Id', 'required|valid_string[numeric]');

		return $val;
	}

}
