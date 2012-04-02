<?php
class Controller_Admin_Projects extends Controller_Admin 
{
	public function action_index()
	{
		$data['projects'] = Model_Project::find('all');
		$this->template->title = "Projects";
		$this->template->content = View::forge('admin/projects/index', $data);

	}

	public function action_create()
	{
		$view = View::forge('admin/projects/create');

		if (Input::method() == 'POST')
		{
			$val = Model_Project::validate('create');
			
			if ($val->run())
			{
				$project = Model_Project::forge(array(
					'name' => Input::post('name'),
					'description' => Input::post('description'),
					'company_id' => Input::post('company_id'),
				));

				if ($project and $project->save())
				{
					Session::set_flash('success', 'Added project #'.$project->id.'.');

					Response::redirect('admin/projects');
				}

				else
				{
					Session::set_flash('error', 'Could not save project.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

   		$view->set_global('companies', Arr::assoc_to_keyval(Model_Company::find('all'), 'id', 'name'));

		$this->template->title = "Projects";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
		$view = View::forge('admin/projects/edit');

		$project = Model_Project::find($id);
		$val = Model_Project::validate('edit');

		if ($val->run())
		{
			$project->name = Input::post('name');
			$project->description = Input::post('description');
			$project->company_id = Input::post('company_id');

			if ($project->save())
			{
				Session::set_flash('success', 'Updated project #' . $id);

				Response::redirect('admin/projects');
			}

			else
			{
				Session::set_flash('error', 'Could not update project #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$project->name = $val->validated('name');
				$project->description = $val->validated('description');
				$project->company_id = $val->validated('company_id');

				Session::set_flash('error', $val->show_errors());
			}
			
			$this->template->set_global('project', $project, false);
		}

		$view->set_global('companies', Arr::assoc_to_keyval(Model_Company::find('all'), 'id', 'name'));

		$this->template->title = "Projects";
		$this->template->content = $view;

	}

	public function action_delete($id = null)
	{
		if ($project = Model_Project::find($id))
		{
			$project->delete();

			Session::set_flash('success', 'Deleted project #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete project #'.$id);
		}

		Response::redirect('admin/projects');

	}


}