<?php include 'inc/header.php'; ?>
			<section class="main-content">
				<div class="row">
					<div class="span12">													
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Trending <strong>Posts</strong></span></span></span>
									
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">
											<?php 
												$getTpd = $pd->getTrendingProduct();

												if ($getTpd) {
													while ($result = $getTpd->fetch_assoc()) {
													$id = $result['product_id'];
											?>
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?id=<?php echo $id;?>"><img src="<?php echo $result['image'];?>" alt="" /></a></p>
														<a href="product_detail.php?id=<?php echo $id;?>" class="title"><?php echo $result['product_name'];?></a><br/>
														<a href="products.html" class="category"><?php echo $result['cat_name'];?></a>
														<p class="price">$<?php echo $result['product_price'];?></p>
													</div>
												</li>
											<?php } }?>
											</ul>
										</div>
									</div>							
								</div>
							</div>						
						</div>
						<br/>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Latest <strong>Posts</strong></span></span></span>
									
								</h4>
								<div id="myCarousel-2" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">
											<?php 
												$getNewpd = $pd->getNewProduct();

												if ($getNewpd) {
													while ($result = $getNewpd->fetch_assoc()) {
													$id = $result['product_id'];
											?>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.php?id=<?php echo $id;?>"><img src="<?php echo $result['image'];?>" alt="" /></a></p>
														<a href="product_detail.php?id=<?php echo $id;?>" class="title"><?php echo $result['product_name'];?></a><br/>
														<?php echo $result['cat_name'];?>
														<p class="price">$<?php echo $result['product_price'];?></p>
													</div>
												</li>
											<?php } }?>
											</ul>
										</div>
									</div>							
								</div>
							</div>						
						</div>
					</div>				
				</div>
			</section>
<?php include 'inc/footer.php'; ?>