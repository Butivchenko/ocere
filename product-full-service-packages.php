<?php include('header.php') ?>

    <div id="wrapper" class="body login-page">
        <section>
            <div class="container">
                <form method="post" action="place_order.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1>Full Service Packages</h1>

                            <input type="hidden" name="page" value="Full Service Packages">

                            <div class="form-group">
                                <label for="sel1">Choose option:</label>
                                <select name="select" class="form-control" id="sel1">
                                    <option>Full Service Package 1 - $1295 / £895</option>
                                    <option>Full Service Package 2 - $1995 / £1495</option>
                                    <option>Full Service Package 3 - $3495 / £2595</option>
                                    <option>Full Service Package 4 - $4995 / £3795</option>
                                    <option>Full Service Package 5 - $7495 / £5795</option>
                                    <option>Full Service Package 6 - $9995 / £7795</option>
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