<?php
class Controller_Admin_Companies extends Controller_Admin 
{
	public function action_index()
	{
		Response::redirect('admin/companies/listing');
	}

	public function action_listing()
	{
		$data['companies'] = Model_Company::find('all');
		$this->template->title = "Companies";
		$this->template->content = View::forge('admin/companies/listing', $data);
	}

	public function action_view($id = null)
	{
		$view = View::forge('admin/companies/view');

		$company = Model_Company::find($id);
		$view->set_global('company', $company);
		$view->set_global('projects', $company->projects);
		
		$this->template->title = "View Company";
		$this->template->content = $view;
	}

	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Company::validate('create');
			
			if ($val->run())
			{
				$company = Model_Company::forge(array(
					'name' => Input::post('name'),
					'address' => Input::post('address'),
					'city' => Input::post('city'),
					'state' => Input::post('state'),
					'zip' => Input::post('zip'),
				));

				if ($company and $company->save())
				{
					Session::set_flash('success', 'Added company #'.$company->id.'.');

					Response::redirect('admin/companies');
				}
				else
				{
					Session::set_flash('error', 'Could not save company.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$this->template->title = "Create Company";
		$this->template->content = View::forge('admin/companies/create');

	}

	public function action_edit($id = null)
	{
		$company = Model_Company::find($id);
		$val = Model_Company::validate('edit');

		if ($val->run())
		{
			$company->name = Input::post('name');
			$company->address = Input::post('address');
			$company->city = Input::post('city');
			$company->state = Input::post('state');
			$company->zip = Input::post('zip');

			if ($company->save())
			{
				Session::set_flash('success', 'Updated company #' . $id);

				Response::redirect('admin/companies');
			}

			else
			{
				Session::set_flash('error', 'Could not update company #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$company->name = $val->validated('name');
				$company->address = $val->validated('address');
				$company->city = $val->validated('city');
				$company->state = $val->validated('state');
				$company->zip = $val->validated('zip');

				Session::set_flash('error', $val->show_errors());
			}
			
			$this->template->set_global('company', $company, false);
		}

		$this->template->title = "Edit Company";
		$this->template->content = View::forge('admin/companies/edit');

	}

	public function action_delete($id = null)
	{
		if ($company = Model_Company::find($id))
		{
			$company->delete();

			Session::set_flash('success', 'Deleted company #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete company #'.$id);
		}

		Response::redirect('admin/companies');

	}


}