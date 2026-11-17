<?php 
$the_user = $_SESSION['request_user_roleid']; 
if ($the_user == -1){

?>

<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown">
              <a href="../pages/admin.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                <li><a class="nav-link" href="../requisition/auditrequisition.php">Audit Requisition</a></li>
                <li><a class="nav-link" href="../requisition/approverequisition.php">Approve Requisition</a></li>
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Items</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../requisition/Itemview.php">View Items</a></li>
                <li><a class="nav-link" href="../requisition/uom.php">UOM(S)</a></li>
                <li><a class="nav-link" href="../requisition/itemmovement.php">Item Movement</a></li>
              </ul>
            </li>
            <li class="dropdown active" >
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../requisition/viewusers.php">View Users</a></li>
                <li><a class="nav-link" href="../requisition/department.php">Departments</a></li>
                
              </ul>
            </li>
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/Viewclaim.php">View Claim</a></li>
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
                <li><a class="nav-link" href="../claim/claimcategory.php">Claim Category</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Chat</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>

<?php 
}
elseif ($the_user == 0){  

?>

<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown">
              <a href="../pages/dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/Viewclaim.php">View Claim</a></li>
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>
<?php 
}
elseif ($the_user == 1){  

?>
<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown">
              <a href="../pages/auditor.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown active">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                <li><a class="nav-link" href="../requisition/auditreq.php">Audit Requisition</a></li>
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
                <li><a class="nav-link" href="../claim/auditclaim.php">Audit Claims</a></li>
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/auditrefund.php">Audit Refunds</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules </span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>
      <?php 
}
elseif ($the_user== 2){ 
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      
          <span
            class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
        </a>
      
      <ul class="sidebar-menu">
        <li class="menu-header">REQUISITIONS</li>
        <li class="dropdown">
          <a href="../pages/approval.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown active">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i
              data-feather="briefcase"></i><span>Requisitions</span></a>
          <ul class="dropdown-menu">
            <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
            <li><a class="nav-link" href="../requisition/approvereq.php">Approve Requisition</a></li>
            <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
            
          </ul>
        </li>
        
        <li class="menu-header">CLAIMS</li>
        <li class="dropdown">
          <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
            <li><a class="nav-link" href="../claim/approveclaim.php">Approve Claims</a></li>
            <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="" class="menu-toggle nav-link has-dropdown"><i
              data-feather="shopping-bag"></i><span>Refunds</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
            <li><a class="nav-link" href="../refund/approverefund.php">Approve Refunds</a></li>
            <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
          </ul>
        </li>
        
        
        <li class="menu-header">Other Modules</li>
        <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules </span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="">Module Unit</a></li>
            <li><a href="">Module Units</a></li>
          </ul>
        </li>
        
      </ul>
    </aside>
  </div>

<?php 
}
elseif ($the_user== 3){ 
?>

<div class="main-sidebar sidebar-style-2">
      <aside id="sidebar-wrapper">
        
            <span
              class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
          </a>
        
        <ul class="sidebar-menu">
          <li class="menu-header">REQUISITIONS</li>
          <li class="dropdown">
            <a href="../pages/procurement.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
          </li>
          <li class="dropdown active">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                data-feather="briefcase"></i><span>Requisitions</span></a>
            <ul class="dropdown-menu">
              <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
              <li class="active"><a class="nav-link" href="../requisition/procurement.php">Awaiting Requisition</a></li>
              <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
              
            </ul>
          </li>
          
          <li class="menu-header">CLAIMS</li>
          <li class="dropdown">
            <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
              <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="" class="menu-toggle nav-link has-dropdown"><i
                data-feather="shopping-bag"></i><span>Refunds</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
              <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
            </ul>
          </li>
          
          
          <li class="menu-header">Other Modules</li>
          <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="">Module Unit</a></li>
              <li><a href="">Module Units</a></li>
            </ul>
          </li>
          
        </ul>
      </aside>
    </div>


<?php 
}
elseif ($the_user== 4){ 
?>

<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown">
              <a href="../pages/accountant.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown active">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>

<?php 
}
elseif ($the_user== 5){ 
?>

<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown">
              <a href="../pages/hr.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown active">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
                <li><a class="nav-link" href="../claim/hrapproval.php">Claims Approval</a></li>
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>

<?php 
}
elseif ($the_user== 6){ 
?>


<?php 
}
elseif ($the_user== 7){ 
?>

<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown active">
              <a href="../pages/bcc.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
                
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/bccapprove.php">Approve Refunds</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>


<?php 
}
elseif ($the_user== 8){ 
?>
<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          
             <span
                class="logo-name"><a href=""> <img alt="image" src="../assets/img/e-request.png" class="header-logo" /></span>
            </a>
          
          <ul class="sidebar-menu">
            <li class="menu-header">REQUISITIONS</li>
            <li class="dropdown">
              <a href="../pages/hod.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown active">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Requisitions</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="../requisition/viewrequisition.php">View Requisition</a></li>
                <li><a class="nav-link" href="../requisition/requisitionhistory.php">Requisition History</a></li>
                
              </ul>
            </li>
            
            <li class="menu-header">CLAIMS</li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Claims</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../claim/viewclaim.php">View Claims</a></li>
                <li><a class="nav-link" href="../claim/hodapprove.php">Approve Claim(s)</a></li>
                <li><a class="nav-link" href="../claim/claimhistory.php">Claim History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Refunds</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="../refund/Viewrefunds.php">View Refunds</a></li>
                <li><a class="nav-link" href="../refund/bccapprove.php">Approve Refund(s)</a></li>
                <li><a class="nav-link" href="../refund/refundshistory.php">Refunds History</a></li>
              </ul>
            </li>
            
            
            <li class="menu-header">Other Modules</li>
            <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Other Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="">Module Unit</a></li>
                <li><a href="">Module Units</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>
<?php 
}

?>
