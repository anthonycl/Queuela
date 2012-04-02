<h2><?=$task->name?></h2>

<div class="description">
	<?=trim(htmlspecialchars_decode($task->description)); ?>
</div>

<?php echo Html::anchor('admin/tasks/', 'Back', array('class' => 'btn standard small')); ?>