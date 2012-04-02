<?php
class Controller_Admin_Users_Permissions extends Controller_Admin 
{
	public function action_create($user_id = null)
	{
		$view = View::forge('admin/users/permissions/create');
		$user = Sentry::user(intval($user_id));

		if (Input::method() == 'POST')
		{
			$val = Model_Users_Permission::validate('create');
			
			if ($val->run())
			{
				$permissions = json_encode(Input::post('permissions'));
				
				$users_permission = Model_Users_Permission::forge(array(
					'type' => Input::post('type'),
					'type_id' => Input::post('type_id'),
					'permissions' => $permissions,
					'user_id' => Input::post('user_id'),
				));

				if ($users_permission and $users_permission->save())
				{
					Session::set_flash('success', 'Added permission #'.$users_permission->id.'.');
					Response::redirect('admin/users/view/'.$user->id);
				}
				else
				{
					Session::set_flash('error', 'Could not save users_permission.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

   		$view->set_global('user', $user);

		$this->template->title = "Add Permission";
		$this->template->content = $view;
	}

	public function action_edit($id = null, $user_id = null)
	{
		$view = View::forge('admin/users/permissions/edit');
		$user = Sentry::user(intval($user_id));

		$users_permission = Model_Users_Permission::find($id);
		$val = Model_Users_Permission::validate('edit');

		if ($val->run())
		{
			$permissions = Input::post('permissions');
			
			if(in_array('all', $permissions))
			{
				$permissions = json_encode(array('all'));
			}
			else
			{
				$permissions = json_encode($permissions);
			}

			$users_permission->type = Input::post('type');
			$users_permission->type_id = Input::post('type_id');
			$users_permission->permissions = $permissions;
			$users_permission->user_id = Input::post('user_id');

			if ($users_permission->save())
			{
				Session::set_flash('success', 'Updated permission #' . $id);

				Response::redirect('admin/users/view/'.$user->id);
			}

			else
			{
				Session::set_flash('error', 'Could not update users_permission #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('users_permission', $users_permission, false);
		}

		$view->set_global('user', $user);

		$this->template->title = "Edit Permission";
		$this->template->content = View::forge('admin/users/permissions/edit');

	}

	public function action_delete($id = null, $user_id = null)
	{
		if ($users_permission = Model_Users_Permission::find($id))
		{
			$users_permission->delete();

			Session::set_flash('success', 'Deleted users_permission #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete users_permission #'.$id);
		}

		Response::redirect('admin/users/view/'.$user->id);

	}


}