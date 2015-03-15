<?php
App::uses('AppController', 'Controller');
/**
 * Pieces Controller
 *
 * @property Piece $Piece
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 */
class PiecesController extends AppController {

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
	    // Allow users to home.
	    // $this->Auth->allow('home');
	    //$this->Auth->autoRedirect = false; //q no entre a nada de permisos a otro usuario

        /*
        A veces, desea mostrar el error de autorización sólo después de que el usuario ya ha iniciado la sesión. Puede suprimir este mensaje estableciendo su valor a boolean false, es decir no mostrar mensajes de autorizacion o no autorizacion

        if (!$this->Auth->loggedIn()) {
            $this->Auth->authError = false;
        }
        */
        $this->Auth->autoRedirect = false;
	}

    public function isAuthorized($user)
    {
        if ($user['role'] == 'admin') {
            // Lo que pueden hacer todos los usuarios registrados administradores
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
            if ($user['role'] == 'compras')
            {
                // Lo que pueden hacer todos los usuarios registrados regentes
                if (in_array($this->action, array('add', 'view', 'index', 'edit', 'delete')))
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
                if ($user['role'] == 'ventas' or $user['role'] == 'produccion')
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
		$this->Piece->recursive = 0;
		$this->set('pieces', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Piece->exists($id)) {
			throw new NotFoundException(__('Invalid piece'));
		}
		$options = array('conditions' => array('Piece.' . $this->Piece->primaryKey => $id));
		$this->set('piece', $this->Piece->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Piece->create();
			if ($this->Piece->save($this->request->data)) {
				$this->Session->setFlash('La pieza ha sido registrada', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('La pieza no pudo ser registrada', 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Piece->exists($id)) {
			throw new NotFoundException(__('Invalid piece'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Piece->save($this->request->data)) {
				$this->Session->setFlash('La pieza fue modificada', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('La pieza no pudo ser modificada', 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Piece.' . $this->Piece->primaryKey => $id));
			$this->request->data = $this->Piece->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Piece->id = $id;
		if (!$this->Piece->exists()) {
			throw new NotFoundException(__('Invalid piece'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Piece->delete()) {
			$this->Session->setFlash('La pieza fue eliminada', 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('La pieza no pudo ser eliminada', 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
