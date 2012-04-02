<?php echo Html::anchor('admin/tasks/listing_by_project', 'View by Project', array('class' => 'btn success button-title')); ?>
<div class="clear"></div>

<div id="task-block-chart">
	<input type="hidden" id="block_spacing" value="<?=$_s['task.block_spacing_px']?>" />

	<div id="inner">
		<div id="task-block-dates"></div>
		<br />

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
						<div class="task" style="margin-left: <?=$left?>px;">
							<?php echo Html::anchor('admin/tasks/view/'.$task->id, Str::truncate($task->name, intval($width/8)), array('style' => 'width: '.($width-20).'px;')); ?>
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