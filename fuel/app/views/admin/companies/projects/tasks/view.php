<h2><?=Html::anchor('admin/companies/view/'.$company->id, $company->name)?> - <?=Html::anchor('admin/companies/projects/view/'.$project->id.'/'.$company->id, $project->name)?> - <?=$task->name?></h2>

<div class="description hero-unit">
	<?=htmlspecialchars_decode($task->description); ?>
</div>

<?php echo Html::anchor('admin/companies/projects/view/'.$project->id.'/'.$company->id, 'Back'); ?>