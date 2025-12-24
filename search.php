<?php 
    $connect = mysqli_connect("127.0.0.1", "root", "", "ajax_1", 3307); 
    $search = '';
    
    // checks if key search exists or not
    if (isset($_POST['search'])) { 
        $search = mysqli_real_escape_string($connect, $_POST['search']); 
    } 

    $query = " SELECT * FROM products WHERE Title LIKE '%$search%' ORDER BY id DESC "; $output = ''; 
    $result = mysqli_query($connect, $query); 

    $output = '';

    if (mysqli_num_rows($result) > 0) { // Checks how many rows have been sent by the result query
        while ($row = mysqli_fetch_array($result)) {  // converts the rows into an array
            $output .= ' <div class="product-card">
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
?>