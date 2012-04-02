<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Name', 'name'); ?>

			<div class="input">
				<?php echo Form::input('name', Input::post('name', isset($company) ? $company->name : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Address', 'address'); ?>

			<div class="input">
				<?php echo Form::input('address', Input::post('address', isset($company) ? $company->address : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('City', 'city'); ?>

			<div class="input">
				<?php echo Form::input('city', Input::post('city', isset($company) ? $company->city : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('State', 'state'); ?>

			<div class="input">
				<?php echo Form::select('state', Input::post('state', isset($company) ? $company->state : ''), $_s['states'], array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Zip', 'zip'); ?>

			<div class="input">
				<?php echo Form::input('zip', Input::post('zip', isset($company) ? $company->zip : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>