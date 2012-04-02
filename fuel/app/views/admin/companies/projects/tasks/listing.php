<h2>Tasks</h2><br>
<?php if ($tasks): ?>

<table class="zebra-striped" id="admin-task-sort">
    <thead>
        <tr>
            <th>Name</th>

            <th>Description</th>

            <th>Blocks</th>

            <th>Status</th>

            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tasks as $task): ?>

        <tr id="task_<?=$task->id?>">
            <td><?php echo $task->name; ?></td>

            <td><?php echo Str::truncate(strip_tags(htmlspecialchars_decode($task->description)), 80); ?></td>

            <td><?php echo $task->blocks; ?></td>

            <td><?php echo $_s['task.status'][$task->status]; ?></td>

            <td><?php echo Html::anchor('admin/companies/projects/tasks/view/'.$task->id.'/'.$project->id.'/'.$company->id, 'View'); ?> | <?php echo Html::anchor('admin/companies/projects/tasks/edit/'.$task->id.'/'.$project->id.'/'.$company->id, 'Edit'); ?> | <?php echo Html::anchor('admin/companies/projects/tasks/delete/'.$task->id.'/'.$project->id.'/'.$company->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></td>
        </tr><?php endforeach; ?>
    </tbody>
</table><?php else: ?>

<p>No Tasks.</p><?php endif; ?>

<p><?php echo Html::anchor('admin/companies/projects/tasks/create/'.$project->id.'/'.$company->id, 'Add New Task', array('class' => 'btn success')); ?></p>