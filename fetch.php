<?php 
    $con = mysqli_connect("127.0.0.1","root","","ajax_1",3307); 

    if (isset($_POST['product_id'])) { 

        $id = $_POST['product_id']; 
        $query = "SELECT * FROM products WHERE id = '$id'"; 
        $result = mysqli_query($con, $query); 

        // mysqli_fetch_assoc($result) takes a row and converts to associative array
        // json_encode converts it into a json object
        echo json_encode(mysqli_fetch_assoc($result)); 

    } 
?> 
