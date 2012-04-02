<?php

class Controller_Base extends Controller_Template {
	public $current_user;

	public function before()
	{
		parent::before();
		
		// Assign current_user to the instance so controllers can use it
		$this->current_user = Sentry::check() ? Sentry::user() : null;
		
		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
		
		// Set the settings
		$settings = Model_Setting::get_array_by_name();
		View::set_global('_s', $settings);
	}

	public function _s($name)
	{
		$setting = Model_Setting::find_by_name($name);
		return Model_Setting::format_output($setting->value);
	}
}