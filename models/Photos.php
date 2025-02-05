<?php

namespace photoblog\models;

use li3_geo\extensions\Geocoder;

class Photos extends \li3_behaviors\extensions\Model {

	public $validates = array();

	protected $_meta = array('source' => 'fs.files');

	protected $_actsAs = array();

	public function save($entity, $data = null, array $options = array()) {
		if ($data) {
			$entity->set($data);
		}

		if (!$entity->exists() && isset($entity->file->tmp_name)) {
			$entity->location = Geocoder::exifCoords(exif_read_data($entity->file->tmp_name));
		}

		if ($entity->tags && !is_array($entity->tags)) {
			$entity->tags = array_map('trim', explode(',', $entity->tags));
		}
		return parent::save($entity, null, $options);
	}
}

?>