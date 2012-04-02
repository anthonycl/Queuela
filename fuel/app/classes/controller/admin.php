<?php

class Controller_Admin extends Controller_Base {

	public $template = 'admin/template';

	public function before()
	{
		parent::before();

		if (!Sentry::check() and Request::active()->action != 'login')
		{
			Response::redirect('admin/login');
		}
	}
	
	public function action_login()
	{
		// Already logged in
		Sentry::check() and Response::redirect('admin');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')->add_rule('required');
			$val->add('password', 'Password')->add_rule('required');

			if ($val->run())
			{
				try
				{
				    $valid_login = Sentry::login(Input::post('email'), Input::post('password'));
				
				    if ($valid_login)
				    {
						Session::set_flash('notice', 'Welcome, '.$current_user->username);
						Response::redirect('admin');
				    }
				    else
				    {
						$attempts_left = Sentry::attempts()->get_limit();
						
						Session::set_flash('error', 'The login information provided did not match any in our system. Please try again, you have '.$attempts_left.' attempts remaining.');
				    }
				}
				catch (SentryAuthException $e)
				{
				    Session::set_flash('error', $e->getMessage());
				}
			} else {
				Session::set_flash('error', $val->show_errors());
			}
		}

		$this->template->title = 'Login';
		$this->template->content = View::forge('admin/login', array('val' => $val));
	}
	
	/**
	 * The logout action.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{		
		Sentry::logout();
		Response::redirect('admin');
	}

	/**
	 * The index action.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{		
		$this->template->title = 'Dashboard';
		$this->template->content = View::factory('admin/dashboard');
	}

}

/* End of file admin.php */