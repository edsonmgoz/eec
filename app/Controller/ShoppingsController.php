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
            if (in_array($this->action, array('pending', 'authorize', 'index')))
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
                if (in_array($this->action, array('index', 'consult', 'shop')))
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
        $this->Paginator->settings = array(
            'order' => array('Shopping.id' => 'desc'));
        $shoppings = $this->Paginator->paginate('Shopping');
        $this->set(compact('shoppings'));
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

    public function consult($id = null)
    {
        if (!$this->Shopping->exists($id)) {
            throw new NotFoundException(__('Invalid piece'));
        }


        $compra = $this->Shopping->find('all', array('conditions' => array('Shopping.id' => $id)));
        $state_shopping = $compra[0]['Shopping']['state_shopping'];

        if($state_shopping == 1)
        {
            $this->Session->setFlash('Ocurrió un error al realizar la consulta', 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'shoppings', 'action' => 'index'));
        }
        elseif ($state_shopping == 0)
        {
            $state_shopping_save = array('id' => $id, 'state_shopping' => 1);
            if ($this->Shopping->save($state_shopping_save))
            {
                $this->Session->setFlash('Su consulta fue enviada a gerencia', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'shoppings', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Su consulta no pudo ser enviada', 'default', array('class' => 'alert alert-danger'));
            }
        }
        $this->autoRender = false;
    }

    public function authorize($id = null)
    {
        if (!$this->Shopping->exists($id)) {
            throw new NotFoundException(__('Invalid piece'));
        }
        $state_admin_save = array('id' => $id, 'state_admin' => 1);
        if ($this->Shopping->save($state_admin_save))
        {
            $this->Session->setFlash('La compra fue autorizada', 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('controller' => 'shoppings', 'action' => 'pending'));
        } else {
            $this->Session->setFlash('La compra no pudo ser autorizada', 'default', array('class' => 'alert alert-danger'));
        }
        $this->autoRender = false;
    }

    public function shop($id = null)
    {
        if (!$this->Shopping->exists($id)) {
            throw new NotFoundException(__('Invalid piece'));
        }
        $compra = $this->Shopping->find('all', array('conditions' => array('Shopping.id' => $id)));
        $id_pieza = $compra[0]['Piece']['id'];
        $cantidad_compra = $compra[0]['Shopping']['quantity'];
        $cantidad_pieza = $compra[0]['Piece']['quantity'];
        $total_commpra = $cantidad_compra + $cantidad_pieza;
        $state_admin = $compra[0]['Shopping']['state_admin'];
        $state_provider = $compra[0]['Shopping']['state_provider'];

        if ($state_admin == 0 or $state_provider == 1)
        {
            $this->Session->setFlash('Ocurrió un error al realizar la compra', 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'shoppings', 'action' => 'index'));
        }
        elseif ($state_admin == 1)
        {
            $change_state_provider = array('id' => $id, 'state_provider' => 1);
            $this->Shopping->save($change_state_provider);

            // cambiar estado de state_provider
            $change_piece = array('id' => $id_pieza,'quantity' => $total_commpra, 'state' => 0);

            if ($this->Shopping->Piece->save($change_piece))
            {
                $this->Session->setFlash('La compra se realizó con éxito', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'shoppings', 'action' => 'index'));
            } else {
                $this->Session->setFlash('La compra no pudo ser realizada', 'default', array('class' => 'alert alert-danger'));
            }            # code...
        }


        $this->autoRender = false;
    }

    public function pending()
    {
        $this->Shopping->recursive = 0;

        $this->Paginator->settings = array(
            'conditions' => array('Shopping.state_shopping' => 1, 'Shopping.state_admin' => 0), 'order' => array('Shopping.id' => 'desc'));
        $shoppings = $this->Paginator->paginate('Shopping');
        $this->set(compact('shoppings'));
    }
}