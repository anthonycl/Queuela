<?php

class MyDate extends Date
{
	static public function time_to_go($future, $now = false)
	{
		return str_replace(' ago', '', Date::time_ago($now ? $now : time(), $future));
	}

	static public function task_completion($task, $timezone = null)
	{
		$now = $task->created_at;
		$future = intval($task->blocks/8*24*3600) + $task->created_at;
		
		$pretty_time = str_replace(' ago', '', self::time_ago($now, $future));

		return (object)array('pretty_time' => $pretty_time, 'formatted_time' => date('F jS ~ ga', strtotime(self::forge($future, $timezone))), 'timestamp' => $future);
	}
}