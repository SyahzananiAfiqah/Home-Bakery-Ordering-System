<?php include('partials-front/menu.php'); ?>

<!-- Kek Lapis sEARCH Section Starts Here -->
<section class="cake-search text-center">
    <div class="container">
        <?php 

            //Get the Search Keyword
            // $search = $_POST['search'];
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        
        ?>

        <h2>Cakes <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- Kek LApis sEARCH Section Ends Here -->



<!-- Kek LApis MEnu Section Starts Here -->
<section class="cake-menu">
    <div class="container">
        <h2 class="text-center">Kek Lapis Menu</h2>

        <?php 

            //SQL Query to Get cakes based on search keyword
            //$search = kek lapis '; DROP database name;
            // "SELECT * FROM tbl_cake WHERE title LIKE '%keklapis'%' OR description LIKE '%keklapis%'";
            $sql = "SELECT * FROM tbl_cake WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $cake_id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    $price_loaf = $row['price_loaf'];
                    $price_half = $row['price_half'];
                    $price_full = $row['price_full'];
                    $best_seller = $row['best_seller']; // Get the best_seller value
                    
                    ?>
    
                    <div class="cake-menu-box">
                        <div class="cake-menu-img">
                            <?php 
                            if ($image_name == "") {
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
                                <?php if ($price_loaf && ($price_loaf != $price_half && $price_loaf != $price_full)): ?>
                                    <strong>Loaf Size: <span style="color: black;">RM<?php echo $price_loaf; ?></span></strong><br>
                                <?php endif; ?>
                                <?php if ($price_half && ($price_half != $price_loaf && $price_half != $price_full)): ?>
                                    <strong>Half Size: <span style="color: black;">RM<?php echo $price_half; ?></span></strong><br>
                                <?php endif; ?>
                                <?php if ($price_full && ($price_full != $price_loaf && $price_full != $price_half)): ?>
                                    <strong>Full Size: <span style="color: black;">RM<?php echo $price_full; ?></span></strong>
                                <?php endif; ?>
                            </p>
                            <br>
                            
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="cake_id[]" value="<?php echo $cake_id; ?>">
                                <input type="hidden" name="cake_title[]" value="<?php echo $title; ?>">
                                
                                <label for="size">Choose Size:</label>
                                <select name="cake_size[]">
                                    <?php if ($price_loaf): ?>
                                        <option value="loaf">Loaf Size (RM<?php echo $price_loaf; ?>)</option>
                                    <?php endif; ?>
                                    <?php if ($price_half): ?>
                                        <option value="half">Half Size (RM<?php echo $price_half; ?>)</option>
                                    <?php endif; ?>
                                    <?php if ($price_full): ?>
                                        <option value="full">Full Size (RM<?php echo $price_full; ?>)</option>
                                    <?php endif; ?>
                                </select>
    
                                <input type="number" name="cake_quantity[]" value="1" min="1">
                                <input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">
                            </form>
                        </div>
    
                        <?php if ($best_seller == 'Yes'): ?>
                            <span class="best-seller-label">Best Seller</span>
                        <?php endif; ?>
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