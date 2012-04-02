<?php
class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'email',
		'last_login',
		'ip_address',
		'status',
		'activated',
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

	protected static $_has_many = array(
		'posts',
		'users_permissions'
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('username', 'Username', 'required|max_length[50]')->add_rule('valid_string', array('alpha','numeric','dashes'));
		$val->add_field('confirm_password', 'Confirm Password', 'min_length[6]|max_length[16]');
		$val->add_field('password', 'Password', 'min_length[6]|max_length[16]|match_field[confirm_password]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		$val->add_field('first_name', 'First Name', 'required|min_length[2]|max_length[50]');
		$val->add_field('last_name', 'Last Name', 'required|min_length[2]|max_length[50]');

		return $val;
	}
	

}
