<?php 
    $server = "127.0.0.1";
    $databse = "ajax_1";
    $username = "root";
    $password = "";
    $port = 3307;
    $con = mysqli_connect($server, $username, $password, $databse, $port);

    if (!$con) {
        die("connection to this database failed due to" . mysqli_connect_error());
    }

    $query = "SELECT * FROM products ORDER BY id";
    $result = mysqli_query($con, $query); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Myntra</title>
</head>

<body>
    <div class="header">
        <h1>Myntra</h1>
    </div>
    <div class="add-product"> 
        <a href="insert.php" class="add-btn">Add New Product!</a> 
    </div>
    <div class="search-product"> 
        <input type="text" id="search" placeholder="Search"> 
    </div>
    <div id="product-display">
        <div id="product-display-grid">
            <div id="product-display-header">
                <h3>All Products are displayed!</h3> 
                <select id="filterSelect" class="filter_data">
                    <option value="Default">Default</option>
                    <option value="High to Low">High to Low</option>
                    <option value="Low to High">Low to High</option>
                    <option value="Date Created">Date Created</option>
                </select>
            </div>
            <div id="product-grid"> <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <!-- All the data from table is fetched in the form of an array -->
                    <div class="product-card">
                        <img src="<?php echo $row["image_url"]; ?>" alt="">
                        <h3><?php echo $row["Title"]; ?></h3>
                        <p class="description"><?php echo $row["Description"]; ?></p>
                        <p class="price"><?php echo $row["Price"]; ?></p> 
                        <div class="product-buttons">
                            <input type="button" name="view" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" />
                            <input type="button" name="view" value="Delete" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs delete_data" />
                        </div>
                    </div> <?php } ?>
            </div>
        </div>
    </div>
    <div id="addProductForm" style="display:none;">
        <h3>Add New Product</h3>
        <form id="productForm"> 
            <input type="hidden" id="product_id" name="product_id"> 
            <input type="text" id="title" name="title" placeholder="Title"> 
            <textarea id="description" name="description" placeholder="Description" rows="10"></textarea> 
            <input type="number" id="price" name="price" placeholder="Price">
            <input type="text" id="image_url" name="image_url" placeholder="Image URL"> 
            <button type="submit">Save Product</button> </form>
        <div id="formMessage"></div>
    </div>
</body>
<script>
$(document).ready(function () {
    let currentSort = "Default";

    // Add New Product button
    $('.add-btn').click(function (e) {
        e.preventDefault();

        $('#product_id').val(''); // This is a new product

        $('#addProductForm').toggle();
        $('#product-display').toggle();
        $('.search-product').toggle();

        $(this).text( $(this).text() === "Add New Product!" ? "Back to Products" : "Add New Product!" );
    });

    // Insert Product
    $('#productForm').on("submit", function (e) {
        e.preventDefault();

        if ($('#title').val() === '') {
            alert("Title is required");
        }
        if ($('#price').val() === '') {
            alert("Price is required");
        }
        if ($('#description').val() === '') {
            alert("Description is required");
        }

        $.ajax({
            url: "insert.php",
            method: "POST",
            data: $('#productForm').serialize(),
            success: function (data) {

                $('#productForm')[0].reset();
                $('#product_id').val('');
                $('#product-grid').html(data);

                if (currentSort !== "Default") {
                    $('#filterSelect').val(currentSort).trigger('change');
                }

                $('#addProductForm').hide(); 
                $('#product-display').show();
                $('.search-product').show();

                $('.add-btn').text("Add New Product!");

            }

            // URL is where the request should go
            // Data converts into key value pair 
        });
    });

    // Filter Products
    $(document).on("change", '.filter_data', function () {
        currentSort = $(this).val();

        $.ajax({
            url: "select.php",
            method: "POST",
            data: { value: currentSort },
            success: function (data) {
                $('#product-grid').html(data);
            }
        });

    });

    // Search products
    $("#search").on("keyup", function () {
        let searchText = $(this).val();

        $.ajax({
            url: "search.php",
            method: "POST",
            data: { search: searchText },
            success: function (data) {
                $("#product-grid").html(data);
            }
        });
    });

    // Editing Products
    $(document).on('click', '.edit_data', function () {

        var product_id = $(this).attr("id");

        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { product_id: product_id },
            dataType: "json",
            success: function (data) {

                $('#product_id').val(data.id);
                $('#title').val(data.Title);
                $('#description').val(data.Description);
                $('#price').val(data.Price);
                $('#image_url').val(data.image_url);

                $('#addProductForm').show();
                $('#product-display').hide();
                $('.search-product').hide();

                $('.add-btn').text("Back to Products");
            }
        });
    });

    //Delete
    $(document).on('click', '.delete_data', function(){
        var product_id = $(this).attr("id");
        $.ajax({
            url: "delete.php",
            method: "POST",
            data: {product_id: product_id},
            success: function(data){
                $("#product-grid").html(data);
                if (currentSort !== "Default") {
                    $('#filterSelect').val(currentSort).trigger('change');
                }
            }
        });
    });

});
</script>


</html>