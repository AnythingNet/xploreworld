<?php
App::uses('AppController', 'Controller');

/**
 * Maps Controller
 *
 */
class MapsController extends AppController {

	public $uses = array('MapsAirport', 'Map', 'Media', 'Airport');

  public $helpers = array(
    'Form' => array('className' => 'CustomForm')
  );

	/**
	 * マップの表示
	 */
  public function index() {

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

	public function add() {

		if ($this->request->isPost()) {

      $this->Map->create($this->request->data);

      if (!$this->Map->validates()) {

        $this->Session->setFlash('Please fill in the required fields.', 'default', array('class' => 'alert alert-danger'));

      } else if ($this->Map->save()) {

        $this->Session->setFlash('マップを追加しました。', 'default', array('class' => 'alert alert-success'));
				$this->redirect('index');

			} else {

        $this->Session->setFlash('The page could not be saved. Please try again.', 'default', array('class' => 'alert alert-danger'));

			}

		}

		$Media = $this->Media->findAllWithAttributes();
		$this->set('Media', $Media);

	}

  public function edit($id = null) {

    if ($this->request->isPost()) {

      $this->Map->create($this->request->data);
      $id = $this->request->data['Map']['id'];
      $this->Map->id = $id;

			$Map = $this->Map->findById($id);
			$this->set('image_path', $Map['Media']['path']);

      if (!$this->Map->validates()) {

        $this->Session->setFlash('Please fill in the required fields.', 'default', array('class' => 'alert alert-danger'));

      } else if ($this->Map->save()) {

        $this->Session->setFlash('マップを編集しました。', 'default', array('class' => 'alert alert-success'));
				$this->redirect('index');

			} else {

        $this->Session->setFlash('The page could not be saved. Please try again.', 'default', array('class' => 'alert alert-danger'));

			}

    } else if (is_null($id) || !$this->Map->findById($id)) {

			$this->redirect('index');

    } else {

			$Map = $this->Map->findById($id);
      $this->request->data = $Map;
			$this->set('image_path', $Map['Media']['path']);

    }

		$Media = $this->Media->findAllWithAttributes();
		$this->set('Media', $Media);

    $this->set('id', $id);

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
