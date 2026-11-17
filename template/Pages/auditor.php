<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<?php
     include "../common/header.php"; 
     require "../resource/conn.php";
     require "../resource/status_check.php"; 
     require '../resource/model/Requisition.php';
     require '../resource/model/claim.php';
     require '../resource/model/refund.php';
     require '../resource/model/item.php';
     require '../resource/model/user.php'; 
?>
<body>
  <?php require_once "../common/topcontent.php";
        require_once "../common/admin_sidebar.php"; 

  $users = $user->get_user_count();
  $low_stock = $item->get_low_stock();
  $reqtotal = $req->fetch_all();
  $claimtotal = $claim->fetch_all();
  $refundtotal = $refund->fetch_all();
  $stock_count = $item->fetch_by_criterial(array('itemtypeid'=> 1));

  $admin_data = array(
    'user' => $users,
    'low_stock' => $low_stock,
    'requisition' => $reqtotal,
    'stocks' => $stock_count,
    'claims' => $claimtotal,
    'refunds' => $refundtotal
  )
  
  
  ?>
      
      <!-- Main Content -->
      
<?php 
      require "../common/home_content.php";
      require "../common/footer.php"; 
?>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>