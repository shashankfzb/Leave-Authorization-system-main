<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Dashboard</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">

        	
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
           <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>

            <main class="mn-inner mt-5">
                <div class="">
                    <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark ">
                            <div class="card-content">
                            
                                <span class="card-title text-white">Total Registered Employees</span>
                                <span class="stats-counter text-white">
<?php
$sql = "SELECT id from tblemployees";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$empcount=$query->rowCount();
?>

                                    <span class="counter"><?php echo htmlentities($empcount);?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                        <div class="col s12 m12 col-md-4 l4">

                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content" onclick="location.href='?a=all'" style="cursor:pointer;">
                            
                                <span class="card-title text-white">Total Departments</span>
<?php
$sql = "SELECT id from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$dptcount=$query->rowCount();
?>        
<!-- Removed the card with for Total Number of Leaves Types and implemented Total requested leaves today-->
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($dptcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content">
                                <span class="card-title text-white">Total requested leaves today</span>
                                    <?php
$sql = "SELECT id from  tblleaves WHERE DATE(PostingDate) = CURDATE()";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavtodcount=$query->rowCount();
?>   
<!-- added some functionality to know more about the leaves status instead of its type also removed progression bar-->
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($leavtodcount);?></span></span>   
                            </div>
                        </div>
                    </div>
                <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content" onclick="location.href='../principal/approvedleave-history.php'" style="cursor:pointer;">   
                                <span class="card-title text-white">Total approved leaves</span>
                                    <?php
$sql = "SELECT status from tblleaves WHERE status = 1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavappcount=$query->rowCount();
?>                      


                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($leavappcount);?></span></span>   
                            </div>
                        </div>
                </div>
<!-- some more cards for more information about database to the dashboard-->
                <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content" onclick="location.href='../principal/notapproved-leaves.php'" style="cursor:pointer;">
                                <span class="card-title text-white">Total rejected leaves</span>
<!-- assumed that status 1 means approved while 2 means rejected and 0 means pending fix if assumptions are wrong-->
<!--Status 0 -> Waiting for response
    Status 1 -> Approved by HOD as well as Principal 
    Status 2 -> Not Approved by HOD
    Status 3 -> Approved by HOD
    Status 4 -> Not Approved by Principal
-->
<?php
$sql = "SELECT status from tblleaves WHERE status = 4";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavrejcount=$query->rowCount();
?>                      
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($leavrejcount);?></span></span>   

                            </div>
                        </div>
                </div>
                <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content" onclick="location.href='../principal/pending-leavehistory.php'" style="cursor:pointer;">
                                <span class="card-title text-white">Total pending leaves</span>
                                <?php
$sql = "SELECT status from tblleaves WHERE status = 3 or status = 0";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavpencount=$query->rowCount();
?>                      
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($leavpencount);?></span></span>   

                            </div>
                        </div>
                </div> 
                </div>
                 
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12 col-md-12">
                            <div class="card invoices-card border-0 shadow">
                                <div class="card-content">
                                 
                                    <span class="card-title text-success">Today Leave Applications - <?php if($_GET['a']=="all"){echo "All Departments";} else {echo $_GET['a'];}  ?></span>
                             <table id="example" class="display responsive-table bg-transparent">
                                    <thead>
                                        <tr>
                                            <th class="text-danger">Sl No.</th>
                                            <th width="200" class="text-danger">Employe Name</th>
                                            <th width="120" class="text-danger">Leave Type</th>

                                             <th width="180" class="text-danger">Posting Date</th>                 
                                            <th class="text-danger">Status</th>
                                            <th align="center" class="text-danger text-center" >Action</th>
                                        </tr>
                                    </thead>
                                    <div class="input-field col m6 s12" style="text-align:center;">

<script type="text/javascript">
    function updateSelectedOption(){
        a = document.getElementById('myselect').value;
        location.href = "?a="+a;
    }
</script>


<select id="myselect" name="department" autocomplete="off" onchange="updateSelectedOption()">

<!--can somebody fix the issue where current selected departments gets on top-->
<option value="all">All Department...</option>
<?php $sql = "SELECT DepartmentName from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->DepartmentName);?>"><?php echo htmlentities($result->DepartmentName);?></option>
<?php }} ?>
</select>
</div>                       


<tbody>
<?php
$status = $_GET['a'];
if($status == "all"){
    $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where DATE(tblleaves.PostingDate) = CURRENT_DATE order by lid desc limit 6";
    $query = $dbh -> prepare($sql);
}
else{
    $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblemployees.Department=:status and DATE(tblleaves.PostingDate) = CURRENT_DATE order by lid desc;";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
}
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</a></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                                                                       <td><?php $stats=$result->Status;
if($stats==1){
    ?>
    <span style="color: green">Approved</span>
     <?php } if($stats==2)  { ?>
    <span style="color: red">Not Approved</span>
    <?php } if($stats==0)  { ?>
     <span style="color: blue">waiting for approval</span>
     <?php }if($stats==3)  { ?>
     <span style="color: blue">Approved by HOD</span>
     <?php } if($stats==4)  { ?>
     <span style="color: red">Not Approved by Principal</span>
     <?php } ?>


                                             </td>

          <td>
           <td><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect waves-light btn blue m-b-xs"  > View Details</a></td>
                                    </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
						
						<div class=""></div>
						
						
                    </div>
                </div>
              
            </main>
          
        </div>

        
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/plugins/chart.js/chart.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/dashboard.js"></script>
        
    </body>
</html>
<?php } ?>