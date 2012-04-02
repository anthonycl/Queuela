<?php
class Model_Setting extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'value',
		'locked',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[50]');
		$val->add_field('value', 'Value', 'required|max_length[255]');

		return $val;
	}

	public static function get_array_by_name()
	{
		$array = array();
		$settings = self::find('all');

		foreach($settings as $setting) {
			$array[$setting->name] = self::format_output($setting->value);
		}
		
		return $array;
	}

	public static function format_output($value)
	{
		$array = json_decode($value, true);
		return is_array($array) ? $array : $value;
	}
}
