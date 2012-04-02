<?php echo Html::anchor('admin/tasks/listing_by_blocks', 'View by Blocks', array('class' => 'btn success button-title')); ?>
<div class="clear"></div>

<?php if ($projects): ?>
	<?php foreach ($projects as $project_id => $tasks): ?>
		<?php if ($tasks): ?>
			<?php $project = Model_Project::find($project_id); ?>
			<h3><?=$project->company->name?> - <?=$project->name?></h3>
	
			<table class="zebra-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Estimated Completion</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($tasks as $task_id => $task): ?>
					<tr>
						<td><?php echo $task->name; ?></td>
						<td><?php echo Str::truncate(strip_tags(htmlspecialchars_decode($task->description)), 80); ?></td>
						<td><?php echo 'About '.str_replace(' ago', '', Date::time_ago($task->created_at, intval($task->blocks/8*24*3600) + $task->created_at)); ?></td>
						<td>
							<?php echo Html::anchor('admin/tasks/view/'.$task->id, 'Details'); ?> |
							<?php echo Html::anchor('admin/tasks/change_status/'.$task->id.'/AwaitingApproval', 'Done', array('onclick' => "return confirm('Are you sure?')")); ?>
			
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