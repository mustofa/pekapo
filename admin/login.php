﻿<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost","root","","toko");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PEKAPO | Login</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        <h3><strong>Selamat Datang</strong></h3>
        <br />
      </div>
    </div>
    <div class="row ">

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default"> 
          </div>
          <div class="panel-body">
            <form role="form" method="post">
             <br />
             <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input type="text" class="form-control" placeholder= "isikan nama" required name="user"/>
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" class="form-control" placeholder= "isikan kata sandi" required name="pass"/>
            </div>
           </div>
         <div class="text-center">
            <button class="btn btn-info" name="login"><i class="fa fa-sign-in"></i> Masuk</button>
          </div>
        </div>
      </div>
         </form>
         <?php
         if (isset($_POST['login']))
         {
          $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
            AND password ='$_POST[pass]'");
            $yangcocok = $ambil->num_rows;
            if ($yangcocok==1)
            {
             $_SESSION['admin']=$ambil->fetch_assoc();

             echo "<script>alert('login berhasil');</script>";
             echo "<meta http-equiv='refresh' content='1;url=index.php'>";
            }
            else
            {
             echo "<script>alert('login gagal');</script>";
             echo "<meta http-equiv='refresh' content='1;url=login.php'>";
            }
         }
         ?>
       </div>

     </div>
   </div>
 </div>
</div>


<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>

</body>
</html>
