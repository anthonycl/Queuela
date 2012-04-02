<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$_s['site.name']?> - <?=$title?></title>
	<?php echo Asset::css(array(
		'bootstrap.css',
		'jquery-ui.Aristo.css',
		'jquery.dataTables.css',
		'jquery.chosen.css',
		'styles.css'
	)); ?>
	<style>
		body { margin: 50px; }
	</style>
	<?php echo Asset::js(array(
		'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
		'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js',
		'ckeditor/ckeditor.js',
		'ckeditor/jquery.js',
		'jquery.dataTables.min.js',
		'jquery.chosen.min.js',
		'bootstrap.js',
		'scripts.js'
	)); ?>
	<script>
		$(function(){ $('.topbar').dropdown(); });
	</script>
</head>
<body>
	
	<?php if ($current_user): ?>
	<div class="topbar">
	    <div class="fill">
	        <div class="container">
	            <h3><?php echo Html::anchor('admin', $_s['site.name']) ?></h3>
	            <ul>
	                <li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
						<?php echo Html::anchor('admin', 'Dashboard') ?>
					</li>
	                
					<?php foreach (glob(APPPATH.'classes/controller/admin/*.php') as $controller): ?>
						
						<?php
						$section_segment = basename($controller, '.php');
						$section_title = Inflector::humanize($section_segment);
						?>
						
	                <li class="<?php echo Uri::segment(2) == $section_segment ? 'active' : '' ?>">
						<?php echo Html::anchor('admin/'.$section_segment, $section_title) ?>
					</li>
					<?php endforeach; ?>
	          </ul>

	          <ul class="nav secondary-nav">
	            <li class="menu">
	                <a href="#" class="menu"><?php echo ucwords($current_user->get('metadata.first_name').' '.$current_user->get('metadata.last_name')) ?></a>
	                <ul class="menu-dropdown">
	                    <li><?php echo Html::anchor('admin/users/edit/'.$current_user->id, 'Settings') ?></li>
	                    <li><?php echo Html::anchor('admin/logout', 'Logout') ?></li>
	                </ul>
	            </li>
	          </ul>
	        </div>
	    </div>
	</div>
	<?php endif; ?>
	
	<div class="container">
		<div class="row">
			<div class="span16">
				<h1><?php echo $title; ?></h1>
				<hr>
<?php if (Session::get_flash('success')): ?>
				<div class="alert-message success">
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
					</p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert-message error">
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
					</p>
				</div>
<?php endif; ?>
			</div>
			<div class="span16">
<?php echo $content; ?>
			</div>
		</div>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				Proudly Built on <a href="http://fuelphp.com">FuelPHP</a>.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
	</div>
</body>
</html>
