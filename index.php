<?php
//LOad environment variables from .env file
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables directly
$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];


//include the menu file which may have header, navigation, etc.
include('partials-front/menu.php'); 
?>

<!-- cake sEARCH Section Starts Here -->
<section class="cake-search text-center">
    <div class="container">
        
        <form action="cake-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Kek Lapis.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- cake sEARCH Section Ends Here -->

<?php 
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Kek Lapis</h2>

        <?php 
            //Create SQL Query to Display CAtegories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 4";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //CAtegories Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <a href="category-cakes.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                //Check whether Image is available or not
                                if($image_name=="")
                                {
                                    //Display MEssage
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="images/category/<?php echo $image_name; ?>" alt="Kek Lapis" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            }
            else
            {
                //Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->



<!-- Cake Menu Section Starts Here -->
<section class="cake-menu">
    <div class="container">
        <h2 class="text-center">Kek Lapis Menu</h2>

        <?php 
        // Display cakes that are Active
        $sql = "SELECT * FROM tbl_cake WHERE active='Yes'AND featured='Yes' LIMIT 6";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $cake_id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $price_loaf = $row['price_loaf'];
                $price_half = $row['price_half'];
                $price_full = $row['price_full'];
                ?>

                <div class="cake-menu-box">
                    <div class="cake-menu-img">
                        <?php 
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            ?>
                            <img src="./images/cake/<?php echo $image_name; ?>" alt="Kek Lapis" class="img-responsive img-curve">
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
                            <?php if ($price_full): ?>
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
                                <?php if ($price_full): ?>
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
<!-- Cake Menu Section Ends Here -->

    <p class="text-center">
        <a href="cakes.php">See All Kek Lapis</a>
    </p>
</section>
<!-- Cake Menu Section Ends Here -->


<?php include('partials-front/footer.php'); ?>