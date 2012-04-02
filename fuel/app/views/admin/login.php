<?php echo Form::open(array()); ?>

	<?php if (isset($_GET['destination'])): ?>
		<?php echo Form::hidden('destination',$_GET['destination']); ?>
	<?php endif; ?>

	<div class="row">
		<label for="email">Email or Username:</label>
		<div class="input"><?php echo Form::input('email', Input::post('email')); ?></div>
		
		<?php if ($val->errors('email')): ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<label for="password">Password:</label>
		<div class="input"><?php echo Form::password('password'); ?></div>
		
		<?php if ($val->errors('password')): ?>
		<?php endif; ?>
	</div>

	<div class="actions">
		<?php echo Form::submit(array('value'=>'Login', 'name'=>'submit')); ?>
	</div>

<?php echo Form::close(); ?>