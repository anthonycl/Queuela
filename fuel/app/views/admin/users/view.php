<h2><?=$user->get('metadata.first_name').' '.$user->get('metadata.last_name')?></h2>

<p>
	<strong>Username:</strong>
	<?php echo $user->username; ?>
</p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?>
</p>
<p>
	<strong>Last login:</strong>
	<?php echo Date::time_ago($user->last_login); ?>
</p>

<?php echo render('admin/users/permissions/listing'); ?>

<?php echo Html::anchor('admin/users', 'Back'); ?>