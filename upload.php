    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
    html,body{
        height: 100%;
        background:#EEEEEE;
      }

</style>
      <?php
include 'config.php';
include 'fun.php';
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = "img/" . $_FILES['userImage']['name'];
        if (move_uploaded_file($sourcePath, $targetPath)) {
            ?>

<div style="padding-top:5%;"class="row">
    <div class="col-sm-6">
<div class="card">
<div class="card-header">Before</div>

<div class="card-body">
<center><img height="50%" width="50%" class="img-responsive" src="<?php echo $targetPath; ?>"
	class="upload-preview" /></center>

</div></div></div>
    <div class="col-sm-6">
  <div class="card">
<div class="card-header">After</div>

    <div class="card-body">      
<?php

switch ($removeapi) {
  case "1":
    picwish($targetPath);
    break;
  case "2":
    photoroom($targetPath);
    break;
  case "3":
    imagga($targetPath);
    break;
  case "4":
    clipdrop($targetPath);
  break; 

 case "5":
    slazzer($targetPath);
    break;
  case "6":
    clippingmagic($targetPath);
    break;
  case "7":
    removebg($targetPath);
    break;
  default:
    echo "Configuration Failed";
}
?>  </div>   </div> </div>   </div>
<?php
        }
    }
}
?>