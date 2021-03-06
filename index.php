<?PHP include 'conection.php' ?>
<?PHP
require_once 'phpqrcode/qrlib.php';
$error_emty ="";
$error_suc ="";
$error ="";
 if(isset($_POST["submit"])){
    /*----------get form data------------------------*/
    $name = $con->real_escape_string($_POST['fname']);
    $email = $con->real_escape_string($_POST['email']);
    $tel_no = $con->real_escape_string($_POST['tel']);
    $b_date = $con->real_escape_string($_POST['bdate']);
    $address = $con->real_escape_string($_POST['add']);

    
    
    /*----------form validation------------------------*/
    if(!empty($name) && !empty($email) && !empty($tel_no) && !empty($b_date) && !empty($address)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $qr_text = "name: ".$name." / birthday: ".$b_date." / address: ".$address." / email: ".$email." / Tel: ".$tel_no;
            $qr_name = "QRC".$name;
            $path = 'img/qr/';
            $file = $path.$qr_name.".png";
        
            QRcode::png($qr_text,$file,'L',10);
            
            echo '<center> <img src="'.$file.'"></center>
                <center> <h4>Name : '.$qr_name.'</h4></center>
                <center> <p>QR : '.$qr_text.'</p></center>
                <center> <a href="downloadqr.php?path='.$file.'"><button type="button" id="myBtn" class="shipp_button">Download</button></a></center>';

        $error_suc = "Succses Full ! <b> Make You QR</b>";
         
        //header("location: feedback.php");    
      }else{
        $error ="Please Enter Valid Email";
      }           
    }else{
      $error_emty ="Filed Emty, All filed Fill And Submit";
    } 
  }

 
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/logosahan.png">
  <link rel="icon" type="image/png" href="img/logosahan.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>SC My QR Genarate</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 <!--------font & Awesome icon link down----------->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="demo/demo.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="row" id="card_form">
          <div class="col-md-10">
            <div class="card card-user" id="card_color">
              <div class="card-header">
                <h6 class="card-title">You'r Dtails</h5>
                <p class="msgsuc"><?php $error_suc ?></p>
                <p class="error"><?php echo $error_emty, $error; ?></p>
              </div>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-11 pr-1">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" name="fname">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                      </div>
                    </div>
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Tel.No:</label>
                        <input type="text" class="form-control" placeholder="Number With Cuntry Code" name="tel">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Birthday</label>
                        <input type="date" class="form-control" placeholder="" name="bdate">
                      </div>
                    </div>
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="" name="add">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">QR</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This web site is made by <a href="#" target="_blank">Sc Create </a>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
 
  <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js"></script>
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="demo/demo.js"></script>

  <?PHP
  //welcome alert
    if(empty($error_emty)){
        if(empty($error)){
            if(!empty($error_suc)){
                $sesion_error = " Welcome !<b> Faculty of Technology Inventry System</b>";
                echo "<script> demo.showNotification('top','center','".$error_suc."', 'success', 'nc-icon nc-check-2'); </script>";
            }
          }else{
            $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
            echo "<script> demo.showNotification('top','center','".$error."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
          }
    }else{
      $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
      echo "<script> demo.showNotification('top','center','".$error_emty."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
    }
  ?>
  
</body>

</html>


