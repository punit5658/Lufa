<?php
/**
 * Product class
 */
class Product {
	/**
	 * Product Volume
	 *
	 * @var [integer]
	 */
	private $volume;
	/**
	 * Product ID
	 *
	 * @var [integer]
	 */
	private $product_id;


	/**
	 * Intialize product
	 *
	 * @param integer $product_id Product id.
	 * @param integer $quantity Product Quantity.
	 * @param integer $volume Product volume.
	 * @param float   $price Product price.
	 * @return void
	 */
	public function __construct( $product_id, $quantity, $volume ) {
		$this->volume     = $volume;
		$this->quantity   = $quantity;
		$this->product_id = $product_id;
	}
	/**
	 * Function will return product.
	 **/
	public function get_product() {
		return [ $this->product_id, $this->quantity, $this->volume ];
	}
}
