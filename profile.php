<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
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
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		<div class="row">
					<div class="col-md-4">
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title"><b><i class="fa fa-bars"></i> Dashboard Menu</b></h3>
								</div>
								<div class="box-body">
									<a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal" style="margin-bottom:22px; width:100%;"><i class="fa fa-edit"></i> Edit Profile</a>
									<a href="cart_view.php" class="btn btn-info btn-flat btn-sm" style="margin-bottom:22px; width:100%;"><i class="fa fa-shopping-cart"></i> Go to Cart</a>
									<a href="contact.php" class="btn btn-warning btn-flat btn-sm" style="margin-bottom:22px; width:100%;"><i class="fa fa-paper-plane"></i> Messages</a>
								</div>
							</div>
						</div>
	        			<div class="col-md-8">
							<div class="box box-danger">
								<div class="box-header with-border text-center">
									<h3 class="box-title"><b><i class="fa fa-user"></i>  Profile</b></h3>
								</div>
								<div class="box-body row text-center">
									<div class="col-md-5">
										<img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" style="width: 120px; height: 120px; border-radius:50%;">
									</div>
									<div class="col-md-7">
										<h4><b>Name:</b>&nbsp; <?php echo $user['firstname'].' '.$user['lastname']; ?></h4>
										<h4><b>Email:</b>&nbsp; <?php echo $user['email']; ?></h4>
										<h4><b>Contact Info:</b>&nbsp; <?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
										<h4><b>Address:</b>&nbsp; <?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
										<h4><b>Joined:</b>&nbsp; <?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
									</div>
								</div>
							</div>
						</div>
	        			
	        		</div>
	        		<div class="box box-success">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
	        			</div>
	        			<div class="box-body table-responsive">
	        				<table class="table table-bordered" style="width:100%;" id="example1">
	        					<thead>
	        						<th class="hidden"></th>
	        						<th>Date</th>
	        						<th>Transaction#</th>
	        						<th>Amount</th>
	        						<th>Full Details</th>
	        					</thead>
	        					<tbody>
	        					<?php
	        						$conn = $pdo->open();

	        						try{
	        							$stmt = $conn->prepare("SELECT * FROM sales WHERE user_id=:user_id ORDER BY sales_date DESC");
	        							$stmt->execute(['user_id'=>$user['id']]);
	        							foreach($stmt as $row){
	        								$stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
	        								$stmt2->execute(['id'=>$row['id']]);
	        								$total = 0;
	        								foreach($stmt2 as $row2){
	        									$subtotal = $row2['price']*$row2['quantity'];
	        									$total += $subtotal;
	        								}
	        								echo "
	        									<tr>
	        										<td class='hidden'></td>
	        										<td>".date('M d, Y', strtotime($row['sales_date']))."</td>
	        										<td>".$row['pay_id']."</td>
	        										<td>Ksh. ".number_format($total, 2)."</td>
	        										<td><button class='btn btn-sm btn-flat btn-info transact' data-id='".$row['id']."'><i class='fa fa-search'></i> View</button></td>
	        									</tr>
	        								";
	        							}

	        						}
        							catch(PDOException $e){
										echo "There is some problem in connection: " . $e->getMessage();
									}

	        						$pdo->close();
	        					?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
					<div class="box box-danger">
						<div class="box-header with-border text-center">
							<h3 class="box-title"><i class="fa fa-map-marker"></i> Track Parcel</h3>
						</div>
						<div class="box-body">
							<input class="form-control" type="text" placeholder="Enter The Parcel's Tracking Number">
						</div>
					</div>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/profile_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$(document).on('click', '.transact', function(e){
		e.preventDefault();
		$('#transaction').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'transaction.php',
			data: {id:id},
			dataType: 'json',
			success:function(response){
				$('#date').html(response.date);
				$('#transid').html(response.transaction);
				$('#detail').prepend(response.list);
				$('#total').html(response.total);
			}
		});
	});

	$("#transaction").on("hidden.bs.modal", function () {
	    $('.prepend_items').remove();
	});
});
</script>
</body>
</html>