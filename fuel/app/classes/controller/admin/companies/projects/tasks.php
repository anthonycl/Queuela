<?php
class Controller_Admin_Companies_Projects_Tasks extends Controller_Admin 
{
	public function action_view($id = null, $project_id = null, $company_id = null)
	{
		$view = View::forge('admin/companies/projects/tasks/view');

   		if($project_id && $company_id) {
   			$project = Model_Project::find($project_id);
   			$company = Model_Company::find($company_id);
   			$view->set_global('company', $company);
   			$view->set_global('project', $project);
   			$view->set_global('task', Model_Task::find($id));
   		}
   
		$this->template->title = "Task";
		$this->template->content = $view;

	}

	public function action_create($project_id = null, $company_id = null)
	{
		$view = View::forge('admin/companies/projects/tasks/create');

		if (Input::method() == 'POST')
		{
			$val = Model_Task::validate('create');
			
			if ($val->run())
			{
				$task = Model_Task::forge(array(
					'name' => Input::post('name'),
					'description' => Input::post('description'),
					'blocks' => Input::post('blocks'),
					'sort' => Input::post('sort'),
					'status' => Input::post('status'),
					'project_id' => Input::post('project_id'),
				));

				if ($task and $task->save())
				{
					Session::set_flash('success', 'Added task #'.$task->id.'.');

					Response::redirect('admin/companies/projects/view/'.$project_id.'/'.$company_id);
				}

				else
				{
					Session::set_flash('error', 'Could not save task.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

   		if($project_id && $company_id) {
   			$project = Model_Project::find($project_id);
   			$company = Model_Company::find($company_id);
   			$view->set_global('company', $company);
   			$view->set_global('project', $project);
   			$view->set_global('tasks_count', count($project->tasks));
   		}

		$this->template->title = "Create Task";
		$this->template->content = $view;

	}

	public function action_edit($id = null, $project_id = null, $company_id = null)
	{
		$view = View::forge('admin/companies/projects/tasks/edit');

		$task = Model_Task::find($id);
		$val = Model_Task::validate('edit');

		if ($val->run())
		{
			$task->name = Input::post('name');
			$task->description = Input::post('description');
			$task->blocks = Input::post('blocks');
			$task->sort = Input::post('sort');
			$task->status = Input::post('status');
			$task->project_id = Input::post('project_id');

			if ($task->save())
			{
				Session::set_flash('success', 'Updated task #' . $id);

				Response::redirect('admin/companies/projects/view/'.$project_id.'/'.$company_id);
			}

			else
			{
				Session::set_flash('error', 'Could not update task #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$task->name = $val->validated('name');
				$task->description = $val->validated('description');
				$task->blocks = $val->validated('blocks');
				$task->sort = $val->validated('sort');
				$task->status = $val->validated('status');
				$task->project_id = $val->validated('project_id');

				Session::set_flash('error', $val->show_errors());
			}
			
			$this->template->set_global('task', $task, false);
		}

   		if($project_id && $company_id) {
   			$project = Model_Project::find($project_id);
   			$company = Model_Company::find($company_id);
   			$view->set_global('company', $company);
   			$view->set_global('project', $project);
   			$view->set_global('tasks_count', count($project->tasks));
   		}

		$this->template->title = "Edit Task";
		$this->template->content = $view;

	}

	public function action_delete($id = null, $project_id = null, $company_id = null)
	{
		if ($task = Model_Task::find($id))
		{
			$task->delete();

			Session::set_flash('success', 'Deleted task #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete task #'.$id);
		}

		Response::redirect('admin/companies/projects/view/'.$project_id.'/'.$company_id);

	}

	public function action_updatesort()
	{
		$output = array('status' => 'success');
	
		if (Input::method() == 'POST')
		{
			$task = Input::post('task');
			
			$i=1;
			foreach($task as $task_id)
			{
				$task = Model_Task::find($task_id);
				$task->sort = $i;
				$task->save();
				$i++;
			}
		} else {
			$output['status'] = 'error';
			$output['error'] = 'The request did not contain a POST.';
		}

		echo json_encode($output);
		die();
	}
}