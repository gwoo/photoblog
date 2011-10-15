<h1>
	<?=$this->title($photo->title); ?>
	<em>[ <?=$this->html->link('edit', array('Photos::edit', 'id' => $photo->_id)); ?> ]</em>
</h1>
<p><?=$photo->description; ?></p>

<?php if ($photo->tags): echo 'tags:'; foreach ($photo->tags as $tag): ?>
	<?=$this->html->link($tag, array('Photos::index', 'args' => array($tag))); ?>
<?php endforeach; endif; ?>

<?=$this->html->image("/photos/view/{$photo->_id}.jpe", array(
	'alt' => $photo->title, 'width' => "100%"
)); ?>
