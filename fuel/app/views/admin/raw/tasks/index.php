<h2>Listing Tasks</h2>
<br>
<?php if ($tasks): ?>
<table class="zebra-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Blocks</th>
			<th>Sort</th>
			<th>Status</th>
			<th>Project id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tasks as $task): ?>		<tr>

			<td><?php echo $task->name; ?></td>
			<td><?php echo $task->description; ?></td>
			<td><?php echo $task->blocks; ?></td>
			<td><?php echo $task->sort; ?></td>
			<td><?php echo $task->status; ?></td>
			<td><?php echo $task->project_id; ?></td>
			<td>
				<?php echo Html::anchor('admin/tasks/view/'.$task->id, 'View'); ?> |
				<?php echo Html::anchor('admin/tasks/edit/'.$task->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/tasks/delete/'.$task->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Tasks.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/tasks/create', 'Add new Task', array('class' => 'btn success')); ?>

</p>
