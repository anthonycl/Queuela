<?php echo Form::open(array('class' => 'form-stacked')); ?>
	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Type', 'type'); ?>

			<div class="input">
				<?php echo Form::select('type', Input::post('type', isset($users_permission) ? $users_permission->type : ''), $_s['permissions.types'], array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Type Id', 'type_id'); ?>

			<div class="input">
				<?php echo Form::input('type_id', Input::post('type_id', isset($users_permission) ? $users_permission->type_id : ''), array('class' => 'span6')); ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Permissions', 'permissions'); ?>

			<div class="input">
				<?php echo Form::select('permissions[]', Input::post('permission', isset($users_permission) ? json_decode($users_permission->permissions) : ''), $_s['permissions.permissions'], array('class' => 'span6 multiselect', 'multiple' => 'multiple', 'data-placeholder' => 'Choose a Country…', 'id' => 'permissions_multiselect')); ?>
			</div>
		</div>
		<div class="actions">
			<?php echo Form::input('user_id', $user->id, array('type' => 'hidden')); ?>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>