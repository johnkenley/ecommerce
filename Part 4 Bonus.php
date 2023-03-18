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
