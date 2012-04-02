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
				<?php echo Form::textarea('description', Input::post('description', isset($task) ? htmlspecialchars_decode($task->description) : ''), array('class' => 'span10 editor-full', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Blocks', 'blocks'); ?>

			<div class="input">
				<?php echo Form::input('blocks', Input::post('blocks', isset($task) ? $task->blocks : '3'), array('class' => 'span6')); ?> (~8 = Day)
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Status', 'status'); ?>

			<div class="input">
				<?php echo Form::select('status', Input::post('status', isset($task) ? $task->status : ''), $_s['task.status'], array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Sort', 'sort'); ?>

			<div class="input">
				<?php echo Form::input('sort', Input::post('sort', isset($task) ? $task->sort : $tasks_count+1), array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="actions">
			<?php echo Form::input('project_id', $project->id, array('type' => 'hidden')); ?>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>