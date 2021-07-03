<?php include 'includes/session.php'; ?>
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
                  <div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-warning'></i> Error!</h4>
                    ".$_SESSION['error']."
                  </div>
                ";
                unset($_SESSION['error']);
              }
              if(isset($_SESSION['success'])){
                echo "
                  <div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Success!</h4>
                    ".$_SESSION['success']."
                  </div>
                ";
                unset($_SESSION['success']);
              }
            ?>
            <div class="box box-success">
              <div class="box-header">
                  <h4 class="modal-title">
                      <b>
                          Welcome 
                          <?php
                              if(isset($_SESSION['user'])){
                                  echo $user['firstname'];
                              }
                              else{
                              echo "
                                  <h4>You need to <a href='login.php'>Login</a> to start messaging.</h4>
                              ";
                              }
                          ?>!
                      </b> 
                      <b class="pull-right">
                          <span style="color:tomato;">Contact</span> 
                          Center
                      </b>
                  </h4>
              </div>
              <div class="box-body">
                <?php $imag = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';?>
                
                
                
                <?php 
                  $nowa = $user['id']; 
                  $conn = $pdo->open();
                  try{
                    $stmt = $conn->prepare("UPDATE message SET status=:receiverdelete WHERE receiver_id=$nowa");
			              $stmt->execute(['receiverdelete'=>1]);
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM message WHERE sender_id=$nowa OR receiver_id=$nowa");
                    $stmt->execute();
                    $trow = $stmt->fetch();
                    if($trow['numrows'] > 0){
                      $stmt = $conn->prepare("SELECT * FROM message LEFT JOIN users ON users.id=message.sender_id WHERE sender_id=$nowa OR receiver_id=$nowa");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $bih = $row['sender_id'];
                        $dse = $row['type'];
                        $jdj = $row['photo'];
                        $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg';
                        if ($bih!=$nowa){
                          if ($dse==1) {
                            echo"
                              <div class='row' style='margin-bottom:10px;'>
                                <div class='col-md-1 col-xs-3 pull-left image user'>
                                  <img style='width:100%;' src='".$image."' class='img-circle' alt='User Image'>
                                </div>
                                <div class='col-md-10 col-xs-8' style='background-color:lightblue; border-left:5px solid blue;'>
                                  <p><u>".$row['firstname'].' '.$row['lastname']." : Management</u></p>
                                  <p>".$row['message']."</p>
                                  <span style='float:right;'>&nbsp; ".$row['timesent']." &nbsp;<i class='fa fa-trash text-danger'></i></span>
                                </div>
                              </div>
                            <hr>
                            ";
                          } 
                          elseif ($dse==2) {
                            echo"
                            <div class='row' style='margin-bottom:10px;'>
                              <div class='col-md-1 col-xs-3 pull-left image user'>
                                <img style='width:100%;' src='".$image."' class='img-circle' alt='User Image'>
                              </div>
                              <div class='col-md-10 col-xs-8' style='background-color:lightyellow; border-left:5px solid orange;'>
                                <p><u>".$row['firstname'].' '.$row['lastname']." : Support Team</u></p>
                                <p>".$row['message']."</p>
                                <span style='float:right;'>&nbsp; ".$row['timesent']." &nbsp;<i class='fa fa-trash text-danger'></i></span>
                              </div>
                            </div>
                            <hr>
                            ";
                          }
                          else{
                            echo"
                              <div class='row' style='margin-bottom:10px;'>
                                <div class='col-md-1 col-xs-3 pull-left image user'>
                                  <img style='width:100%;' src='".$image."' class='img-circle' alt='User Image'>
                                </div>
                                <div class='col-md-10 col-xs-8' style='background-color:lightgrey; border-left:5px solid grey;'>
                                  <p><u>".$row['firstname'].' '.$row['lastname']." : Courier Service</u></p>
                                  <p>".$row['message']."</p>
                                  <span style='float:right;'>&nbsp; ".$row['timesent']." &nbsp;<i class='fa fa-trash text-danger'></i></span>
                                </div>
                              </div>
                              <hr>
                            ";
                          }
                        }
                        else{
                          echo"
                            <div class='row' style='margin-bottom:10px;'>
                              <div class='col-md-1 col-xs-3 pull-right image user'>
                                <img style='border-radius:50%; width:100%;' src='".$imag."' class='img-circle' alt='User Image'>
                              </div>  
                              <div class='col-md-10 col-xs-8 pull-right' style='background-color:lightgreen; border-right:5px solid green;'>
                                <p>".$row['message']."</p>
                                <span style='float:right;'>&nbsp; ".$row['timesent']." &nbsp;<i class='fa fa-trash text-danger'></i></span>
                              </div>
                            </div>
                            <hr>
                          ";
                          
                        }
                      }
                    }
                    else{
                      echo"
                        <p style='background-color:wheat; text-align:center; padding:10px; border:2px solid tan; border-radius:5px;'><b>No message to show in chat.<br>Start conversation</b></p>
                      ";
                    }
                  }
                  catch(PDOException $e){
                    echo "There is some problem in connection: " . $e->getMessage();
                  }
                  $pdo->close();
                ?>
                  
              </div>
              <div class="box-footer" style="background-color:lightgrey;">
                <div>
                  <form class="form-horizontal" method="POST" action="contact_add.php">
                      <div class="row form-group">
                        <input type="hidden" name="sender_id" value="<?php echo $user['id']?>">
                        <input type="hidden" name="sender_name" value="<?php echo $user['firstname'].' '. $user['lastname']?>">
                        <input type="hidden" name="sender_email" value="<?php echo $user['email']?>">
                        <input type="hidden" name="sender_img" value="<?php echo $user['photo']?>">
                        <input type="hidden" name="receiver_id" value="0">
                        <input type="hidden" name="receiver_img" value="logo.png">
                        <div class="col-md-10 col-xs-8">
                          <textarea class="form-control" style="width: 100%; margin-left:15px;" name="message" id="message" required placeholder="Type your message here..."></textarea>
                        </div>
                        <button type="submit" class="col-md-1 col-xs-3 btn btn-success btn-flat" style="padding:16px;" name="add"><i class="fa fa-send"></i> Send</button>
                      </div>
                  </form>
                </div>
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
  <?php $pdo->close(); ?>
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/cart_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
