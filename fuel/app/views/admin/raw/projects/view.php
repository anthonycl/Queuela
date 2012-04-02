<h2>Viewing <?php echo $project->name; ?></h2>

<p>
	<strong>Id:</strong>
	<?php echo $project->id; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $project->description; ?></p>
	
<?php echo render('admin/companies/projects/tasks/listing', array('tasks' => $tasks, 'company' => $company)); ?>

<?php echo Html::anchor('admin/companies', 'Back'); ?>