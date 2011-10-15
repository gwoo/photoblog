<?php

namespace photoblog\controllers;

use photoblog\models\Photos;
use li3_geo\extensions\Geocoder;

class PhotosController extends \lithium\action\Controller {

	public function index($tags = null) {
		$conditions = $tags ? compact('tags') : array();
		$photos = Photos::all(compact('conditions'));
		return compact('photos');
	}

	public function view() {
		$photo = Photos::first($this->request->id);
		return compact('photo');
	}

	public function near($place = null) {
		$this->_render['template'] = 'index';
		$coords = Geocoder::find('google', $place);

		$photos = Photos::within(array($coords, $coords), array('limit' => 1));
		return compact('photos');
	}

	public function add() {
		$photo = Photos::create();

		if (($this->request->data) && $photo->save($this->request->data)) {
			$this->redirect(array('Photos::view', 'id' => $photo->_id));
		}
		$this->_render['template'] = 'edit';
		return compact('photo');
	}

	public function edit() {
		$photo = Photos::find($this->request->id);

		if (!$photo) {
			$this->redirect('Photos::index');
		}
		if (($this->request->data) && $photo->save($this->request->data)) {
			$this->redirect(array('Photos::view', 'id' => $photo->_id));
		}
		return compact('photo');
	}
}

?>