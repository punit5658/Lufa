<?php
require 'product.php';
require 'order.php';
$product_item   = array();
$product_item[] = new Product( 40, 1, 12000 );
$product_item[] = new Product( 33, 4, 2500 );
$product_item[] = new Product( 35, 3, 1500 );
$product_item[] = new Product( 41, 1, 1500 );
$product_item[] = new Product( 34, 3, 500 );
$product_item[] = new Product( 45, 1, 500 );

$order = new Order( $product_item );
// Calculate Boxes
$order->calculate_boxes(); // Compalsary Call for calculate boxes
// Simple Array Output
//var_dump( $order->getbox_count() ); // It will display 'Total Box' & 'Box Items' with Index
// Beautify Output
var_dump( $order->beautifyOutput( $order->getbox_count() ) ); // It will display 'Total Box' & 'Box Items with product ID'

// echo '<pre>' . var_export($order, true) . '</pre>';


