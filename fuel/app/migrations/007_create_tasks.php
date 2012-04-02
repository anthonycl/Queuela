<?php

namespace Fuel\Migrations;

class Create_tasks
{
	public function up()
	{
		\DBUtil::create_table('tasks', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'description' => array('type' => 'text'),
			'blocks' => array('constraint' => 11, 'type' => 'int'),
			'sort' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => '"NotStarted","InProgress","AwaitingApproval","Approved"', 'type' => 'enum'),
			'project_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('tasks');
	}
}