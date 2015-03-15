<?php
/**
 * SaleFixture
 *
 */
class SaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'client' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'dni' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'delivery_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'state_production' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'state_sale' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'production_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'client' => 'Lorem ipsum dolor sit amet',
			'dni' => 'Lorem ip',
			'quantity' => 1,
			'delivery_date' => '2015-03-15',
			'state_production' => 1,
			'state_sale' => 1,
			'product_id' => 1,
			'production_id' => 1,
			'created' => '2015-03-15 14:17:54',
			'modified' => '2015-03-15 14:17:54'
		),
	);

}
