<?php include 'inc/header.php'; ?>
<?php
    $product = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $insertProduct  = $product->prductInsert($_POST, $_FILES);
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
    }
 ?>

<section class="main-content">
	<div class="row">
        <section class="header_text sub">
            <h4><span>Product Add</span></h4>
        </section>
        <div class="span3 col">
            <?php include 'inc/userSidebar.php'; ?>
        </div>
        <div class="span9">
            <?php 
                if (isset($productDelete)) {
                    echo $productDelete;
                }
                if (isset($insertProduct)) {
                    echo $insertProduct;
                }
            ?>
            <style>
                .form-size input {
                    width: 98.5%;
                }
                .form-size select {
                    width: 100%;
                }
                .form-size .submit {
                    width: 10%;
                }
                .form-size .form-group {
                    width: 100%;
                }
            </style>
            <div class="form-size">
            <form class="form-horizontal" action="productadd.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name..." value="">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select id="select" name="cat_id" class="form-control">
                        <option>Select Category</option>
                        <?php
                            $getCat = $cat->getAllCat();
                                if ($getCat) {
                                $i=0;
                                while ($result = $getCat->fetch_assoc()) {
                                    $i++;
                        ?>
                        <option value="<?php echo $result['cat_id']; ?>"><?php echo $result['cat_name']; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="body" class="form-control tinymce" placeholder="Add Product Description Here..."></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter Price...">
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="image" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Product Type</label>
                    <select id="select" name="type" class="form-control">
                        <option>Select Type</option>
                        <option value="0">Trending</option>
                        <option value="1">None</option>
                    </select>
                </div>
                <input type="submit" class="submit btn btn-default" value="Save">
            </form>
            </div>
        </div><!-- span end -->
    </div>
</section>
<?php include 'inc/javascripts.php'; ?>
<?php include 'inc/footer.php'; ?>