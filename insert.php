<?php 
$con = mysqli_connect("127.0.0.1", "root", "", "ajax_1", 3307); 
if (!empty($_POST)) { 
    $output = ''; 
    $title = $_POST['title']; 
    $description = $_POST['description']; 
    $price = $_POST['price']; 
    $image_url = $_POST['image_url']; 
    
    if (isset($_POST["product_id"]) && $_POST["product_id"] != '') { 
        $query = "UPDATE products SET Title='$title', Description='$description', Price='$price', image_url = '$image_url' WHERE id='".$_POST["product_id"]."'"; 
    } 
    else { 
        $query = "INSERT INTO products (Title, Description, Price, image_url) VALUES ('$title', '$description', '$price', '$image_url')";
    } 
    
    if(mysqli_query($con, $query)){ // The query is sent to SQL, and if it runs correcrtly then go inside 

        $select_query = "SELECT * FROM products ORDER BY id"; 
        $result = mysqli_query($con, $select_query); 

        while ($row = mysqli_fetch_array($result)) { 

            // All the data from database is converted into an array 
            $output .= '<div class="product-card">
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
    } 
    echo $output; 
} 
?>