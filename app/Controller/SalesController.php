<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 */
class SalesController extends AppController {

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
            if (in_array($this->action, array('index', 'evaluation', 'add_utility')))
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
                // Lo que pueden hacer todos los usuarios registrados regentes
                if (in_array($this->action, array('add', 'view', 'index', 'edit', 'delete', 'confirm', 'sale_process', 'confirm_order')))
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
                if ($user['role'] == 'produccion' or $user['role'] == 'compras')
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
        $this->Paginator->settings = array(
            'order' => array('Sale.id' => 'desc'));
        $sales = $this->Paginator->paginate('Sale');
        $this->set(compact('sales'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
		$this->set('sale', $this->Sale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$client = $this->request->data['Sale']['client'];
			$dni = $this->request->data['Sale']['dni'];
			$product_id = $this->request->data['Sale']['product_id'];
			$quantity = $this->request->data['Sale']['quantity'];
			$delivery_date = $this->request->data['Sale']['delivery_date'];

			$product = $this->Sale->Product->find('all', array('conditions' => array('Product.id' => $product_id)));

			$price = $product[0]['Product']['price'];

			$total = $price * $quantity;

			$sale = array('client' => $client, 'dni' => $dni, 'quantity' => $quantity, 'total' => $total, 'delivery_date' => $delivery_date, 'product_id' => $product_id);

			if ($this->Sale->save($sale)) {
				$this->Session->setFlash('La venta ha sido registrada', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('La venta no pudo ser registrada', 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->Sale->Product->find('list');
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

		$confirma_pedido = $this->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$field_confirm = $confirma_pedido[0]['Sale']['confirm'];

		if ($field_confirm == 1)
		{
			$this->Session->setFlash('No puede modificar la venta porque su pedido ya está en proceso', 'default', array('class' => 'alert alert-warning'));
			return $this->redirect(array('action' => 'index'));
		}
		else
		{
			if (!$this->Sale->exists($id)) {
				throw new NotFoundException(__('Invalid sale'));
			}
			if ($this->request->is(array('post', 'put'))) {


				$id = $this->request->data['Sale']['id'];
				$client = $this->request->data['Sale']['client'];
				$dni = $this->request->data['Sale']['dni'];
				$product_id = $this->request->data['Sale']['product_id'];
				$quantity = $this->request->data['Sale']['quantity'];
				$delivery_date = $this->request->data['Sale']['delivery_date'];

				$product = $this->Sale->Product->find('all', array('conditions' => array('Product.id' => $product_id)));

				$price = $product[0]['Product']['price'];

				$total = $price * $quantity;

				$sale = array('id' => $id, 'client' => $client, 'dni' => $dni, 'quantity' => $quantity, 'total' => $total, 'delivery_date' => $delivery_date, 'product_id' => $product_id);

				if ($this->Sale->save($sale)) {
					$this->Session->setFlash('La venta ha sido modificada', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('La venta no pudo ser modificada', 'default', array('class' => 'alert alert-danger'));
				}
			} else {
				$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
				$this->request->data = $this->Sale->find('first', $options);
			}
			$products = $this->Sale->Product->find('list');
			$productions = $this->Sale->Production->find('list');
			$this->set(compact('products', 'productions'));
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
		$confirma_pedido = $this->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$cancel_sale = $confirma_pedido[0]['Sale']['cancel_sale'];

		if ($cancel_sale == 1)
		{
			$this->Session->setFlash('No puede cancelar la venta porque su pedido ya está en proceso', 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->Sale->id = $id;
			if (!$this->Sale->exists()) {
				throw new NotFoundException(__('Invalid sale'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Sale->delete()) {
				$this->Session->setFlash('La venta ha sido cancelada', 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash('La venta no pudo ser cancelada', 'default', array('class' => 'alert alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function confirm($id = null)
	{
		$confirma_pedido = $this->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$field_confirm = $confirma_pedido[0]['Sale']['confirm'];

		if ($this->request->is(array('post', 'put')))
		{
			if ($field_confirm == 1)
			{
				$this->Session->setFlash('Solo puede enviar su pedido una vez.', 'default', array('class' => 'alert alert-warning'));
				return $this->redirect(array('action' => 'view', $id));
			}
			else
			{
				$confirm = 1;
				$send_confirm = array('id' => $id, 'confirm' => $confirm, 'cancel_sale' => 1);
				if ($this->Sale->saveAll($send_confirm))
				{
					$this->Session->setFlash('Su solicitud fue enviada correctamente', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('No pudo ser enviado', 'default', array('class' => 'alert alert-danger'));
				}
			}
		}
	}

	public function sale_process($id = null)
	{
		$confirma_produccion = $this->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$state_production = $confirma_produccion[0]['Sale']['state_production'];
		$state_sale = $confirma_produccion[0]['Sale']['state_sale'];
		if ($this->request->is(array('post', 'put')))
		{
			if ($state_production == 0 or $state_sale == 1)
			{
				$this->Session->setFlash('La venta no pudo ser procesada', 'default', array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'view', $id));
			}
			else
			{
				$s_confirm = 1;
				$sale_confirm = array('id' => $id, 'state_sale' => $s_confirm);
				if ($this->Sale->saveAll($sale_confirm))
				{
					$this->Session->setFlash('La venta fue procesada con éxito', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Venta no pudo ser procesada', 'default', array('class' => 'alert alert-danger'));
				}
			}
		}
	}

	// Enviar pedido a produccón una vez haya sido confirmado por gerencia
	public function confirm_order($id = null)
	{
		$confirm_order = $this->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$field_confirm = $confirm_order[0]['Sale']['state_admin'];
		$order_confirm = $confirm_order[0]['Sale']['state_production'];

		if ($this->request->is(array('post', 'put')))
		{
			if ($field_confirm == 0)
			{
				$this->Session->setFlash('El pedido debe ser aprobado por gerencia.', 'default', array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'view', $id));
			}
			else
			{
				if($order_confirm == 1)
				{
					$this->Session->setFlash('El pedido ya está en producción.', 'default', array('class' => 'alert alert-warning'));
					return $this->redirect(array('action' => 'view', $id));
				}
				else
				{
					$confirm = 1;
					$send_confirm = array('id' => $id, 'state_order' => $confirm, 'cancel_sale' => 1);
					if ($this->Sale->saveAll($send_confirm))
					{
						$this->Session->setFlash('El pedido fue confirmado y enviado a producción', 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash('No pudo ser enviado', 'default', array('class' => 'alert alert-danger'));
					}
				}
			}
		}
	}

	// Lista de evaluacion enviado desde produccion a administrador
	public function evaluation()
	{
        $this->Paginator->settings = array(
            'conditions' => array('Sale.state_evaluation' => 1, 'Sale.state_admin' => 0));
        $evaluations = $this->Paginator->paginate('Sale');
        $this->set(compact('evaluations'));
	}

	//Agegando utilidad del pedido y enviando ventas
	public function add_utility($id = null)
	{
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			$this->Sale->set( $this->data );
			if ($this->Sale->validates(array('fieldList' => array('utility'))))
			{
				$utility = $this->request->data['Sale']['utility'];
				$total = $this->request->data['Sale']['total'];
				$total_sale = $total + $utility;

				$save_total_sale = array('id' => $id, 'total_sale' => $total_sale, 'state_admin' => 1, 'cancel_sale' => 0);
				if ($this->Sale->save($save_total_sale))
				{
					$this->Session->setFlash('La venta ha sido confirmada por gerencia', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'evaluation'));
				} else {
					$this->Session->setFlash('La venta no pudo ser confirmada', 'default', array('class' => 'alert alert-danger'));
					return $this->redirect(array('action' => 'evaluation'));
				}
			}
			else
			{
			    $this->Sale->validationErrors;
			}
		}
		$assess = $this->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$this->set(compact('assess'));
	}



}
