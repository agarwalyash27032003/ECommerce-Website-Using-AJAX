<?php
    $con = mysqli_connect("127.0.0.1", "root", "", "ajax_1", 3307);

    if (!$con) {
        die("Connection failed");
    }

    $value = $_POST['value'] ?? 'Default';

    // Decide ORDER BY based on dropdown value
    if ($value == "High to Low") {
        $query = "SELECT * FROM products ORDER BY Price DESC";
    }
    else if ($value == "Low to High") {
        $query = "SELECT * FROM products ORDER BY Price ASC";
    }
    else if ($value == "Date Created") {
        $query = "SELECT * FROM products ORDER BY created_at DESC";
    }
    else {
        $query = "SELECT * FROM products ORDER BY id";
    }

    $result = mysqli_query($con, $query);

    // Return product cards
    // mysqli_fetch_assoc($result) takes a row and converts to associative array
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="product-card">
            <img src="'.$row["image_url"].'">
            <h3>'.$row["Title"].'</h3>
            <p class="description">'.$row["Description"].'</p>
            <p class="price">'.$row["Price"].'</p>
            <div class="product-buttons">
                <input type="button" name="view" value="Edit" id='.$row["id"].' class="btn btn-info btn-xs edit_data" />
                <input type="button" name="view" value="Delete" id='.$row["id"].' class="btn btn-info btn-xs delete_data" />
            </div>
        </div>';
    }
?>
