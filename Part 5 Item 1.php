<IDOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Burger Bite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to Burger Bite</h1>
    
    <?php
// Connect to database include_once 'db_conn.php’;
    
    // Retrieve the product information from the database
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
    
    // Display the product information on the shop interface
    if (mysgli_num_rows($result) > 0) {
        while ($row =
mysqli_fetch_assoc($result)) {
            echo <div>";
            echo '<h2>". $row['prod_name’] .
'</h2>";
            echo '<p>Price: '. $row['prod_price’]
</p>;
    
            echo '<button><ahref="order_form.php?product_id=" . $row['prod_id1] . ">Buy Now</a></button>';
            echo '</div>";
        }
    }
        // Close the database connection mysqli_close($conn); ?>
    
    </body>
    <script src="js/bootstrap.js"></script>
    </html>
    
    <?php
    // Connect to database include_once 'db_conn.php';
    
    
    // Retrieve product data from database $sql = "SELECT * FROM products"; $result = mysqli_query($conn, $sql);
    
    // Create order form echo '<form action="submit_order.php" method="post">; echo '<table>'; echo '<tr><th>Product</th><th>Quantity</th> <th>Price</th></tr>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row["prod_name"] . '</td>';
        echo '<td><input type="number" name="quantity[" $row["prod_id"]. ]" value="0"></td>';
        echo '<td>$' . $row["prod_price"] . '</td>'; 
        echo '</tr>';
    }
    
    echo '</table>';
    
    echo '<label for="name">Name:</label>'; 
    echo '<input type="text" name="name" required>';
    
    echo '<label for="address">Address:</label>'; 
    echo '<input type="text" name="address" required>';
    
    echo '<label for="email">Email:</label>'; 
    echo '<input type="email" name="email" required>';
    
    echo '<input type="submit" value="Submit Order">'; 
    echo '</form>';
    
    mysqli_close($conn); 
    ?>
    
    <?php
    // Connect to database include_once 'db_conn.php';
    
    // Retrieve form data $name = $_POST['name']; $address = $_POST['address']; $email = $_POST['email']; $products = $_POST['quantity'];
    
    // Calculate order total
    $total = 0;
    foreach ($products as $id => $quantity) {
        $sql = "SELECT prod_price FROM products WHERE prod_id = '$id";
        $result = mysqli_query($conn, $sql); $row = mysqli_fetch_assoc($result);
        $price = $row['prod_price']; $total += $price * $quantity;
    }
    
    // Insert order into database
    $status = 'P'; // set status as 'P' for pending 
    $timestamp = date("Y-m-d H:i:s"); // get current !timestamp
    $sql = "INSERT INTO orders (name, address,email, total, status, date_purchased_ts) VALUES ('$name', '$address', '$email', $total, '$status', '$timestamp')";
    mysqli_query($conn, $sql); $order_id = mysqli_insert_id($conn);
    
    // Insert order details into database foreach ($products as $id => $quantity) { if ($quantity> 0) {
        $sql = "INSERT INTO order_details (order_id, prod_id, quantity) VALUES ($order_id, $id, $quantity)";
        mysqli_query($conn, $sql);
        }
    }
    
    // Close the database connection $conn->close(); ?>
    
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Submit Order</title>
        <link rel="stylesheet" href="style.css">
    
    </head>
    <body>
        <h1>ORDER PLACED!</h1>
        <form action="order_list.php" method="post"> <input type="submit" value="View Order"> </form>
    
    </body>
    
    <script src="js/bootstrap.js"></script> 
    
    </html>
    <?php
    // Connect to database include_once 'db_conn.php';
    ?>
    
    <form>
    <?php
    // View the orders
    $sql = "SELECT o.name, o.address, o.email, o.total, o.status, o.date_purchased_ts, o.order_id,
            od.quantity,
            p.prod_name, p.prod_price
        FROM orders o
        JOIN order details od ON o.order_id = od.order_id
        JOIN products p ON od.prod_id = p.prod_id 
        WHERE o.order_id";
    
    $result = mysqli_query($conn, $sql);
    
    // check if any rows were returned
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) { 
            echo "Price: ". $row['prod_price'] . "<br>"; 
            echo "Name:". $row['name'] "<br>";
            echo "Product: ". $row['prod_name'] . "<br>"; 
            echo "Quantity:" . $row['quantity'] . "<br>";
            echo "Address: " . $row['address']."<br>"; 
            echo "Email: ". $row['email'] . "<br><br>";
                echo "Status: ". $row['status'] . "<br>"; 
            echo "Date Purchased: ".
    $row['date_purchased_ts'] . "<br>";
                echo "Total Price: ". $row['total'] . "<br>
    <br>"; 
        }
    } else {
        echo "No orders found.";
    
    } 
    ?>
    
    </form>