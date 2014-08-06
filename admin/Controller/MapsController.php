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
	 * show map
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

        $this->Session->setFlash('The map has been created', 'default', array('class' => 'alert alert-success'));
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

        $this->Session->setFlash('The map has been updated', 'default', array('class' => 'alert alert-success'));
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
	 * edit airport details
	 */
	public function setting_airports($map_id = null) {

		if ($this->request->isPost()) {


    } else if (is_null($map_id) || !$this->Map->findById($map_id)) {

			$this->redirect('index');

		}

		$pinOptions = array(
			'conditions' => array(
				'MapsAirport.map_id' => $map_id
			)
			,'order' => array(
				'Airport.name' => 'ASC'
			)
		);

		$this->MapsAirport->bindModel(
			array('belongsTo' => array('Airport'))
		);
		$this->paginate = $pinOptions;
		$Pins = $this->paginate();

		$this->set('Pins', $Pins);

		$this->set('map_id', $map_id);

	}

	/**
	 * add airports
	 */
	public function add_airport($map_id = null) {

		if ($this->request->isPost()) {

			$country = $this->request->data['MapsAirport']['country'];
			unset($this->request->data['MapsAirport']['country']);

			$map_id = $this->request->data['MapsAirport']['map_id'];

      $this->MapsAirport->create($this->request->data);

      if (!$this->MapsAirport->validates()) {

        $this->Session->setFlash('Please fill in the required fields.', 'default', array('class' => 'alert alert-danger'));

      } else if ($this->MapsAirport->save()) {

        $this->Session->setFlash('Pins have been updated', 'default', array('class' => 'alert alert-success'));
				$this->redirect('setting_airports/'.$map_id);

			} else {

        $this->Session->setFlash('The page could not be saved. Please try again.', 'default', array('class' => 'alert alert-danger'));

			}

    } else if (is_null($map_id) || !$this->Map->findById($map_id)) {

			$this->redirect('index');

		}

		$countries = $this->Airport->getCountries();

		$selectCountryOptions = array(
			 'type' => 'select'
			,'options' => $countries
			,'empty' => '--- Select Country ---'
			,'id' => 'select-countries'
			,'data-app-url' => Router::url('/maps/get_airport_option')
			,'class' => 'form-control'
			,'div' => false
		);
		if (isset($country)) {
			$selectCountryOptions['value'] = $country;
		}

		$selectAirportOptions = array(
			 'type' => 'select'
			,'empty' => '--- Select Airport ---'
			,'id' => 'select-airports'
			,'class' => 'form-control'
			,'div' => false
		);

		$this->set('selectCountryOptions', $selectCountryOptions);
		$this->set('selectAirportOptions', $selectAirportOptions);

		$this->set('map_id', $map_id);

    $this->set('images', $this->Media->findAllWithAttributes());

	}

	/**
	 * edit pins
	 */
	public function edit_airport($id = null) {

    if ($this->request->isPost()) {

			$country = $this->request->data['MapsAirport']['country'];
			unset($this->request->data['MapsAirport']['country']);

      $this->MapsAirport->create($this->request->data);
      $id = $this->request->data['MapsAirport']['id'];
      $this->MapsAirport->id = $id;

			$MapsAirport = $this->MapsAirport->findById($id);

      if (!$this->MapsAirport->validates()) {

        $this->Session->setFlash('Please fill in the required fields.', 'default', array('class' => 'alert alert-danger'));

      } else if ($this->MapsAirport->save()) {

        $this->Session->setFlash('Map has been updated', 'default', array('class' => 'alert alert-success'));
				$this->redirect('setting_airports/'.$MapsAirport['Map']['id']);

			} else {

        $this->Session->setFlash('The page could not be saved. Please try again.', 'default', array('class' => 'alert alert-danger'));

			}

    } else if (is_null($id) || !$this->MapsAirport->findById($id)) {

			$this->redirect('index');

    } else {

			$MapsAirport = $this->MapsAirport->findById($id);
			$country = $MapsAirport['Airport']['country'];
      $this->request->data = $MapsAirport;

    }

		$countries = $this->Airport->getCountries();

		$selectCountryOptions = array(
			 'type' => 'select'
			,'options' => $countries
			,'empty' => '--- Select Country ---'
			,'id' => 'select-countries'
			,'value' => $country
			,'data-app-url' => Router::url('/maps/get_airport_option')
			,'class' => 'form-control'
			,'div' => false
		);

		$Airports = $this->Airport->find('list');

		$selectAirportOptions = array(
			 'type' => 'select'
			,'options' => $Airports
			,'empty' => '--- Select Airport ---'
			,'id' => 'select-airports'
			,'class' => 'form-control'
			,'div' => false
		);

		$this->set('selectCountryOptions', $selectCountryOptions);
		$this->set('selectAirportOptions', $selectAirportOptions);

    $this->set('id', $id);
    $this->set('map_id', $MapsAirport['Map']['id']);

    $this->set('images', $this->Media->findAllWithAttributes());

	}

  public function delete_airport() {

    if ($this->request->isPost()) {

      if ($this->MapsAirport->delete($this->request->data['MapsAirport']['id'])) {
        $this->Session->setFlash('The pin has been deleted.', 'default', array('class' => 'alert alert-success'));
      }

    }

    $this->redirect('setting_airports/'.$this->request->data['MapsAirport']['map_id']);

  }

	public function get_airport_option() {

		if ($this->request->isPost()) {


			if (empty($this->request->data['country'])) {

				$airports = $this->Airport->find('list');

			} else {

				$country = $this->request->data['country'];

				$options = array(
					'conditions' => array(
						'country' => $country
					)
				);

				$airports = $this->Airport->find('list', $options);

			}

			$this->set('airports', $airports);
			$this->set('airport_id', $this->request->data['airport_id']);

			$this->layout = false;

		}

	}

}
