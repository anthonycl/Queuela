<h2><?=Html::anchor('admin/companies/view/'.$company->id, $company->name)?> - <?=$project->name?></h2>

<p class="description">
	<?=$project->description; ?>
</p>
	
<?php echo render('admin/companies/projects/tasks/listing'); ?>

<?php echo Html::anchor('admin/companies', 'Back'); ?>