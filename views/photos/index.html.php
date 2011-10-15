<?php $this->title('index')?>
<?php if (!count($photos)): ?>
	<em>No photos</em>. <?=$this->html->link('Add one', 'Photos::add'); ?>.
<?php endif ?>

<?php foreach ($photos as $photo): ?>
<div class="photo" style="width:120px;text-align:center;float:left">
	<?=$this->html->image("/photos/view/{$photo->_id}.jpe", array('width'=> 100)); ?>
	<?=$this->html->link($photo->title, array('Photos::view', 'id' => $photo->_id)); ?>
</div>
<?php endforeach ?>