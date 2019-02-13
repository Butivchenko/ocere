<?php include('header.php') ?>
    <div id="wrapper" class="body login-page">
        <section>
            <div class="container">
                <form method="post" action="place_order.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1>PPC/Remarketing Packages</h1>

                            <input type="hidden" name="page" value="PPC/Remarketing Packages">

                            <div class="form-group">
                                <label for="sel1">Choose option:</label>
                                <select name="select" class="form-control" id="sel1">
                                    <option>PPC Package 1 - $395 / £295</option>
                                    <option>PPC Package 2 - $695 / £495</option>
                                    <option>PPC Package 3 - $1295 / £895</option>
                                    <option>PPC Package 4 - $1695 / £1295</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group custom_order_input">
                                <input name="website_url" type="text" placeholder="Website URL"
                                       class="form-control" required>
                            </div>

                            <div class="col-md-12 form-group custom_order_input">
                                        <textarea name="details" class="form-control custom_order_input"
                                                  placeholder="Further details (Goals, Keyword ideas, competitors, any other info)"
                                                  required></textarea>
                            </div>
                            <div class="col-md-12">
                                <p>Upload File Option</p>
                                <input type="file" multiple="multiple" class="upload_file" name="fileToUpload[]"
                                       accept=".doc,.docx,.xls,.xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                            <div class="col-md-12">
                                <button name="place_order" type="submit" class="place_order">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

<?php include('footer.php') ?>