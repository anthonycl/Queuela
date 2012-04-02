<?php
class Controller_Admin_Tasks extends Controller_Admin 
{

	public function action_index()
	{
		$data['tasks'] = Model_Task::find('all');
		$this->template->title = "Tasks";
		$this->template->content = View::forge('admin/tasks/index', $data);

	}

	public function action_view($id = null)
	{
		$data['task'] = Model_Task::find($id);

		$this->template->title = "Task";
		$this->template->content = View::forge('admin/tasks/view', $data);

	}

	public function action_create($id = null)
	{
		$view = View::forge('admin/tasks/create');

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

					Response::redirect('admin/tasks');
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

		$view->set_global('projects', Arr::assoc_to_keyval(Model_Project::find('all'), 'id', 'name'));

		$this->template->title = "Tasks";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
		$view = View::forge('admin/tasks/edit');

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

				Response::redirect('admin/tasks');
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

		$view->set_global('projects', Arr::assoc_to_keyval(Model_Project::find('all'), 'id', 'name'));

		$this->template->title = "Tasks";
		$this->template->content = $view;

	}

	public function action_delete($id = null)
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

		Response::redirect('admin/tasks');

	}


}