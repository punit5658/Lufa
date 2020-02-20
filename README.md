# Lufa

Script provide a solution for box filling based on order volume.

- To check output and run file by : php lufa.php
- Update product id, product quantity, product volume in lufa.php

Function and Usages : 
- $order->calculate_boxes(); 
  This is a compalsary function to calculate how many boxes we need to complete order.

- $order->getbox_count()
  getbox_count function will give output of number of boxes output and each box has item which is display by index 0,1,2..

- $order->beautifyOutput( $order->getbox_count() ) 
  This function help user to identify product id and volumes by array key denoted by 'product_id' and 'volume'.

  
