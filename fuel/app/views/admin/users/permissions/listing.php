<h2>Permissions</h2>
<br>

<?php if ($users_permissions): ?>
<table class="zebra-striped prettify">
		<thead>
			<tr>
				<th>Type</th>
				<th>Which</th>
				<th>Permissions</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users_permissions as $users_permission): ?>
			<?php $type = strtolower($users_permission->type); ?>
			<tr>
				<td><?php echo $users_permission->type; ?></td>
				<td><?php echo $users_permission->$type->name; ?></td>
				<td><?php echo $users_permission->permissions; ?></td>
				<td>
					<?php echo Html::anchor('admin/users/permissions/edit/'.$users_permission->id.'/'.$user->id, 'Edit', array('class' => 'btn standard small')); ?>
					<?php echo Html::anchor('admin/users/permissions/delete/'.$users_permission->id.'/'.$user->id, 'Delete', array('onclick' => "return confirm('Are you sure?')", 'class' => 'btn error small')); ?>
	
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>No permissions.</p>
<?php endif; ?>

<p><?php echo Html::anchor('admin/users/permissions/create/'.$user->id, 'Add New Permission', array('class' => 'btn success')); ?></p>