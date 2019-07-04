<?php include 'inc/header.php';
include_once 'lib/Session.php';
Session::checkSession();
spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
});
$order = new Orders();
if (isset($_GET['productSold'])) {
    $id = $_GET['productSold'];
    $productSold = $order->orderSoldById($id);
}
?>
<section class="main-content">
	<div class="row">
            <!-- Product List -->
            <section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>Ordered Product List</span></h4>
			</section>
            <div class="span3 col">
                <?php include 'inc/userSidebar.php'; ?>
            </div>
            <div class="span9">
                <table class="table table-striped table-hover" id="tablelist">
                    <thead>
                    <tr class="active">
                        <th>Product Name</th>
                        <th>Product image</th>
                        <th>Product Price</th>
                        <th>Buyer Name</th>
                        <th>Buyer Phone</th>
                        <th>Buyer email</th>
                        <th>Product Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                    <?php 
                        if (isset($productSold)) {
                            echo $productSold;
                        }
                    ?>
                    <?php $fm = new Format();
                        $getProduct = $order->getOrdersByUser();
                        if ($getProduct) {
                        $i = 0;
                        while ($result = $getProduct->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $result['product_name']; ?></td>
                        <td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
                        <td><?php echo $result['product_price']; ?></td>
                        <td><?php echo $result['first_name']." ".$result['last_name']; ?></td>
                        <td><?php echo $result['phone']; ?></td>
                        <td><?php echo $result['user_email']; ?></td>
                        <td>
                        <a class="btn btn-success" onclick="return confirm('Are you sure to mark the product as Sold!')" href="?productSold=<?php echo $result['product_id']; ?>">Mark As Sold</a>
                        </td>
                    </tr>
                    <?php } } ?>
                    </tbody>
                    </table>
        </div>
    </div>
</section>
<?php include 'inc/javascripts.php'; ?>
<?php include 'inc/footer.php'; ?>