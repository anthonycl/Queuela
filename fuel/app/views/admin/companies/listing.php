<?php if ($companies): ?>

<table class="zebra-striped prettify">
    <thead>
        <tr>
            <th>Name</th>

            <th>Address</th>

            <th>City</th>

            <th>State</th>

            <th>Zip</th>

            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($companies as $company): ?>

        <tr>
            <td><?php echo $company->name; ?></td>

            <td><?php echo $company->address; ?></td>

            <td><?php echo $company->city; ?></td>

            <td><?php echo $company->state; ?></td>

            <td><?php echo $company->zip; ?></td>

            <td><?php echo Html::anchor('admin/companies/view/'.$company->id, 'View'); ?> | <?php echo Html::anchor('admin/companies/edit/'.$company->id, 'Edit'); ?> | <?php echo Html::anchor('admin/companies/delete/'.$company->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></td>
        </tr><?php endforeach; ?>
    </tbody>
</table><?php else: ?>

<p>No Companies.</p><?php endif; ?>

<p><?php echo Html::anchor('admin/companies/create', 'Add New Company', array('class' => 'btn success')); ?></p>