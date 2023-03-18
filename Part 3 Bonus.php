<?php
include_once "conn_db.php";

if(isset($_POST['order_id'])){
    $table = "orders";
    
    $p_order_id = $_POST['order_id'];
    $p_quantity = $_POST['quantity'];

    // Retrieve order details
    $order_details = query($conn, "SELECT * FROM orders WHERE order_id = '$p_order_id'");

    if($order_details){
        // Calculate updated quantity
        $updated_quantity = $order_details[0]['quantity'] + $p_quantity;

        // Update quantity in database
        $fields = array('quantity' => $updated_quantity);
        $filter = array('order_id' => $p_order_id);

        if(update($conn, $table, $fields, $filter)){
            // Notify customer of successful update
            echo "<div class='alert alert-success'>Order updated successfully.</div>";
        }
        else{
            // Notify customer of failed update
            echo "<div class='alert alert-danger'>Failed to update order.</div>";
        }
    }
    else{
        // Notify customer that order does not exist
        echo "<div class='alert alert-danger'>Order does not exist.</div>";
    }
}
?>
