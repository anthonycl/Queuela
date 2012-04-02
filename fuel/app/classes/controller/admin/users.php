<?php
class Controller_Admin_Users extends Controller_Admin 
{
	public function action_index()
	{
		Response::redirect('admin/users/listing');
	}

	public function action_listing()
	{
		$view = View::forge('admin/users/listing');
   		$view->set_global('users', Model_User::find('all'));
  
		$this->template->title = "Users";
		$this->template->content = $view;

	}

	public function action_view($id = null)
	{
		$view = View::forge('admin/users/view');
   		$view->set_global('user', Sentry::user(intval($id)));
   		$view->set_global('users_permissions', Model_User::find($id)->users_permissions);

		$this->template->title = "View User";
		$this->template->content = $view;

	}

	public function action_create($id = null)
	{	
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');
			$val->set_message('valid_string', 'The field :label must contain only letters, numbers, dashes and underscores.');
			$val->set_message('match_field', 'The field :label must match the field Confirm Password.');

			if ($val->run())
			{
				try
				{
					$vars = array(
				        'username' => Input::post('username'),
				        'password' => Input::post('password'),
				        'email' => Input::post('email'),
				        'metadata' => array(
				            'first_name' => Input::post('first_name'),
				            'last_name'  => Input::post('last_name'),
				        ),
				    );

					$id = Sentry::user()->create($vars);
		
					if ($id)
					{
						Session::set_flash('success', 'Added user #' . $id);
		
						Response::redirect('admin/users');
					}
					else
					{
						Session::set_flash('error', 'Could not add user');
					}
				}
				catch (SentryUserException $e)
				{
				    Session::set_flash('error', $e->getMessage());
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$this->template->title = "Create User";
		$this->template->content = View::forge('admin/users/create');

	}

	public function action_edit($id = null)
	{
		$user = Sentry::user(intval($id));
		$val = Model_User::validate('edit');

		if ($val->run())
		{
			try
			{
				$vars = array(
			        'username' => Input::post('username'),
			        'email' => Input::post('email'),
			        'metadata' => array(
			            'first_name' => Input::post('first_name'),
			            'last_name'  => Input::post('last_name'),
			        ),
			    );
	
				if(Input::post('password')) $vars['password'] = Input::post('password');
	
				if ($user->update($vars))
				{
					Session::set_flash('success', 'Updated user #' . $id);
	
					Response::redirect('admin/users');
				}
				else
				{
					Session::set_flash('error', 'Could not update user #' . $id);
				}
			}
			catch (SentryUserException $e)
			{
			    Session::set_flash('error', $e->getMessage());
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				Session::set_flash('error', $val->show_errors());
			}
			
			$this->template->set_global('user', $user, false);
		}

		$this->template->title = "Edit User";
		$this->template->content = View::forge('admin/users/edit');

	}

	public function action_delete($id = null)
	{
		if ($user = Model_User::find($id))
		{
			$user->delete();

			Session::set_flash('success', 'Deleted user #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user #'.$id);
		}

		Response::redirect('admin/users');

	}


}