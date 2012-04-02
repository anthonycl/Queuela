<?php
class Controller_Admin_Tasks extends Controller_Admin 
{
	public function action_index()
	{
		Response::redirect('admin/tasks/listing_by_project');
	}

	public function action_listing_by_project()
	{
		$view = View::forge('admin/tasks/listing_by_project');
		
		$user_projects = array();
		$user_permissions = Model_User::find($this->current_user->id)->users_permissions;
		
		foreach($user_permissions as $permission) {
			switch($permission->type) {
				case 'Task':
					$user_projects[$permission->task->project->id][$permission->task->id] = $permission->task;
				break;
				
				case 'Project':
					$tasks = Model_Project::find($permission->project->id)->tasks;
					
					foreach($tasks as $task) {
						$user_projects[$permission->project->id][$task->id] = $task;
					}
				break;
				
				case 'Company':
					$projects = Model_Company::find($permission->company->id)->projects;

					foreach($projects as $project) {
						foreach($project->tasks as $task) {
							$user_projects[$project->id][$task->id] = $task;
						}
					}
				break;
			}
		}

		$view->set_global('projects', $user_projects);
		$this->template->title = "Tasks by Project";
		$this->template->content = $view;
	}

	public function action_listing_by_blocks()
	{
		$view = View::forge('admin/tasks/listing_by_blocks');
		
		$user_projects = array();
		$user_permissions = Model_User::find($this->current_user->id)->users_permissions;
		
		foreach($user_permissions as $permission) {
			switch($permission->type) {
				case 'Task':
					$user_projects[$permission->task->project->id][$permission->task->id] = $permission->task;
				break;
				
				case 'Project':
					$tasks = Model_Project::find($permission->project->id)->tasks;
					
					foreach($tasks as $task) {
						$user_projects[$permission->project->id][$task->id] = $task;
					}
				break;
				
				case 'Company':
					$projects = Model_Company::find($permission->company->id)->projects;

					foreach($projects as $project) {
						foreach($project->tasks as $task) {
							$user_projects[$project->id][$task->id] = $task;
						}
					}
				break;
			}
		}

		$user_projects = Arr::sort($user_projects, 'null.null.blocks');
		//var_dump($user_projects);

		$view->set_global('projects', $user_projects);
		$this->template->title = "Tasks by Blocks";
		$this->template->content = $view;
	}

	public function action_view($id = null)
	{
		$view = View::forge('admin/tasks/view');
		$view->set_global('task', Model_Task::find($id));
		$this->template->title = "Task";
		$this->template->content = $view;
	}

	public function action_change_status($id = null, $status = null)
	{
		if ($task = Model_Task::find($id))
		{
			$task->status = $status;
			$task->save();

			Session::set_flash('success', 'Status updated on task #'.$id);
		}
		else
		{
			Session::set_flash('error', 'Could not update task #'.$id);
		}

		Response::redirect('admin/tasks/');
	}
}