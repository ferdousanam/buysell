<?php include 'inc/header.php'; ?>
<?php
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		echo "<script>window.location = 'index.php'; </script>";
	}else {
		$id = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['id']);
	}
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
    	$order = new Orders();
		$orderProduct = $order->orderProduct($id);
		echo "<script>window.location = 'product_detail.php?id=$id'; </script>";
    }else {
		
	}
 ?>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">						
					<div class="span9">
						<div class="row">
						<?php
							$getPd = $pd->getSingleProduct($id);

							if ($getPd) {
								while ($result= $getPd->fetch_assoc()) {
									$get_cat_id    = $result['cat_id'];
									$image         = $result['image'];
									$get_pro_price = $result['product_price'];
						?>
							<div class="span4">
								<a href="$<?=$image;?>" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="<?=$image;?>"></a>
							</div>
							<div class="span5">
								<address>
									<strong>Product Title:</strong> <span><?php echo $result['product_name'];?></span><br>
								</address>									
								<h4><strong>Price: $<?=$get_pro_price;?></strong></h4>
							</div>
							<div class="span5">
								<form method="POST" class="form-inline" action="">
									<input name="order" class="btn btn-inverse" type="submit" value="Order This Product"/>
								</form>
							</div>							
						</div>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Description</a></li>
									<li class=""><a href="#profile">Additional Information</a></li>
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" id="home">
									<?=$result['product_desc'];?>
									</div>
								</div>							
							</div>
							<?php } }?>
						</div>
					</div>
				</div>
			</section>

<?php include 'inc/footer.php'; ?>
		<script src="themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});
				
				$('#myCarousel-2').carousel({
                    interval: 2500
                });								
			});
		</script>