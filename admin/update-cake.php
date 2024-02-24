<?php
    // Include the necessary files
    include('partials/menu.php');

    // Check if the id is set
    if(isset($_GET['id'])) {
        // Get the id
        $id = $_GET['id'];

        // SQL Query to get the selected cake
        $sql = "SELECT * FROM tbl_cake WHERE id = $id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check if data is available
        if(mysqli_num_rows($res) > 0) {
            // Fetch the cake details
            $row = mysqli_fetch_assoc($res);

            // Get the individual values of the selected cake
            $title = $row['title'];
            $description = $row['description'];
            $price_loaf = $row['price_loaf'];
            $price_half = $row['price_half'];
            $price_full = $row['price_full'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $best_seller = $row['best_seller'];
            $active = $row['active'];
        } else {
            // Redirect to Manage Cake if no data found
            header('location: manage-cake.php');
            exit();
        }
    } else {
        // Redirect to Manage Cake if id is not set
        header('location: admin/manage-cake.php');
        exit();
    }

    // Check if the update form is submitted
    if(isset($_POST['submit'])) {
        // Get the form data
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price_loaf = $_POST['price_loaf'];
        $price_half = $_POST['price_half'];
        $price_full = $_POST['price_full'];
        //$current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $best_seller = $_POST['best_seller'];
        $active = $_POST['active'];
        $file_name = null;
    

        // Upload the new image if selected
        if(isset($_FILES['image']['name'])) {
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];
            $file_destination = 'C:\\xampp\\htdocs\\mia-jasmine\\mia-jasmine\\images\\cake\\' . $file_name;
            move_uploaded_file($file_tmp, $file_destination);
        }

        // Update the cake in the database
        $sql = "UPDATE tbl_cake SET 
        title = '$title',
        description = '$description',
        price_loaf = $price_loaf,
        price_half = $price_half,
        price_full = $price_full,
        image_name = '$file_name',
        category_id = '$category',
        best_seller = CASE WHEN '$best_seller' = 'Best Seller' THEN 'Yes' ELSE 'No' END,
        active = '$active'
        WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        // Check if the query is successful
        if($res) {
            $_SESSION['update'] = "<div class='success'>Cake updated successfully.</div>";
            header('location: manage-cake.php');
            exit();
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to update Cake.</div>";
            header('location: manage-cake.php');
            exit();
        }
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Cake</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price (Loaf): </td>
                    <td><input type="number" name="price_loaf" value="<?php echo $price_loaf; ?>"></td>
                </tr>
                <tr>
                    <td>Price (Half): </td>
                    <td><input type="number" name="price_half" value="<?php echo $price_half; ?>"></td>
                </tr>
                <tr>
                    <td>Price (Full): </td>
                    <td><input type="number" name="price_full" value="<?php echo $price_full; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php if($current_image == "") { ?>
                            <div class='error'>Image not Available.</div>
                        <?php } else { ?>
                            <img src="../images/cake/<?php echo $current_image; ?>" width="150px">
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                // Query to get active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        $selected = ($current_category == $category_id) ? "selected" : "";
                                        echo "<option value='$category_id' $selected>$category_title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Best Seller: </td>
                    <td>
                        <select name="best_seller">
                            <option value="No" <?php if($best_seller == 'No') echo "selected"; ?>>No</option>
                            <option value="Best Seller" <?php if($best_seller == 'Yes') echo "selected"; ?>>Best Seller</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Cake" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>