
<aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="../assets/images/user.png" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                       
                                <p>Principal</p>

                         
                        </div>
                    </div>
            
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                    <li class="no-padding"><a class="waves-effect waves-grey" href="dashboard.php?a=all"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
   <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">desktop_windows</i>Leave Management<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="leaves.php">All Leaves </a></li>
                                <li><a href="pending-leavehistory.php">Pending Leaves </a></li>
                                <li><a href="approvedleave-history.php">Approved Leaves</a></li>
                                  <li><a href="notapproved-leaves.php">Not Approved Leaves</a></li>
       
                            </ul>
                        </div>
                    </li>
    <li class="no-padding">
        <a class="collapsible-header waves-grey"><i class="material-icons">account_box</i>Dept. Management<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
    <div class="collapsible-body">
    <ul><?php
$sql = "SELECT DepartmentName,id from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_COLUMN);
if ($query->rowCount() > 0){
    foreach ($results as $department){
        echo '<li> <a href="departmentleaves.php?name='.$department.'">' .$department. '</a> </li>';
    }
}
else {
    echo "No department found";
}
?>
    <li></li>
    </ul>
    </div>
    </li>

    <li class="no-padding"><a class="waves-effect waves-grey" href="changepassword.php"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>

                        <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Log Out</a>
                            </li>  
                </ul>
                  
                </div>
            </aside>