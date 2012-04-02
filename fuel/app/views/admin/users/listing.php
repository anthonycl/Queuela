<?php if ($users): ?>
	<table class="zebra-striped prettify">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Last login</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user->username; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo Date::time_ago($user->last_login); ?></td>
				<td>
					<?php echo Html::anchor('admin/users/view/'.$user->id, 'View'); ?> |
					<?php echo Html::anchor('admin/users/edit/'.$user->id, 'Edit'); ?> |
					<?php echo Html::anchor('admin/users/delete/'.$user->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>No Users.</p>
<?php endif; ?>

<p><?php echo Html::anchor('admin/users/create', 'Add New User', array('class' => 'btn success')); ?></p>