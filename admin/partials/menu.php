<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>

<html>
    <head>
        <title>Mia Jasmine Order Website - Home Page</title>

        <link rel="stylesheet" href="../css/latestadmin.css">
        <style>
            /* CSS for Menu */
            .menu {
                background-color: black;
            }

            .menu ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }

            .menu ul li {
                display: inline;
                padding: 1%;
            }

            .menu ul li a {
                text-decoration: none;
                font-weight: bold;
                color: white;
            }

            .menu ul li a:hover {
                color: #ff4757;
            }
        </style>
    </head>

    <body>
        <!-- Menu Section Starts -->
        <div class="menu">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-cake.php">Kek Lapis</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>   
        </div>
        <!-- Menu Section Ends -->

        <!-- Rest of your HTML content goes here -->

    </body>
</html>
