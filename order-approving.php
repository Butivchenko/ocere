<?php
include_once('functions.php');
if (!is_logged_in()) {
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/sign_up.php');
}
$orders = json_decode($_COOKIE['order']);
$comment = $_COOKIE['comment'];

if (!$orders && !$_FILES) {
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/dashboard.php');

}

include_once('header.php');

?>
<div id="wrapper" class="body account-creation">
    <section>
        <div class="container">
            <h1>Confirm Order</h1>
            <br>
            <div class="row">

                <table id="order-approving">
                    <?php
                    if ($orders) {

                        ?>
                        <tr>
                            <th>Name</th>
                            <th>Anchor</th>
                            <th>Url</th>
                            <th>Price</th>
                        </tr>
                        <?php
                        foreach ($orders as $order => $value) {
                            if ($order != "summary") {

                                ?>

                                <tr>
                                    <td>
                                        <?php echo $value->name; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->anchor; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->url; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->price; ?>
                                    </td>
                                </tr>
                                <?php

                            }
                        }
                    }
                    ?>
                    <?php
                    if ($_FILES) {
                        $filename = $_FILES["fileToUpload"]["name"];
                        ?>
                        <tr>
                            <th>Uploaded file:</th>
                            <td><?php echo $filename; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <div class="row">
                    <div class="col-md-10 col-offset-1">
                        <h2>Comment</h2>
                        <p>
                            <?php
                            echo $comment;
                            ?>
                        </p>
                    </div>
                </div>
                <br>

                <i>
                    Please check your order above. You can make edits at any time by email/phone/Skype/livechat. Payment
                    is not required until links are made. We look forward to delivering for you and working together
                    over the long term
                </i>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <form action="php/accept.php">
                            <input type="submit" class="btn-trial" value="Confirm order">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php

$_SESSION["fileName"] = $_FILES["fileToUpload"]["name"];
$_SESSION["fileTmpName"] = $_FILES["fileToUpload"]["tmp_name"];

$our_file = file($_FILES["fileToUpload"]["tmp_name"]);

$fileNameWrite = time() . "_" . $_FILES["fileToUpload"]["name"];

$file = $_SERVER["DOCUMENT_ROOT"] . "/uploads/$fileNameWrite";

$pars = explode('.', $_SESSION["fileName"]);

$expansion = end($pars);

if ($expansion === "xls" || $expansion === "xlsx") {
    file_put_contents($file, $our_file);
}

$_SESSION["file"] = $file;



?>



<?php include_once('footer.php') ?>
