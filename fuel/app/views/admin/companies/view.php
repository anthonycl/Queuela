<h2><?php echo $company->name; ?></h2>

<p>
	<strong>Address:</strong>
	<?php echo $company->address; ?>
</p>
<p>
	<strong>City:</strong>
	<?php echo $company->city; ?>
</p>
<p>
	<strong>State:</strong>
	<?php echo $company->state; ?>
</p>
<p>
	<strong>Zip:</strong>
	<?php echo $company->zip; ?>
</p>

<?php echo render('admin/companies/projects/listing'); ?>

<?php echo Html::anchor('admin/companies', 'Back'); ?>