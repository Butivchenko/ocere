<?php

include_once('functions.php');
include_once('php/db.php');
// Show orders distinct user

if (!is_logged_in() || $_SESSION['userRole'] !== 'admin') {
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/login.php');
}

if ($_POST['orders']) {
    $userId = $_POST['orders'];
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/admin_dashboard.php?id=' . $userId);
    exit;
}


include_once('header.php');

// Change role admin/user
if ($_POST['user']) {
    $userId = $_POST['user'];
    $conn->query("UPDATE users SET `role` = 'admin'  WHERE `Id` ='" . $userId . "'");
} else {
    $userId = $_POST['admin'];
    $conn->query("UPDATE users SET `role` = 'user'  WHERE `Id` ='" . $userId . "'");
}


?>
    <div id="wrapper" class="body login-page">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Users : </h1>
                        <div class="table-responsive">
                            <table id="order-approving">
                                <tr>
                                    <th>Client ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Billing County</th>
                                    <th>Role</th>
                                    <th>Orders</th>
                                    <th>£TotalOrders</th>
                                </tr>

                                <?php

                                //                                вывод информации о всех клиентах и их заказах
                                $new_result = $conn->query("SELECT * FROM users ");

                                if ($new_result > 0) {
                                    if ($new_result->num_rows > 0) {
                                        while ($row = $new_result->fetch_assoc()) {
                                            $id = $row['Id'];
                                            $firstName = $row['First Name'];
                                            $lastName = $row['Last Name'];
                                            $email = $row['Email'];
                                            $billingCounty = $row['Billing County'];
                                            $role = $row['role'];

                                            ?>


                                            <tr>
                                                <td>
                                                    <?php echo $id; ?>
                                                </td>
                                                <td>
                                                    <?php echo $firstName; ?>
                                                </td>
                                                <td>
                                                    <?php echo $lastName; ?>
                                                </td>
                                                <td>
                                                    <?php echo $email; ?>
                                                </td>
                                                <td>
                                                    <?php echo $billingCounty; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // if role admin
                                                    if ($role == 'admin') {
                                                        ?>
                                                        <form method="post" action="">
                                                            <button type="submit" name="admin" class="order"
                                                                    value="<?php echo $id; ?>">
                                                                Make user
                                                            </button>
                                                        </form>
                                                        <?php
                                                        //if role user
                                                    } else {
                                                        ?>
                                                        <form method="post" action="">
                                                            <button type="submit" name="user" class="order"
                                                                    value="<?php echo $id; ?>">
                                                                Make admin
                                                            </button>
                                                        </form>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <form method="post" action="">
                                                        <button type="submit" name="orders" class="order"
                                                                value="<?php echo $id; ?>">
                                                            Orders
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Подсчет суммы всех заказов

                                                    $result = $conn->query("SELECT * FROM orders WHERE user_id =" . $id);
                                                    $sum_result = null;
                                                    if ($result > 0) {
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $orders = $row['order'];
                                                                $order = json_decode($orders);
                                                                $summary = $order->summary;

                                                                $sum_result += $summary;
                                                            }
                                                        }
                                                    } ?>

                                                    <?php echo $sum_result; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include_once('footer.php');