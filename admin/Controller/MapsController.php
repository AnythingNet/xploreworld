<?php
App::uses('AppController', 'Controller');

/**
 * Maps Controller
 *
 */
class MapsController extends AppController {

	public $uses = array('MapsAirport', 'Map', 'Media', 'Airport');

	/**
	 * マップの表示
	 */
  public function index() {

		if ($this->request->is('post')) {

			$this->Map->save($this->request->data['Map']);

			if ($this->Map->validates()) {
        $this->Session->setFlash('マップを追加しました。', 'default', array('class' => 'alert alert-success'));
				$this->redirect('index');
			}

		}

		$options = array(
			'contain' => array(
				'Media'
			)
		);

		$Maps = $this->Map->find('all', $options);

		if (0 < count($Maps)) {
			$this->set('Maps', $Maps);
		}

		$Media = $this->Media->findAllWithAttributes();
		$this->set('Media', $Media);

  }

  public function edit() {

    if ($this->request->isPost()) {

			if ($this->Map->save($this->request->data['Map'])) {
				$this->Session->setFlash('マップを編集しました。', 'default', array('class' => 'alert alert-success'));
			}

    }

    $this->redirect('index');

  }

  public function delete() {

    if ($this->request->isPost()) {

      if ($this->Map->delete($this->request->data['Map']['id'])) {
        $this->Session->setFlash('The map has been deleted.', 'default', array('class' => 'alert alert-success'));
      }

    }

    $this->redirect('index');

  }

	/**
	 * 空港情報の編集
	 */
	public function setting_airports() {

		if (isset($this->request->query['id'])) {

			$options = array(
				'conditions' => array(
					'id <' => 100
				)
			);

			$Airports = $this->Airport->find('list', $options);
			//pr($Airports);

			$selectAirportOptions = array(
				 'type' => 'select'
				,'options' => $Airports
				,'id' => 'select-airports'
				,'class' => 'form-control'
				,'div' => false
			);

			$pinOptions = array(
				'contain' => array(
					'Airport'
				)
				,'conditions' => array(
					'MapsAirport.map_id' => $this->request->query['id']
				)
			);

			//$Pins = $this->Map->find('first', $pinOptions);
			$this->paginate = $pinOptions;
			$Pins = $this->paginate();
			pr($Pins);

			$this->set('selectAirportOptions', $selectAirportOptions);
			$this->set('Pins', $Pins);

		} else {

			$this->redirect('index');

		}

	}

	/**
	 * 空港の追加
	 */
	public function add_airport() {
	}

	/**
	 * 空港の追加
	 */
	public function edit_airport() {

	}

}
