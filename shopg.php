<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img class="d-block w-100" style="width:100%; height:56%;" src="images/banner.png" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img class="d-block w-100" style="width:100%; height:56%;" src="images/banner1.png" alt="Second slide">
		                  </div><div class="item">
		                    <img class="d-block w-100" style="width:100%; height:56%;" src="images/banner.png" alt="Third slide">
		                  </div><div class="item">
		                    <img class="d-block w-100" style="width:100%; height:56%;" src="images/banner3.png" alt="Fourth slide">
		                  </div>
		                  <div class="item">
		                    <img class="d-block w-100" style="width:100%; height:56%;" src="images/banner.png" alt="Fifth slide">
		                  </div>
						  <div class="item">
		                    <img class="d-block w-100" style="width:100%; height:56%;" src="images/banner5.png" alt="Sixth slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
					<!--
					<div class="row">
						<div class="col-xs-12" style="padding-top:10px;">
							<div class="box">
								<div class="box-header with-border">
									<h3><b>All Listed Products</b></h3>
								</div>
								<div class="box-body">
									<table id="example1" class="table table-bordered table-hover" style="padding:2px;">
										<thead>
											<th>Name</th>
											<th>Photo</th>
											<th>Price</th>
											<th>Action</th>
										</thead>
										<tbody>
											<?php
												$conn = $pdo->open();

												try{
												$stmt = $conn->prepare("SELECT * FROM products $where");
												$stmt->execute();
												foreach($stmt as $row){
													$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
													echo "
														<tr>
															<td>".$row['name']."</td>
															<td>
																<img src='".$image."' height='50px' width='45px'>
															</td>
															<td>Ksh. ".number_format($row['price'], 2)."</td>
															<td>
																<a class='btn btn-success btn-sm btn-flat' href='product.php?product=".$row['slug']."'><i class='fa fa-search'></i> View</a>
															</td>
														</tr>
													";
												}
												}
												catch(PDOException $e){
												echo $e->getMessage();
												}

												$pdo->close();
											?>
										</tbody>
									</table> 
								</div>
							</div>
						</div>
					</div>
					-->
					<div class="box box-success"></div>
					<div class="box text-center" style="background-color:transparent; border:black;">
						<h2><b style="color:mediumseagreen">This Month's Top Selling items.</b></h2>
					</div>
					<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-success'>
		       								<div class='box-body prod-body text-center'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><b><u><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></b></u></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>Ksh. ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?>
					<div class="box box-success"></div>
					<div class="box box-warning box-black text-center" style="background-color:transparent; border:black;">
					<h2><b style="color:green">All Listed Products.</b></h2>
					</div>

					<div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img style="width:100%; height:56%;" src="images/banner.png" alt="First slide">
		                  </div>
						  <?php
							$month = date('m');
							$conn = $pdo->open();

							try{
								$inc = 3;	
								$stmt = $conn->prepare("SELECT * FROM products ORDER BY name");
								$stmt->execute();
								foreach ($stmt as $row) {
									$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
									$inc = ($inc == 3) ? 1 : $inc + 1;
									if($inc == 1) echo "<div class='item'>";
										echo "
											<div class='col-sm-4'>
												<div class='box box-danger'>
													<div class='box-body prod-body'>
														<img src='".$image."' width='100%' height='230px' class='thumbnail'>
														<h5><b><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></b></h5>
													</div>
													<div class='box-footer'>
														<b>Ksh. ".number_format($row['price'], 2)."</b>
													</div>
												</div>
											</div>
										";
									if($inc == 3) echo "</div>";
									}
									if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
									if($inc == 2) echo "<div class='col-sm-4'></div></div>";
								}
								catch(PDOException $e){
									echo "There is some problem in connection: " . $e->getMessage();
								}

								$pdo->close();

							?>
		                </div>
		            </div>
					<div class="box box-success mapouter"><div class="gmap_canvas"><iframe width="1080" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=KCB%20Serem&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies2.org">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:300px;width:1080px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:1080px;}</style></div></div>
				</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>