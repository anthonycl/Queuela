<?php echo Html::anchor('admin/tasks/list_by_block', 'Organize by Block', array('class' => 'btn success button-title')); ?>
<div class="clear"></div>

<?php if ($projects): ?>
	<?php foreach ($projects as $project_id => $tasks): ?>
		<?php if ($tasks): ?>
			<?php $project = Model_Project::find($project_id); ?>
			<h3><?=$project->company->name?> - <?=$project->name?></h3>
	
			<table class="zebra-striped">
				<thead>
					<tr>
						<th width="20%">Name</th>
						<th width="40%">Description</th>
						<th width="15%">Estimated Completion</th>
						<th width="11%"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($tasks as $task_id => $task): ?>
					<?php $completed = MyDate::task_completion($task, $_s['site.timezone']); ?>
					<tr>
						<td><?php echo $task->name; ?></td>
						<td><?php echo MyStr::remove_junk($task->description, 80); ?></td>
						<td><?php echo 'About '.$completed->pretty_time.' or '.$completed->formatted_time; ?></td>
						<td>
							<?php echo Html::anchor('admin/tasks/view/'.$task->id, 'Details'); ?>
							<?php echo Html::anchor('admin/tasks/change_status/'.$task->id.'/AwaitingApproval', 'Done', array('onclick' => "return confirm('Are you sure you want to mark this task as complete?')", 'class' => 'btn success small')); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<p>No Tasks.</p>
		<?php endif; ?>
	<?php endforeach; ?>
<?php else: ?>
	<p>No Projects.</p>
<?php endif; ?>