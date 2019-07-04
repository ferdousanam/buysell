<?php include 'inc/header.php'; ?>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>All Products</span></h4>
			</section>
			<section class="main-content">
				<div class="row">						
					<div class="span12">								
						<ul class="thumbnails listing-products">
							<?php 
								$allpd = $pd->getAllProduct();

								if ($allpd) {
									while ($result = $allpd->fetch_assoc()) {
									$id = $result['product_id'];
							?>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="product_detail.php?id=<?php echo $id;?>"><img src="<?php echo $result['image'];?>" alt="" /></a></p>
									<a href="product_detail.php?id=<?php echo $id;?>" class="title"><?php echo $result['product_name'];?></a><br/>
									<?php echo $result['cat_name'];?>
									<p class="price">$<?php echo $result['product_price'];?></p>
								</div>
							</li>
							<?php } }?>
						</ul>
					</div>
				</div>
			</section>
<?php include 'inc/footer.php'; ?>