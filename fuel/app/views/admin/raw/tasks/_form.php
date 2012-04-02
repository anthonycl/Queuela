<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Name', 'name'); ?>

			<div class="input">
				<?php echo Form::input('name', Input::post('name', isset($task) ? $task->name : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Description', 'description'); ?>

			<div class="input">
				<?php echo Form::textarea('description', Input::post('description', isset($task) ? $task->description : ''), array('class' => 'span10', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Blocks', 'blocks'); ?>

			<div class="input">
				<?php echo Form::input('blocks', Input::post('blocks', isset($task) ? $task->blocks : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Sort', 'sort'); ?>

			<div class="input">
				<?php echo Form::input('sort', Input::post('sort', isset($task) ? $task->sort : ''), array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Status', 'status'); ?>

			<div class="input">
				<?php echo Form::select('status', Input::post('status', isset($task) ? $task->status : ''), $_s['task.status'], array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Project', 'project_id'); ?>

			<div class="input">
				<?php echo Form::select('project_id', Input::post('project_id', isset($task) ? $task->project_id : ''), $projects, array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>