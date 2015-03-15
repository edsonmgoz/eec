<?php
App::uses('AppController', 'Controller');
/**
 * Productions Controller
 *
 * @property Production $Production
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 */
class ProductionsController extends AppController {

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
            if ($user['role'] == 'produccion')
            {
                // Lo que pueden hacer todos los usuarios registrados regentes
                if (in_array($this->action, array('add', 'view', 'index', 'edit', 'delete', 'pending', 'submit')))
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
		$this->Production->recursive = 0;
		$this->set('productions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Production->exists($id)) {
			throw new NotFoundException(__('Invalid production'));
		}
		$options = array('conditions' => array('Production.' . $this->Production->primaryKey => $id));
		$this->set('production', $this->Production->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Production->create();
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash(__('The production has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production could not be saved. Please, try again.'));
			}
		}
		$products = $this->Production->Product->find('list');
		$this->set(compact('products'));
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

	public function pending()
	{

		$this->Production->Sale->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Sale.confirm' => 1));
        $sales = $this->Paginator->paginate('Sale');
        $this->set(compact('sales'));
	}

	public function submit($id = null)
	{
		$this->Production->Sale->recursive = 0;
		$pedido = $this->Production->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$cantidad_sale = $pedido[0]['Sale']['quantity'];
		$cantidad_product = $pedido[0]['Product']['quantity'];
		$id_producto = $pedido[0]['Product']['id'];
		$state_production = $pedido[0]['Sale']['state_production'];
		$name_product = $pedido[0]['Product']['name'];

		if ($cantidad_sale > $cantidad_product)
		{
			$total_faltantes = $cantidad_sale - $cantidad_product;
			$this->Session->setFlash('Faltan <strong>' . $total_faltantes . '</strong> unidade (s) del producto <strong>' . $name_product .'</strong>, se recomienda producir nuevas unidades', 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'add'));
		}
		else
		{
			// echo "si puedes producir";
			if($state_production == 1)
			{
				$this->Session->setFlash('El pedido ya ha sido enviado', 'default', array('class' => 'alert alert-warning'));
				return $this->redirect(array('action' => 'pending'));
			}
			else
			{
				$total_producto = $cantidad_product - $cantidad_sale;
				$guardar_total = array('id' => $id_producto, 'quantity' => $total_producto);
				if ($this->Production->Sale->Product->saveAll($guardar_total))
				{
					$confirm_submit = 1;
					$send_confirm = array('id' => $id, 'state_production' => $confirm_submit);
					$this->Production->Sale->saveAll($send_confirm);
					$this->Session->setFlash('El pedido ha sido enviado con éxito', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'pending'));
				} else {
					$this->Session->setFlash('El pedido no pudo ser enviado', 'default', array('class' => 'alert alert-danger'));
					return $this->redirect(array('action' => 'pending'));
				}
			}
		}
		$this->autoRender = false;
	}
	public function demand()
	{

	}
}
