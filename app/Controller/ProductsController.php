<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

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
            if ($user['role'] == 'produccion')
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
                if ($user['role'] == 'ventas' or $user['role'] == 'compras')
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
		$this->Product->recursive = -1;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash('El producto ha sido creado', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('El producto no pudo ser creado.', 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash('El producto ha sido modificado', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('El producto no pudo ser modificado.', 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
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

		$this->Product->Sale->recursive = 0;
		$sale = $this->Product->Sale->find('all', array('conditions' => array('Sale.product_id' => $id)));

		if(count($sale) > 0)
		{
			$this->Session->setFlash('El producto no puede ser eliminado', 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->Product->id = $id;
			if (!$this->Product->exists()) {
				throw new NotFoundException(__('Invalid product'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Product->delete()) {
				$this->Session->setFlash('El usuario ha sido eliminado.', 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash('El producto no pudo ser eliminado.', 'default', array('class' => 'alert alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		}
	}
}
