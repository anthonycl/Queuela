<h2>Editing Setting</h2>
<br>

<?php echo render('admin/settings/_form'); ?>
<p>
	<?php echo Html::anchor('admin/settings/view/'.$setting->id, 'View'); ?> |
	<?php echo Html::anchor('admin/settings', 'Back'); ?></p>
