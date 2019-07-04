<?php
    include 'inc/header.php';
    include_once 'lib/Session.php';
    Session::checkSession();
    
 ?>
<section class="main-content">
	<div class="row">
            <!-- Product List -->
            <section class="header_text sub">
				<h4><span>My Product List</span></h4>
			</section>
            <div class="span3 col">
                <?php include 'inc/userSidebar.php'; ?>
            </div>
            <?php 
                if (isset($productDelete)) {
                    echo $productDelete;
                }
                ?>
            <div class="span9">
                <table class="table table-striped table-hover" id="tablelist">
                    <thead>
                    <tr class="active">
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Product Description</th>
                        <th>Product Price</th>
                        <th>Product image</th>
                        <th>Product Status</th>
                    </tr>
                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody>
                    <?php $fm = new Format();
                        $getProduct = $pd->getProductByUser();
                        if ($getProduct) {
                        $i = 0;
                        while ($result = $getProduct->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $result['product_name']; ?></td>
                        <td><?php echo $result['cat_name']; ?></td>
                        <td><?php echo $fm->textShorten($result['product_desc'], 50); ?></td>
                        <td><?php echo $result['product_price']; ?></td>
                        <td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
                        <td><?php
                            if ($result['status'] == 0) {
                                echo "Available";
                            }else {
                                echo "Sold";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                        }
                    ?>
                    </tbody>
                    </table>
        </div>
    </div>
</section>
<?php include 'inc/javascripts.php'; ?>
<?php include 'inc/footer.php'; ?>