<?php
class Controller_Admin_Companies_Projects extends Controller_Admin 
{
	public function action_view($id = null, $company_id = null)
	{
   		$view = View::forge('admin/companies/projects/view');
  
		$project = Model_Project::find($id);

		$view->set_global('project', $project);
		if(count($project->tasks) > 0) $view->set_global('tasks', Arr::sort($project->tasks, 'sort'));

   		if($company_id) {
   			$company = Model_Company::find($company_id);
   			$view->set_global('company', $company);
   		}

		$this->template->title = "View Project";
		$this->template->content = $view;

	}

	public function action_create($company_id = null)
	{
		$view = View::forge('admin/companies/projects/create');
   		
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

					Response::redirect('admin/companies/view/'.$company_id);
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

   		if($company_id) {
   			$company = Model_Company::find($company_id);
   			$view->set_global('company', $company);
   		}

		$this->template->title = "Create Project";
		$this->template->content = $view;

	}

	public function action_edit($id = null, $company_id = null)
	{	
   		$view = View::forge('admin/companies/projects/edit');
   		
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

				Response::redirect('admin/companies/view/'.$company_id);
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

   		if($company_id) {
   			$company = Model_Company::find($company_id);
   			$view->set_global('company', $company);
   		}

		$this->template->title = "Edit Project";
		$this->template->content = $view;

	}

	public function action_delete($id = null, $company_id = null)
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

		Response::redirect('admin/companies/view/'.$company_id);
	}
}