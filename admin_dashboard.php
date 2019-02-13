<?php
include_once('functions.php');
if (!is_logged_in() || $_SESSION['userRole'] !== 'admin') {
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/login.php');
}
include_once('header.php');

if ($_POST['delete_order']) {
    $orderId = $_POST['delete_order'];
    include('php/db.php');
    $conn->query( "DELETE FROM `orders` WHERE `orders`.`id` = ".$orderId);
}

$idUser = $_GET['id'];
include('php/db.php');
$result = $conn->query("SELECT * FROM users WHERE `Id`=" . $idUser);
if ($result > 0) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $first_name = $row["First Name"];
            $last_name = $row["Last Name"];
            $user = $row["Email"];
        }
    }
}

if ($first_name && $last_name) {
    $the_name = $first_name . " " . $last_name;
} else {
    $the_name = $user;
}
?>
<div id="wrapper" class="body login-page">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo $the_name ?> Order Dashboard</h1>
                    <div class="table-responsive">
                        <table id="order-approving">
                            <tr>
                                <th>Order Date</th>
                                <th>Order #</th>
                                <th>Status</th>
                                <th>Value</th>
                                <th>View Order</th>
                                <th>Delete Order</th>
                            </tr>

                            <?php
                            $result = $conn->query("SELECT * FROM orders WHERE user_id =" . $idUser);
                            $new_result = $result;

                            if ($result > 0) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $date = $row['date'];
                                        $orderId = $row['id'];
                                        $orders = $row['order'];
                                        $status = $row['status'];
                                        $order = json_decode($orders);
                                        $summary = $order->summary;
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $date; ?>
                                            </td>
                                            <td>
                                                <?php echo $orderId; ?>
                                            </td>
                                            <td>
                                                <?php echo $status; ?>
                                            </td>
                                            <td>
                                                <?php echo $summary; ?>
                                            </td>
                                            <td>
                                                <button type="button" data-toggle="modal"
                                                        data-target="#order-modal-<?php echo $orderId; ?>"
                                                        class="custom_view_order">
                                                    View Order
                                                </button>
                                            </td>
                                            <td>
                                                <form method="post" action="">
                                                    <button type="submit" class="custom_delete_order"
                                                            name="delete_order" value="<?php echo $orderId; ?>">
                                                        Delete
                                                    </button>
                                                </form>
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

<?php
$new_result = $conn->query("SELECT * FROM orders WHERE user_id = " . $idUser . " ORDER BY id DESC");
if ($new_result > 0) {
    if ($new_result->num_rows > 0) {
        while ($row = $new_result->fetch_assoc()) {
            $id = $row['id'];
            $orders = $row['order'];
            $order = json_decode($orders);
            ?>
            <div id="order-modal-<?php echo $id; ?>" class="order-modal modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                        <div class="table-responsive">
                            <table class="modal-table">
                                <tr>
                                    <th>Site Grade</th>
                                    <th>Anchor Text</th>
                                    <th>Target URL</th>
                                    <th>Price</th>
                                </tr>
                                <?php foreach ($order as $value) { ?>
                                    <?php if (is_object($value)): ?>
                                        <tr>
                                            <td>
                                                <?php echo $value->name; ?>
                                            </td>
                                            <td>
                                                <?php echo $value->anchor; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $value->url; ?>"
                                                   target="_blank"><?php echo $value->url; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $value->price; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
} ?>

<?php include_once('footer.php') ?>

