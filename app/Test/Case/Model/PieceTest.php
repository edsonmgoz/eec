<?php
App::uses('Piece', 'Model');

/**
 * Piece Test Case
 *
 */
class PieceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.piece',
		'app.production',
		'app.product',
		'app.sale'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Piece = ClassRegistry::init('Piece');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Piece);

		parent::tearDown();
	}

}
