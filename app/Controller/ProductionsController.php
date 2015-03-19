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
                if (in_array($this->action, array('add', 'view', 'index', 'edit', 'delete', 'pending', 'submit', 'assess')))
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
		if ($this->request->is('post'))
		{
			$piezas = $this->Production->Piece->find('all');
			$cantidad = $this->data['Production']['quantity'];
			$product_id = $this->data['Production']['product_id'];

			$menor = null;
			for($i = 0; $i<(count($piezas)); $i++)
			{
				$menor[] = $piezas[$i]['Piece']['quantity'];
			}

			$min = min($menor);

			if($cantidad >= $min)
			{
				$nueva_cantidad = $min;
			}

			if(isset($nueva_cantidad))
			{
				for ($j = 0; $j < count($piezas); $j++)
				{
					$id_pieza = $piezas[$j]['Piece']['id'];
					$total_piezas = $piezas[$j]['Piece']['quantity'] - $nueva_cantidad;
					$save_total = array('id' => $id_pieza, 'quantity' => $total_piezas);
					$this->Production->Piece->save($save_total);
				}
				//Sumando cantidad a stock de productos
				$this->Production->Product->recursive = -1;
				$cantidad_producto = $this->Production->Product->find('all', array('conditions' => array('Product.id' => $product_id)));
				$cantidad_actual = $cantidad_producto[0]['Product']['quantity'];
				$cantidad_total = $cantidad_actual + $nueva_cantidad;
				$nueva_cantidad_producto = array('id' => $product_id, 'quantity' => $cantidad_total);
				$this->Production->Product->save($nueva_cantidad_producto);

				$this->Production->create();
				if ($this->Production->save($this->request->data)) {
					$this->Session->setFlash('<ul><li>Unidades producidas con éxito: ' . $nueva_cantidad . '</li><li> Unidades aún faltantes: '. ($cantidad - $nueva_cantidad) . '</li></ul>', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'add'));
				}
				else
				{
	                $this->Session->setFlash('No se pudo procesar la solicitud.', 'default', array('class' => 'alert alert-danger'));
				}

			}


			for($k = 0; $k<(count($piezas)); $k++)
			{
					$id_pieza = $piezas[$k]['Piece']['id'];
					$total_piezas = $piezas[$k]['Piece']['quantity'] - $cantidad;
					$save_total = array('id' => $id_pieza, 'quantity' => $total_piezas);
					$this->Production->Piece->save($save_total);
			}


			//Sumando cantidad a stock de productos
			$this->Production->Product->recursive = -1;
			$cantidad_producto = $this->Production->Product->find('all', array('conditions' => array('Product.id' => $product_id)));
			$cantidad_actual = $cantidad_producto[0]['Product']['quantity'];
			$cantidad_total = $cantidad_actual + $cantidad;
			$nueva_cantidad_producto = array('id' => $product_id, 'quantity' => $cantidad_total);
			$this->Production->Product->save($nueva_cantidad_producto);

			$this->Production->create();
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash('Unidades producidas con éxito: ' . $cantidad, 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'add'));
			}
			else
			{
                $this->Session->setFlash('No se pudo procesar la solicitud.', 'default', array('class' => 'alert alert-danger'));
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
            'conditions' => array('Sale.confirm' => 1),
            'order' => array('Sale.id' => 'desc'));
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
		$confirm_order = $pedido[0]['Sale']['state_order'];


		if ($confirm_order == 0)
		{
			$this->Session->setFlash('Necesita confirmación de ventas para enviar el pedido', 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'pending'));
		}
		elseif($confirm_order == 1)
		{
			if ($cantidad_sale > $cantidad_product)
			{
				$total_faltantes = $cantidad_sale - $cantidad_product;
				$this->Session->setFlash('Faltan <strong>' . $total_faltantes . '</strong> unidad (es) del producto <strong>' . $name_product .'</strong>, se recomienda producir nuevas unidades', 'default', array('class' => 'alert alert-danger'));
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
		}

		$this->autoRender = false;
	}

	public function assess($id = null)
	{
		if (!$this->Production->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$evaluation = $this->Production->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
		$state_evaluation = $evaluation[0]['Sale']['state_evaluation'];
		if($state_evaluation == 1)
		{
			$this->Session->setFlash('El avaluo ya fue enviado a gerencia', 'default', array('class' => 'alert alert-warning'));
			return $this->redirect(array('action' => 'pending'));
		}
		else
		{
			if ($this->request->is(array('post', 'put')))
			{
				$date_production = $this->request->data['Production']['date_production'];
				$save_date_production = array('id' => $id, 'date_production' => $date_production, 'state_evaluation' => 1);
				if ($this->Production->Sale->save($save_date_production))
				{
					$this->Session->setFlash('El avaluo fue enviado a gerencia', 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'pending'));
				} else {
					$this->Session->setFlash('El avaluo no fue enviado', 'default', array('class' => 'alert alert-danger'));
					return $this->redirect(array('action' => 'pending'));
				}

			}
			$assess = $this->Production->Sale->find('all', array('conditions' => array('Sale.id' => $id)));
			$this->set(compact('assess'));
		}
	}
}
