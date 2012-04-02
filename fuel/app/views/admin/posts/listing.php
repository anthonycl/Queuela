<?php if ($posts): ?>
<table class="zebra-striped prettify">
	<thead>
		<tr>
			<th>Title</th>
			<th>Slug</th>
			<th>Summary</th>
			<th>Author</th>
			<th>Posted</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($posts as $post): ?>		<tr>

			<td><?php echo $post->title; ?></td>
			<td><?php echo $post->slug; ?></td>
			<td><?php echo Str::truncate($post->summary, 80); ?></td>
			<td><?php echo Html::anchor('admin/users/view/'.$post->user->id, ucwords($post->user->username)); ?></td>
			<td><?php echo Date::time_ago($post->created_at); ?></td>
			<td>
				<?php echo Html::anchor('admin/posts/edit/'.$post->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/posts/delete/'.$post->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Posts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/posts/create', 'Add new Post', array('class' => 'btn success')); ?>

</p>
