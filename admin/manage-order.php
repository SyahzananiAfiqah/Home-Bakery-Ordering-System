<!DOCTYPE html>
<html>
<head>
    <title>Manage Order</title>
</head>
<body>
    <?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>

            <?php
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>

            <div class="table-container">
                <table class="tbl-full">
                    <tr>
                        <th>Name</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    // Place your database connection code here

                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $order_id = $row['id'];
                            $customer_name = $row['customer_name'];
                            $status = $row['status'];

                            $cartSql = "SELECT * FROM tbl_order_items WHERE order_id = $order_id";
                            $cartRes = mysqli_query($conn, $cartSql);

                            $items = array();

                            while($cartRow = mysqli_fetch_assoc($cartRes)) {
                                $cake_id = $cartRow['cake_id'];
                                $size = $cartRow['size'];
                                $quantity = $cartRow['quantity'];

                                $sql_cake = "SELECT * FROM tbl_cake WHERE id = $cake_id";
                                $res_cake = mysqli_query($conn, $sql_cake);

                                if ($res_cake && mysqli_num_rows($res_cake) > 0) {
                                    $row_cake = mysqli_fetch_assoc($res_cake);
                                    $cake_title = $row_cake['title'];
                                    $cake_price = $row_cake['price_' . $size];

                                    $item = array(
                                        'cake_title' => $cake_title,
                                        'cake_size' => $size,
                                        'cake_quantity' => $quantity,
                                        'cake_price' => $cake_price
                                    );

                                    $items[] = $item;
                                }
                            }
                            ?>

                            <tr>
                                <td>
                                    <a href="customer-details.php?id=<?php echo $order_id; ?>"><?php echo $customer_name; ?></a>
                                </td>
                                <td>
                                    <a href="order-items.php?id=<?php echo $order_id; ?>">Show Items</a>
                                </td>
                                <td id="status_<?php echo $order_id; ?>">
                                    <?php
                                    $statusClass = strtolower(str_replace(" ", "-", $status));
                                    echo "<label class='status-label $statusClass'>$status</label>";
                                    ?>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <button class="status-button ordered" onclick="updateStatus(<?php echo $order_id; ?>, 'Ordered')">Ordered</button>
                                        <button class="status-button in-prepared" onclick="updateStatus(<?php echo $order_id; ?>, 'In Prepared')">In Prepared</button>
                                        <button class="status-button on-delivery" onclick="updateStatus(<?php echo $order_id; ?>, 'On Delivery')">On Delivery</button>
                                        <button class="status-button delivered" onclick="updateStatus(<?php echo $order_id; ?>, 'Delivered')">Delivered</button>
                                        <button class="status-button cancelled" onclick="updateStatus(<?php echo $order_id; ?>, 'Cancelled')">Cancelled</button>
                                        <a href="delete-order.php?id=<?php echo $order_id; ?>" class="btn-danger">Delete Order</a>
                                    </div>
                                </td>

                            </tr>

                            <?php
                            $sn++;
                        }
                    }
                    else {
                        echo "<tr><td colspan='4' class='error'>Orders not Available</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script>
    function updateStatus(orderId, status) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update-order-status.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var statusLabel = document.getElementById("status_" + orderId);
                statusLabel.innerHTML = "<label class='status-label " + status.toLowerCase().replace(/ /g, "-") + "'>" + status + "</label>";

                // Store the updated status in the browser's local storage
                localStorage.setItem("orderStatus_" + orderId, status);
            }
        };
        xhr.send("id=" + orderId + "&status=" + status);
    }

    // Function to retrieve and set the previously updated status from local storage
    function retrieveAndUpdateStatus(orderId) {
        var statusLabel = document.getElementById("status_" + orderId);
        var storedStatus = localStorage.getItem("orderStatus_" + orderId);
        if (storedStatus) {
            statusLabel.innerHTML = "<label class='status-label " + storedStatus.toLowerCase().replace(/ /g, "-") + "'>" + storedStatus + "</label>";
        }
    }

    // Call retrieveAndUpdateStatus for each order on page load
    window.onload = function() {
        var orders = document.querySelectorAll('[id^="status_"]');
        orders.forEach(function(order) {
            var orderId = order.id.split("_")[1];
            retrieveAndUpdateStatus(orderId);
        });
    };
</script>

    <?php include('partials/footer.php'); ?>
</body>
</html>

<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        .table-container {
            overflow-x: auto;
        }
        .tbl-full {
            width: 100%;
            white-space: nowrap;
        }
        .status-button {
            background-color: green;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        .status-button:hover {
            background-color: darkgreen;
        }
        .status-label {
            font-weight: bold;
            padding: 6px 10px;
            border-radius: 4px;
        }
        .ordered {
            background-color: green;
            color: white;
        }
        .in-prepared {
            background-color: blue;
            color: white;
        }
        .on-delivery {
            background-color: orange;
            color: white;
        }
        .delivered {
            background-color: green;
            color: white;
        }
        .cancelled {
            background-color: red;
            color: white;
        }
        .btn-danger {
            background-color: red;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .main-content {
        padding: 20px;
        }

        .table-container {
        margin-top: 20px;
        }
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 5px;
        }
        .action-buttons > * {
            margin-bottom: 5px;
        }
        .btn-danger {
            margin-left: auto;
        }
        @media (max-width: 768px) {
            th, td {
                padding: 8px;
            }
            .status-button {
                padding: 6px 12px;
                display: block;
                margin-bottom: 5px;
            }
        }
        @media (max-width: 480px) {
            th, td {
                padding: 6px;
            }
            .status-button {
                padding: 4px 8px;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>