<?php

class View_Admin_404 extends ViewModel
{
	public function view()
	{
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
		$this->title = $messages[array_rand($messages)];

		$this->template->title = 'Dashboard';
		$this->template->content = View::factory('admin/404');
	}
}
