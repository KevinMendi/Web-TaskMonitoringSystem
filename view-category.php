<?php

function __autoload($class)
{
    require_once "classes/$class.php";
}


?>
<!DOCTYPE html>
<html lang="en">

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>List of Tasks &mdash; Rimpido Visual Team Management Tool</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

<!-- CSS Libraries -->
<link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
<link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">

<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="layout-4">
<!-- Page Loader -->
<!--<div class="page-loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>-->

    
<!-- START SCRIPT CODE -->
<script type="text/javascript">
    function showStatus(str){
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("tbody").innerHTML=this.responseText;
        }
      }
      xmlhttp.open("GET","task-by-status-table.php?q="+str,true);
      xmlhttp.send();
    }
</script>
<!-- END SCRIPT CODE -->
    
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        
        <!-- Start app top navbar -->    
        
        <?php include "includes/TopNavBar.php";?>
        
        <!-- END TOP NAV BAR-->
        
         <!-- Start main left sidebar menu -->
        
        <?php include "includes/MainLeftSideBar.php";?>
        
        <!-- END LEFT SIDEBAR MENU -->


        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                    <div class="section-header">
                    <h1>Tasks by Status:</h1>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                        <select class="btn btn-primary dropdown-toggle" name="status" id="status" onchange="showStatus(this.value)">
                                        <option value="0" selected="selected">Select Status</option>
                                        <option value="1">Created</option>  
                                        <option value="2">In Progress</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Overdue</option>
                                        </select>
                                </div>
                
<!----******************************************** ViewTaskList by status ******************************************* --------- -->
    
 <!----******************************************** ViewTaskList by status end ******************************************* --------- -->                     
                                
                                <div class="card-body" id="card-body">
                                    
                                        <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-2">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>Task Name</th>
                                                <th>Members</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Due Date</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php
                                                $ch = new TaskCrud();
                                                $rows = $ch->viewTaskList(); 
                                                foreach ($rows as $row2)
                                                {
                                                ?>
                                                
                                                <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                                    <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td><?php echo $row2['Activity'] . ": " . $row2['Description']; ?></td>
                                                
                                                <td>
                                                    <?php 
                                                    $rows3 = $ch->viewPerson($row2['Task_ID']);
                                                    foreach($rows3 as $row3)
                                                    {
                                                    ?>
                                                    <img alt="image" src="assets/img/avatar/<?php echo $row3['PersonResponsible']; ?>.jpg" class="rounded-circle" width="25" data-toggle="tooltip" title="<?php echo $row3['FullName']; ?>">
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    
                                                    <?php 
                                                    $rows4 = $ch->viewStatus($row2['status']);
                                                    foreach($rows4 as $row4)
                                                    {
                                                    ?>
                                                    <div class="badge badge-warning"><?php echo $row4['status_desc']; ?></div> 
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                    
                                                    <td>
                                                    <?php 
                                                    $rows6 = $ch->viewTaskCategoryName($row2['Task_ID']);
                                                    foreach($rows6 as $row6)
                                                    {
                                                    ?>
                                                    <div class="badge badge-light"> <?php echo $row6['category_name']; ?></div> 
                                                    <?php
                                                    }
                                                    ?>
                                                        
                                                       
                                                    </td>
                                                    
                                                     <td>
                                                        <div class="badge badge-light"> <?php echo $row2['DateAdded']; ?></div> 
                                                       
                                                    </td>
                                                
                                                    <td><a href="view-task.php?id=<?php echo $row2['Task_ID']; ?>" class="btn btn-secondary">Details</a></td>
                                                </tr>
                                                <?php 
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>

<!-- General JS Scripts -->
<script src="assets/bundles/lib.vendor.bundle.js"></script>
<script src="js/CodiePie.js"></script>

<!-- JS Libraies -->
<script src="assets/modules/datatables/datatables.min.js"></script>
<script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>


<!-- Page Specific JS File -->
<script src="js/page/modules-datatables.js"></script>
    
<script src="js/page/forms-advanced-forms.js"></script>

<!-- Template JS File -->
<script src="js/scripts.js"></script>
<script src="js/custom.js"></script>


    
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->
</html>