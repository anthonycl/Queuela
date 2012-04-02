<h2>Projects</h2>
<br>
<?php if ($projects): ?>
	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Company</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($projects as $project): ?>		<tr>
	
				<td><?php echo $project->name; ?></td>
				<td><?php echo $project->description; ?></td>
				<td><?php echo $project->company->name; ?></td>
				<td>
					<?php echo Html::anchor('admin/projects/view/'.$project->id, 'View'); ?> |
					<?php echo Html::anchor('admin/projects/edit/'.$project->id, 'Edit'); ?> |
					<?php echo Html::anchor('admin/projects/delete/'.$project->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
	
				</td>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>No Projects.</p>
<?php endif; ?>

<p>
	<?php echo Html::anchor('admin/projects/create/', 'Add New Project', array('class' => 'btn success')); ?>
</p>
