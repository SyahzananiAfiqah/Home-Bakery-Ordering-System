<?php
    //include constants file
    include('../config/constants.php');

    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //Image is available. so remove it
            $path = "../images/category/".$image_name;
            //Remove the image
            if(file_exists( $path)){
                unlink($path);
            }
            // var_dump($remove);
            // die();

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                // //set the session message
                // $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                // //redirect to manage category page
                // header('location: manage-category.php');
                // //stop the proccess
                // die();
            }
        }

        //Delete Data from database
        //SQL query to delete data from database

        $sql = "UPDATE tbl_cake SET category_id=null WHERE category_id=$id";
        $res = mysqli_query($conn, $sql);

        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.<div>";
            //redirect to manage category
            header('location: manage-category.php');
        }
        else
        {
            //Set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to elete category.</div>";
            //redirect to manage category
            header('location: manage-category.php');
        }


    }
    else
    {
        //redirect to manage category page
        header('location: manage-category.php');
    }
?>