<?php echo Html::anchor('admin/tasks/list_by_project', 'Organize by Project', array('class' => 'btn success button-title')); ?>
<div class="clear"></div>

<div id="task-block-chart">
	<input type="hidden" id="block_spacing" value="<?=$_s['task.block_spacing_px']?>" />

	<div id="inner">
		<div id="task-block-dates"></div>

		<div class="task-block">
		<?php if ($projects): ?>
			<?php $i = 0; $left = 0; ?>
			<?php foreach ($projects as $project_id => $tasks): ?>
				<?php if($i%6 == 0): $left = 0; ?>
				</div><div class="task-block">
				<?php endif; ?>
		
				<?php if ($tasks): ?>
					<?php $project = Model_Project::find($project_id); ?>
					<?php foreach ($tasks as $task_id => $task): ?>
						<?php $width = $task->blocks*$_s['task.block_spacing_px']; ?>
						<div class="task" style="margin-left: <?=$left?>px; width: <?=$width-20?>px;">
							<?php echo Html::anchor('admin/tasks/view/'.$task->id, Str::truncate($task->name, intval($width/8)), array('class' => 'view', 'style' => 'width: '.($width-75).'px;', 'title' => $task->name)); ?>
							<?php echo Html::anchor('admin/tasks/change_status/'.$task->id.'/AwaitingApproval', 'Done', array('onclick' => "return confirm('Are you sure you want to mark this task as complete?')", 'class' => 'done btn success small')); ?>
							<div class="clear"></div>
						</div>
						<?php $i++; $left = $left + $width; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<p>No Projects.</p>
		<?php endif; ?>
		</div>
	</div>
</div>