<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Kek Lapis</h1>

        <br /><br />

        <!-- Button to Add Cake -->
        <a href="add-cake.php" class="btn-primary">Add Cake</a>

        <br /><br /><br />

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['unauthorize'])) {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Loaf Price</th>
                <th>Half Price</th>
                <th>Full Price</th>
                <th>Image</th>
                <th>Best Seller</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                // Create an SQL Query to Get all the Cakes
                $sql = "SELECT * FROM tbl_cake";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Count Rows to check whether we have Cakes or not
                $count = mysqli_num_rows($res);

                // Create a Serial Number Variable and set the default value as 1
                $sn = 1;

                if ($count > 0) {
                    // We have Cakes in the database
                    // Get the Cakes from the database and display
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Get the values from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price_loaf = $row['price_loaf'];
                        $price_half = $row['price_half'];
                        $price_full = $row['price_full'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $best_seller = $row['best_seller'];
                        $active = $row['active'];
            ?>

            <tr>
                <td><?php echo $sn++; ?>. </td>
                <td><?php echo $title; ?></td>
                <td>RM<?php echo $price_loaf; ?></td>
                <td>RM<?php echo $price_half; ?></td>
                <td>RM<?php echo $price_full; ?></td>
                <td>
                    <?php
                        // Check whether we have an image or not
                        if ($image_name == "") {
                            // We do not have an image, display error message
                            echo "<div class='error'>Image not added.</div>";
                        } else {
                            // We have an image, display the image
                    ?>
                    <img src="../images/cake/<?php echo $image_name; ?>" width="100px">
                    <?php
                        }
                    ?>
                </td>
                <td><?php echo ($best_seller == 'Yes') ? 'Best Seller' : 'No'; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="update-cake.php?id=<?php echo $id; ?>" class="btn-secondary">Update Kek Lapis</a>
                    <a href="delete-cake.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Kek Lapis</a>
                </td>
            </tr>

            <?php
                    }
                } else {
                    // No Cakes added in the database
                    echo "<tr> <td colspan='9' class='error'>No Cakes added yet.</td> </tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>