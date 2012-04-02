<h2>Projects</h2><br>
<?php if ($projects): ?>

<table class="zebra-striped prettify">
    <thead>
        <tr>
            <th>Name</th>

            <th>Description</th>

            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($projects as $project): ?>

        <tr>
            <td><?php echo $project->name; ?></td>

            <td><?php echo Str::truncate($project->description, 80); ?></td>

            <td><?php echo Html::anchor('admin/companies/projects/view/'.$project->id.'/'.$project->company->id, 'View'); ?> | <?php echo Html::anchor('admin/companies/projects/edit/'.$project->id.'/'.$project->company->id, 'Edit'); ?> | <?php echo Html::anchor('admin/companies/projects/delete/'.$project->id.'/'.$project->company->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></td>
        </tr><?php endforeach; ?>
    </tbody>
</table><?php else: ?>

<p>No Projects.</p><?php endif; ?>

<p><?php echo Html::anchor('admin/companies/projects/create/'.$company->id, 'Add New Project', array('class' => 'btn success')); ?></p>