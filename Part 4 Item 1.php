<?php

    //delete_product.php

include_once "conn_db.php";

if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];
    $params = array($item_id);
    
    if(query($conn, "DELETE FROM products WHERE item_id = ?", $params) ){
       header("location: product_display.php?product_delete=done");
       exit();
    }
    else{
       header("location: product_display.php?product_delete=failed");
       exit();
    } 
}
?>

15.	BONUS: Write any other Situational Cases that you will encounter with your own Web Systems - related to your Systems Database. Provide similar solution using Delete

Situational Case: Suppose a customer made an order, but later decided to cancel it. In this case, we need to delete the order from the database.

<?php
include_once "conn_db.php";
if(isset($_GET['order_id'])){
   if(query($conn, "DELETE FROM orders WHERE order_id = ?", $params) ){
       header("location: order_history.php?order_delete=done");
       exit();
   }
   else{
       header("location: order_history.php?order_delete=failed");
       exit();
   } 
}