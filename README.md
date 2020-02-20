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
  
  
  Here is SQL Query : 

select final.DATE, count(final.`not returned asset`) FROM ( SELECT DATE_FORMAT(MAX(asset_activity.created), '%Y-%m-%d') AS DATE, COUNT(asset_activity.asset_id) AS `not returned asset` FROM `asset_activity` INNER JOIN asset ON asset.asset_id = asset_activity.asset_id AND asset.type_id = 1 WHERE asset_activity.location_id = 3 GROUP BY asset_activity.asset_id ORDER BY DATE ASC ) as final GROUP BY final.DATE

  
