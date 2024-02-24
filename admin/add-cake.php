<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Cake</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Cake">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Cake."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Loaf Price: </td>
                    <td>
                        <input type="number" name="price_loaf">
                    </td>
                </tr>

                <tr>
                    <td>Half Price: </td>
                    <td>
                        <input type="number" name="price_half">
                    </td>
                </tr>

                <tr>
                    <td>Full Price: </td>
                    <td>
                        <input type="number" name="price_full">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // Create PHP Code to display categories from the Database
                                // 1. Create SQL to get all active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // Execute the query
                                $res = mysqli_query($conn, $sql);
                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero, we have categories; else, we don't have categories
                                if ($count > 0) {
                                    // We have categories
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        // Get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                } else {
                                    // We don't have any category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Cake" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            // Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                // Add the Cake to the Database
                // 1. Get the Data from the Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price_loaf = $_POST['price_loaf'];
                $price_half = $_POST['price_half'];
                $price_full = $_POST['price_full'];
                $category = $_POST['category'];

                // Check whether the radio buttons for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // Setting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; // Setting the Default Value
                }

                // 2. Upload the Image if selected
                // Check whether the selected image is clicked or not and upload the image only if an image is selected
                if(isset($_FILES['image']['name']))
                {
                    // Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // Check whether the Image is selected or not and upload the image only if selected
                    if($image_name!="")
                    {
                        // Image is selected
                        // A. Rename the Image
                        // Get the extension of the selected image (jpg, png, gif, etc.)
                        $ext = explode('.', $image_name);
                        $ext = end($ext);


                        // Create a new name for the image
                        $image_name = "Cake-Name-".rand(0000,9999).".".$ext; // New Image Name, e.g., "Cake-Name-657.jpg"

                        // B. Upload the Image
                        // Get the source path and destination path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        // Destination Path for the image to be uploaded
                        $dst = "../images/cake/".$image_name;

                        // Finally, upload the cake image
                        $upload = move_uploaded_file($src, $dst);

                        // Check whether the image is uploaded or not
                        if($upload==false)
                        {
                            // Failed to upload the image
                            // Redirect to Add Cake page with an error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>";
                            header('location: add-cake.php');
                            // Stop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; // Setting the Default Value as blank
                }

                // 3. Insert Into Database

                // Create an SQL Query to save or add the cake
                // For numerical values, we do not need to pass the value inside quotes '', but for string values, it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_cake SET 
                    title = '$title',
                    description = '$description',
                    price_loaf = $price_loaf,
                    price_half = $price_half,
                    price_full = $price_full,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

               

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the data is inserted or not
                // 4. Redirect with Message to Manage Cake page
                if($res2 == true)
                {
                    // Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Cake added successfully.</div>";
                    header('location: manage-cake.php');
                }
                else
                {
                    // Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to add the cake.</div>";
                    header('location: manage-cake.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
