<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    //Llamando a componentes 'Session' y 'Auth' y pasandole parametros a Auth component
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'username')
                )
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                //'plugin' => 'users'
            ),
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authorize' => array('Controller'),
            'authError' => 'Usted no puede acceder a este contenido'
        )
    );

    public function beforeFilter()
    {
        //Configuración de manejadores de autenticación
        $this->Auth->authenticate = array(
            AuthComponent::ALL => array(
                'userModel' => 'User',
                'fields' => array(
                    'username' => 'username',
                    ),
                'scope' => array(
                    'User.status' => 1,
                    ),
                ),
            'Form',
            );

        /*
        Hay muchas veces las acciones del controlador que desea mantendrá totalmente pública, o que no requieren que los usuarios estar registrado AuthComponent es pesimista, y por defecto es denegar el acceso. Puede marcar acciones como acciones públicas mediante el uso de AuthComponent :: permites (). Al marcar las acciones como pública, AuthComponent, no buscará un usuario conectado, ni autorizará comprobarse objetos:
        */
        // Permite todas las acciones. CakePHP 2.1
        //$this->Auth->allow();
        // Permitir sólo logut
        $this->Auth->allow('logout');
        //o:
        //$this->Auth->allow(array('view', 'index'));

        /*
        Puede configurar manejadores de autorización mediante  $this->Auth->authorize. Puede configurar uno o varios manejadores de autorización. El uso de varios controladores le permite soportar diferentes formas de comprobar la autorización. Cuando se comprueban los manipuladores de autorización, porque serán llamados en el orden en que se declaran. Los manipuladores deben devuelven false, si no son capaces de comprobar la autorización o el cheque ha fallado. Los manipuladores deben devolver true si fueran capaces de comprobar la autorización con éxito. Manipuladores serán llamados por orden hasta que uno pasa. Si todas las comprobaciones fallan, el usuario será redirigido a la página de procedencia. Además, puede poner fin a todas las autorizaciones de iniciando una excepción. Usted tendrá que ponerse las excepciones producidas y manejarlos.

        You can configure authorization handlers in your controller’s beforeFilter or, in the $components array. You can pass configuration information into each authorization object, using an array:
        */
        // Configuración básica para indicar q los manejadores de autorizacion seran los controladores:
        $this->Auth->authorize = array('Controller');

        // Pasar parámetros en
        /*
        $this->Auth->authorize = array(
            'Actions' => array('actionPath' => 'controllers/'),
            'Controller'
        );*/

        //Mandar datos para mostrar Bienvenido en home.ctp
        $this->set('logged_in', $this->Auth->loggedIn());
        $this->set('current_user', $this->Auth->user());

    }

	public function isAuthorized($user) {

        return true;

	}

}
