<?php
$con = mysqli_connect("127.0.0.1", "root", "", "ajax_1", 3307);

if (isset($_POST['product_id'])) {

    $product_id = $_POST['product_id'];

    $deleteQuery = "DELETE FROM products WHERE id = $product_id";
    mysqli_query($con, $deleteQuery);

    $output = "";
    $selectQuery = "SELECT * FROM products ORDER BY id DESC";
    $result = mysqli_query($con, $selectQuery);

    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
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

    echo $output;
}
?>
