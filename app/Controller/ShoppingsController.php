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
            if (in_array($this->action, array('pending', 'process')))
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
                if (in_array($this->action, array('index', 'process')))
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
 * add method
 *
 * @return void
 */
	public function add($id = null)
    {
        $state = $this->Shopping->Piece->find('all', array('conditions' => array('Piece.id' => $id)));
        $state_actual = $state[0]['Piece']['state'];

        if ($state_actual == 1)
        {
            $this->Session->setFlash('La solicitud de pieza ya está en proceso.', 'default', array('class' => 'alert alert-warning'));
            return $this->redirect(array('controller' => 'pieces', 'action' => 'index'));
        }
        elseif($state_actual == 0)
        {
            if ($this->request->is('post'))
            {
                $this->Shopping->create();
                if ($this->Shopping->save($this->request->data)) {
                    $update_piece = array('id' => $id, 'state' => 1);
                    $this->Shopping->Piece->save($update_piece);
                    $this->Session->setFlash('Su solicitud fue enviada a compras.', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('controller' => 'pieces', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('La solicitud no pudo ser enviada, intente nuevamete.', 'default', array('class' => 'alert alert-danger'));
                }
            }

            $pieces = $this->Shopping->Piece->find('first', array('conditions' => array('Piece.id' => $id)));
            $this->set(compact('pieces'));
        }
	}

    // Procesando TODO compras
    public function process($id = null)
    {
        if (!$this->Shopping->exists($id)) {
            throw new NotFoundException(__('Invalid piece'));
        }
        $compra = $this->Shopping->find('all', array('conditions' => array('Shopping.id' => $id)));
        $state_piece = $compra[0]['Piece']['state'];
        $state_shopping = $compra[0]['Shopping']['state_shopping'];
        $state_admin = $compra[0]['Shopping']['state_admin'];
        $state_provider = $compra[0]['Shopping']['state_provider'];
        if($state_shopping == 0 and $state_admin == 0)
        {
            // Enviando solicitud a administrador
            $message_success = "Su consulta fue enviada a gerencia";
            $message_danger = "Su consulta no pudo ser enviada";
            $accion = "index";
            $this->change_state('Shopping', 'state_shopping', 1, $id, $message_success, $message_danger, $accion);
        }
        elseif($state_shopping == 1 and $state_admin == 0)
        {
            // Administrador autoriza compra de piezas a compras
            $message_success = "La compra fue autorizada";
            $message_danger = "La compra no pudo ser autorizada";
            $accion = "pending";
            $this->change_state('Shopping', 'state_admin', 1, $id, $message_success, $message_danger, $accion);
        }
        elseif ($state_shopping == 1 and $state_admin == 1)
        {
            // Compras compra las piezas a proveedor
            $id_pieza = $compra[0]['Piece']['id'];
            $cantidad_compra = $compra[0]['Shopping']['quantity'];
            $cantidad_pieza = $compra[0]['Piece']['quantity'];
            $total_commpra = $cantidad_compra + $cantidad_pieza;
            $sumar_compra = array('id' => $id_pieza, 'quantity' => $total_commpra);
            $this->Shopping->Piece->save($sumar_compra);

            // cambiar estado de state_provider
            $change_piece = array('id' => $id_pieza, 'state' => 0);

            if ($this->Shopping->Piece->save($change_piece))
            {
                $this->Session->setFlash('La compra se realizó con éxito', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'shoppings', 'action' => 'index'));
            } else {
                $this->Session->setFlash('La compra no pudo ser realizada', 'default', array('class' => 'alert alert-danger'));
            }
        }

        $this->autoRender = false;

    }

    public function change_state($model, $state, $value, $id, $message_success, $message_danger, $accion)
    {
        $change = array('id' => $id, $state => $value);

        if ($this->$model->save($change))
        {
            $this->Session->setFlash($message_success, 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('controller' => 'shoppings', 'action' => $accion));
        } else {
            $this->Session->setFlash($message_danger, 'default', array('class' => 'alert alert-danger'));
        }
        $this->autoRender = false;
    }

    public function pending()
    {
        $this->Shopping->recursive = 0;

        $this->Paginator->settings = array(
            'conditions' => array('Shopping.state_shopping' => 1, 'Shopping.state_admin' => 0));
        $shoppings = $this->Paginator->paginate('Shopping');
        $this->set(compact('shoppings'));
    }
}