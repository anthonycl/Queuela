<?php

class Controller_Welcome extends Controller
{

	public $template = 'admin/template';

	public function action_index()
	{
		Response::redirect('admin');
	}

	public function action_404()
	{
		return Response::forge(ViewModel::forge('admin/404'), 404);
	}
}
