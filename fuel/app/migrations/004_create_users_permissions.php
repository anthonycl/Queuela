<?php

namespace Fuel\Migrations;

class Create_users_permissions
{
	public function up()
	{
		\DBUtil::create_table('users_permissions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'type' => array('constraint' => '"Company","Project","Task"', 'type' => 'enum'),
			'permission' => array('constraint' => 255, 'type' => 'varchar'),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users_permissions');
	}
}