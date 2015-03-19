<?php
App::uses('AppController', 'Controller');

class ShoppingsController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js', 'Time');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'Session');


/**
 * AuthComponent
 *
 *
 */

	public function beforeFilter() {
	    parent::beforeFilter();
        $this->Auth->autoRedirect = false;
	}

    public function isAuthorized($user)
    {
        if ($user['role'] == 'admin') {
            if (in_array($this->action, array('index')))
            {
                return true;
            }
            else
            {
                if ($this->Auth->user('id'))
                {
                    $this->Session->setFlash('No puede acceder');
                    $this->redirect($this->Auth->redirect());
                }
            }
        }
        else
        {
            if ($user['role'] == 'produccion')
            {
                // Lo que pueden hacer todos los usuarios registrados regentes
                if (in_array($this->action, array('add')))
                {
                    return true;
                }
                else
                {
                    if ($this->Auth->user('id'))
                    {
                        $this->Session->setFlash('No puede acceder');
                        $this->redirect($this->Auth->redirect());
                    }
                }
            }
            elseif ($user['role'] == 'compras')
            {
                // Lo que pueden hacer todos los usuarios registrados regentes
                if (in_array($this->action, array('index')))
                {
                    return true;
                }
                else
                {
                    if ($this->Auth->user('id'))
                    {
                        $this->Session->setFlash('No puede acceder');
                        $this->redirect($this->Auth->redirect());
                    }
                }
            }
            else
            {
                if ($user['role'] == 'ventas')
                {
                	if ($this->Auth->user('id'))
                    {
                        $this->Session->setFlash('No puede acceder');
                        $this->redirect($this->Auth->redirect());
                    }
                }
            }
        }
        return parent::isAuthorized($user);
    }


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Shopping->recursive = 0;
		$this->set('shoppings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Shopping->exists($id)) {
			throw new NotFoundException(__('Invalid shopping'));
		}
		$options = array('conditions' => array('Shopping.' . $this->Shopping->primaryKey => $id));
		$this->set('shopping', $this->Shopping->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $pieces = $this->Shopping->Piece->find('list');
        $this->set(compact('pieces'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Production->exists($id)) {
			throw new NotFoundException(__('Invalid production'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash(__('The production has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Production.' . $this->Production->primaryKey => $id));
			$this->request->data = $this->Production->find('first', $options);
		}
		$products = $this->Production->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Production->id = $id;
		if (!$this->Production->exists()) {
			throw new NotFoundException(__('Invalid production'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Production->delete()) {
			$this->Session->setFlash(__('The production has been deleted.'));
		} else {
			$this->Session->setFlash(__('The production could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}