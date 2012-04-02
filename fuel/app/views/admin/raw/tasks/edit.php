<h2>Editing Task</h2>
<br>

<?php echo render('admin/tasks/_form'); ?>
<p>
	<?php echo Html::anchor('admin/tasks/view/'.$task->id, 'View'); ?> |
	<?php echo Html::anchor('admin/tasks', 'Back'); ?></p>
