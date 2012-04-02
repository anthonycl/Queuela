<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Name', 'name'); ?>

			<div class="input">
				<?php echo Form::input('name', Input::post('name', isset($project) ? $project->name : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Description', 'description'); ?>

			<div class="input">
				<?php echo Form::textarea('description', Input::post('description', isset($project) ? htmlspecialchars_decode($project->description) : ''), array('class' => 'span10 editor-full', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::input('company_id', $company->id, array('type' => 'hidden')); ?>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>