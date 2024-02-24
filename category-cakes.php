<?php include('partials-front/menu.php');

// Check whether the category_id is passed or not
if(isset($_GET['category_id'])) {
    // Category id is set, so get the id
    $category_id = $_GET['category_id'];
    // Get the category title based on the category ID
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // Get the value from the database
    $row = mysqli_fetch_assoc($res);
    // Get the title
    $category_title = $row['title'];
} else {
    // Category not passed
    // Redirect to the home page
    header('location:'.SITEURL);
    exit(); // Add exit to stop further execution
}
?>

<!-- Kek Lapis SEARCH Section Starts Here -->
<section class="cake-search text-center">
    <div class="container">
        <h2>Kek Lapis on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
    </div>
</section>
<!-- Kek Lapis SEARCH Section Ends Here -->

<!-- Kek Lapis Menu Section Starts Here -->
<section class="cake-menu">
    <div class="container">
        <h2 class="text-center">Kek Lapis Menu</h2>

        <?php
        // Create SQL Query to get Kek Lapis based on selected category
        $sql2 = "SELECT * FROM tbl_cake WHERE category_id=$category_id";

        // Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        // Count the rows
        $count2 = mysqli_num_rows($res2);

        // Check whether Kek Lapis is available or not
        if($count2 > 0) {
            // Kek Lapis is available
            while($row2 = mysqli_fetch_assoc($res2)) {
                $cake_id = $row2['id'];
                $title = $row2['title'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                $price_loaf = $row2['price_loaf'];
                $price_half = $row2['price_half'];
                $price_full = $row2['price_full'];
        ?>

        <div class="cake-menu-box">
            <div class="cake-menu-img">
                <?php 
                if (empty($image_name)) {
                    echo "<div class='error'>Image not Available.</div>";
                } else {
                ?>
                <img src="images/cake/<?php echo $image_name; ?>" alt="Kek Lapis" class="img-responsive img-curve">
                <?php
                }
                ?>
            </div>

            <div class="cake-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="cake-detail">
                    <?php echo $description; ?><br>
                    <strong>Loaf Size: <span style="color: black;">RM<?php echo $price_loaf; ?></span></strong><br>
                    <strong>Half Size: <span style="color: black;">RM<?php echo $price_half; ?></span></strong><br>
                    <?php if (!empty($price_full)): ?>
                        <strong>Full Size: <span style="color: black;">RM<?php echo $price_full; ?></span></strong>
                    <?php endif; ?>
                </p>
                <br>
                
                <form action="cart.php" method="POST">
                    <input type="hidden" name="cake_id[]" value="<?php echo $cake_id; ?>">
                    <input type="hidden" name="cake_title[]" value="<?php echo $title; ?>">
                    
                    <label for="size">Choose Size:</label>
                    <select name="cake_size[]">
                        <option value="loaf">Loaf Size (RM<?php echo $price_loaf; ?>)</option>
                        <option value="half">Half Size (RM<?php echo $price_half; ?>)</option>
                        <?php if (!empty($price_full)): ?>
                            <option value="full">Full Size (RM<?php echo $price_full; ?>)</option>
                        <?php endif; ?>
                    </select>

                    <input type="number" name="cake_quantity[]" value="1" min="1">
                    <input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">
                </form>
            </div>
        </div>

        <?php
            }
        } else {
            echo "<div class='error'>Kek Lapis not found.</div>";
        }
        ?>
        
        <div class="clearfix"></div>
    </div>
</section>
<!-- Cake Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>