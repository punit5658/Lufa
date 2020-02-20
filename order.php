<?php
/**
 * Order class
 */
class Order {
	/**
	 * Order quantity
	 *
	 * @var [integer]
	 */
	private $quantity;
	/**
	 * Order ID
	 *
	 * @var [integer]
	 */
	private $id;
	/**
	 * Order Items
	 *
	 * @var [array]
	 */
	private $order_items;
	/**
	 * Order boxes
	 *
	 * @var [integer]
	 */
	private $order_boxes = 1;
	/**
	 * Total Volume
	 *
	 * @var [integer]
	 */
	private $total_volume = 0;
	/**
	 * Require Box
	 *
	 * @var [integer]
	 */
	private $require_boxes = [];
	/**
	 * Count Box
	 *
	 * @var [integer]
	 */
	private $count_box = 0;
	/**
	 * Intialize Order
	 *
	 * @param array $order_items Order items.
	 * @return void
	 */
	public function __construct( $order_items ) {
		$this->order_items  = $order_items;
		$this->total_volume = $this->total_volume();
		// $this->order_boxes  = $this->calculate_boxes();
	}
	/**
	 * Count box for order.
	 *
	 * @return void.
	 */
	public function calculate_boxes() {
		// For each order items ( product ) volume.
		$volume = 0;
		foreach ( $this->order_items as $product ) {
			$product_items[] = $product->get_product();
		}
		$this->order_boxes = $this->fillboxes( $product_items );
	}
	/**
	 * Return Box count and their product items
	 *
	 * @return array
	 */
	public function getbox_count() {
		return [
			'total_box' => $this->count_box,
			'box_items' => $this->require_boxes,
		];
	}

	/**
	 * Total Volume of product.
	 *
	 * @return int.
	 */
	public function total_volume() {
		$total_volume = 0;

		foreach ( $this->order_items as $product ) {
			$product_items[] = $product->get_product();
		}
		foreach ( $product_items as $item ) {
			$total_volume += $item[1] * $item[2];
		}
		return $this->total_volume = $total_volume;
	}

	/**
	 * Fillbox function
	 *
	 * @param [array] $product_items Array of items.
	 * @param integer $box_weight Box weight.
	 * @param integer $add_weight Completed Weight during fillup.
	 * @param array   $box_items Box Items.
	 * @return int
	 */
	public function fillboxes( $product_items = array(), $box_weight = 0, $add_weight = 0, $box_items = [] ) {

		$number_of_item = count( $product_items );
		$old_weight     = $add_weight;
		for ( $i = 0; $i < $number_of_item; $i++ ) {
			if ( $product_items[ $i ][1] !== 0 ) {
				$max_size = ( $product_items[ $i ][2] + $box_weight );
				if ( $max_size <= 15000 ) {

					$product_items[ $i ][1]--;
					$box_items[] = $product_items[ $i ];
					$add_weight += $product_items[ $i ][2];
					$box_weight += $product_items[ $i ][2];
				}
			}
		}
		if ( $add_weight !== $this->total_volume ) { // Check for total order volume with completed volume.
			if ( $old_weight === $add_weight ) { // Check old box volume to updated volume.
				$this->require_boxes[] = $box_items;
				$this->count_box++;
				$box_weight = 0;
				$box_items  = array();
			}
			// Call function recursively.
			$this->fillboxes( $product_items, $box_weight, $add_weight, $box_items );
		} else {
			$this->count_box++;
			$this->require_boxes[] = $box_items;
		}
	}

	public function beautifyOutput( $result_array = [] ) {
		$new_arr = [];
		if ( isset( $result_array['box_items'] ) ) :
			foreach ( $result_array['box_items'] as $key1 => $boxes ) {
				foreach ( $boxes as $key2 => $item ) {
					$new_arr['box_items'][ $key1 ][ $result_array['box_items'][ $key1 ][ $key2 ][0] ][] = $result_array['box_items'][ $key1 ][ $key2 ][0];
					// $result_array['box_items'][ $key1 ][$result_array['box_items'][ $key1 ][ $key2 ][2]] = $result_array['box_items'][ $key1 ][ $key2 ][2];
				}
			}
			echo 'Total Number of BOX : ' . $result_array['total_box'];
			foreach ( $new_arr as $key => $boxcount ) {

				foreach ( $boxcount as $pid => $value ) {

					echo "\nBox Details: " . ( $pid + 1 );
					foreach ( $value as $id => $total ) {
						echo "\nProduct ID {$id} and Quantity " . count( $value[ $id ] );
					}
				}
			}
			echo "\n";
		endif;
		$new_arr['total_box'] = $result_array['total_box'];
		return $new_arr;
	}
}
