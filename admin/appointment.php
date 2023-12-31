<?php
    session_start();
    if(!isset($_SESSION["admin_name"]))
    {
        header('Location:admin-login.php');
    }
    $con=mysqli_connect("localhost","root","","healthycare");
    if(!$con){	
		die("Cannot connect to DB server");	
    }
    if(isset($_POST["asearch"]))
    {
        $value=$_POST["value"];
        $column=$_POST["column"];
        ?>
        <br><br><br><br>
                <div class="notification2">
                <table class="table">     
                  <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Chaneel Center ID</th>
                        <th scope="col">Ill Type</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $sql2 ="SELECT * FROM `appointment` WHERE ".$column." LIKE '%".$value."%'";
                      $result2 = mysqli_query($con,$sql2);
                    if(mysqli_num_rows($result2)>0)
                    {
                	   while($row = mysqli_fetch_assoc($result2))
                        {
                	?>
                    <tr>
                        <th><?php echo $row['a_id']; ?></th>
                        <td><?php echo $row['c_id']; ?></td>
                        <td><?php echo $row['ch_id']; ?></td>
                        <td><?php echo $row['a_illltype']; ?></td>
                        <td><?php echo $row['a_datetiime']; ?></td>
                        <td>
                            <?php 
                                if($row['a_status']=="Processing"){
                                   ?><span class="btn btn-primary btn-sm"><?php echo $row['a_status']; ?></span><?php 
                                }else if($row['a_status']=="Appointed"){
                                   ?><span class="btn btn-success btn-sm"><?php echo $row['a_status']; ?></span><?php 
                                }else if($row['a_status']=="Canceled"){
                                   ?><span class="btn btn-danger btn-sm"><?php echo $row['a_status']; ?></span><?php 
                                }
                            ?>
                        </td>
                        <td>
                        <form class="form-inline form-group" action="appointment.php?a_id=<?php echo $row['a_id']; ?>" method="post">
                            <select class="form-control" id="status" name="status">
                              <option value="Processing">Processing</option>
                              <option value="Appointed">Delivered</option>
                              <option value="Canceled">Canceled</option>
                            </select>
                           <input type="submit" class="btn btn-danger my-2 my-sm-0" value="Update" id="update" name="update">
                        </form>
                        </td>
                    </tr>
                    	<?php
                		}
                    }else{ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:80%; margin:auto;">
                          <strong>No Result Found.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                    }?>
                  </tbody>
                </table> 
                 </div>
                 <hr>
                 <?php 
        
    }
    if(isset($_POST["update"]))
    {
        $status=$_POST["status"];
        $a_id=$_GET['a_id'];
        $sql2="UPDATE `appointment` SET `appointment`.`a_status`='".$status."' WHERE `appointment`.`a_id`=".$a_id." ;";
        mysqli_query($con,$sql2);
    }
?> 
<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="/img/sheet.css" rel="stylesheet">
        <title>Admin | Healthy Care</title>
  </head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar navbar-light shadow p-3 mb-5 bg-white rounded justify-content-between" style="background-color: white;">
  <a class="navbar-brand">Doctor Appointment Management</a>

  <span class="form-inline">
    <span class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <h7>Welcome <strong><?php echo $_SESSION["admin_name"]; ?></strong></h7>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="index.php"><img src="/img/dashboard.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Dashboard</a>
            <a class="dropdown-item" href="employee.php"><img src="/img/employee.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Employee</a>
            <a class="dropdown-item" href="order.php"><img src="/img/order2.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Order</a>
            <a class="dropdown-item" href="appointment.php"><img src="/img/appointment2.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Appointment</a>
            <a class="dropdown-item" href="emergency.php"><img src="/img/emergency2.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Emergency</a>
            <a class="dropdown-item" href="email.php"><img src="/img/email.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Email</a>
            <a class="dropdown-item" href="setting.php"><img src="/img/setting.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Setting</a>
            <a class="dropdown-item" href="https://www.stackcp.com/services/3790b5532b220c29/file-manager" target="_blank"><img src="/img/file.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">File</a>
            <a class="dropdown-item" href="https://phpmyadmin.stackcp.com/index.php" target="_blank"><img src="/img/database.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Database</a>
        <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"><img src="/img/logout.png" style="float: left; width: 18%; padding-right: 5px; padding-top: 4px;">Logout</a>
        </div>
      </span>
  </span>
</nav>


    <br><br><br><br>

<div style="width:100%; margin:auto;">
  <div class="row">
    <div class="col">
        <div class="notification3">
         <h5>Recent Appointments</h5>
<table class="table">     
  <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">Customer ID</th>
        <th scope="col">Chaneel Center ID</th>
        <th scope="col">Ill Type</th>
        <th scope="col">Date & Time</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $sql2 ="SELECT * FROM ( SELECT * FROM `appointment` ORDER BY a_id DESC LIMIT 5 ) sub ORDER BY a_id ASC";
      $result2 = mysqli_query($con,$sql2);
    if(mysqli_num_rows($result2)>0)
    {
	   while($row = mysqli_fetch_assoc($result2))
        {
	?>
    <tr>
        <th><?php echo $row['a_id']; ?></th>
        <td><?php echo $row['c_id']; ?></td>
        <td><?php echo $row['ch_id']; ?></td>
        <td><?php echo $row['a_illltype']; ?></td>
        <td><?php echo $row['a_datetiime']; ?></td>
        <td><?php 
        if($row['a_status']=="Processing"){
            ?><span class="btn btn-primary btn-sm"><?php echo $row['a_status']; ?></span><?php 
        }else if($row['a_status']=="Appointed"){
            ?><span class="btn btn-success btn-sm"><?php echo $row['a_status']; ?></span><?php 
        }else if($row['a_status']=="Canceled"){
            ?><span class="btn btn-danger btn-sm"><?php echo $row['a_status']; ?></span><?php 
        }
        ?>
        </td>
    </tr>
    	<?php
		}
    }else{
    echo "No Appointment Available";
    }?>
      
  </tbody>
</table> 
        </div>
    </div>
    <div class="col">
      <div class="notification4">
         <h5>Analytics</h5><hr>
                <?php
              $today=date("Y-m-d");
              $sql2 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_datetiime` LIKE '".$today."%';";
              $result2 = mysqli_query($con,$sql2);
                if(mysqli_num_rows($result2)>0)
                {
                   while($row = mysqli_fetch_assoc($result2))
                    {
                       $orders=$row['COUNT(*)'];
                    }
                }
                $today=date("Y-m-d", strtotime("+1 day"));
                $last30=date("Y-m-d", strtotime("-1 month"));
                $last7=date("Y-m-d", strtotime("-7 day"));
                $last15=date("Y-m-d", strtotime("-15 day"));
                
                $sql3 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_datetiime` BETWEEN '".$last30."' AND '".$today."';";
                $result3 = mysqli_query($con,$sql3);
                if(mysqli_num_rows($result3)>0)
                {
                   while($row = mysqli_fetch_assoc($result3))
                    {
                       $orders2=$row['COUNT(*)'];
                    }
                }
                $sql4 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_datetiime` BETWEEN '".$last7."' AND '".$today."';";
                $result4 = mysqli_query($con,$sql4);
                if(mysqli_num_rows($result4)>0)
                {
                   while($row = mysqli_fetch_assoc($result4))
                    {
                       $orders3=$row['COUNT(*)'];
                    }
                }
                $sql5 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_datetiime` BETWEEN '".$last15."' AND '".$today."';";
                $result5 = mysqli_query($con,$sql5);
                if(mysqli_num_rows($result5)>0)
                {
                   while($row = mysqli_fetch_assoc($result5))
                    {
                       $orders4=$row['COUNT(*)'];
                    }
                }
            ?>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td><h2><?php echo $orders ?></h2></td>
                  <td><h2><?php echo $orders3 ?></h2></td>
                  <td><h2><?php echo $orders4 ?></h2></td>
                  <td><h2><?php echo $orders2 ?></h2></td>
                </tr>
                <tr>
                  <td>Today</td>
                  <td>Last Week</td>
                  <td>Last 15 Days</td>
                  <td>Last 30 Days</td>
                </tr>
              </tbody>
            
            <?php 
            $c1=0;
            $c2=0;
            $c3=0;
            $sql6 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_status`='Processing';";
            $result6 = mysqli_query($con,$sql6);
            if(mysqli_num_rows($result6)>0)
            {
                while($row = mysqli_fetch_assoc($result6))
                {
                    $c1=$row['COUNT(*)'];
                }
            } 
            $sql7 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_status`='Appointed';";
            $result7 = mysqli_query($con,$sql7);
            if(mysqli_num_rows($result7)>0)
            {
                while($row = mysqli_fetch_assoc($result7))
                {
                    $c2=$row['COUNT(*)'];
                }
            } 
            $sql8 ="SELECT COUNT(*) FROM `appointment` WHERE `appointment`.`a_status`='Canceled';";
            $result8 = mysqli_query($con,$sql8);
            if(mysqli_num_rows($result8)>0)
            {
                while($row = mysqli_fetch_assoc($result8))
                {
                    $c3=$row['COUNT(*)'];
                }
            }
            
            ?>
            
            </table>
             <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="bg-primary text-white"><h2><?php echo $c1 ?></h2></td>
                  <td class=""><h2><?php echo $c2 ?></h2></td>
                  <td class="bg-danger text-white"><h2><?php echo $c3 ?></h2></td>
                  
                </tr>
                <tr>
                  <td class="">Processing</td>
                  <td class="bg-success text-white">Appointed</td>
                  <td class="">Canceled</td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>
</div>
    <br><br>
    <div class="notification2">
         <table class="table">
             <tbody>
                <tr>
                <th scope="col" width="70%"><h3>Appointments</h3></th>
                <form class="form-inline form-group" action="appointment.php" method="post">
                <th scope="col" width="20%"><input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="value" name="value"></th>
                <th scope="col" width="20%">
                <select class="form-control" id="column" name="column">
                  <option value="a_id">ID</option>
                  <option value="a_status">Status</option>
                </select>
                </th>
                <th scope="col" width="10%">
                    <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Search" id="asearch" name="asearch">
                    </th>
                </form>
                </tr>
             </tbody>
         </table>

<table class="table">     
  <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Chaneel Center Name</th>
        <th scope="col">Ill Type</th>
        <th scope="col">Date & Time</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $sql2 ="select appointment.a_id, chanelcenter.ch_name, customer.c_name, appointment.a_illltype, appointment.a_datetiime, appointment.a_status
FROM appointment, chanelcenter, customer
WHERE chanelcenter.ch_id=appointment.ch_id AND customer.c_id=`appointment`.c_id;";
      $result2 = mysqli_query($con,$sql2);
    if(mysqli_num_rows($result2)>0)
    {
	   while($row = mysqli_fetch_assoc($result2))
        {
	?>
    <tr>
        <th><?php echo $row['a_id']; ?></th>
        <td><?php echo $row['c_name']; ?></td>
        <td><?php echo $row['ch_name']; ?></td>
        <td><?php echo $row['a_illltype']; ?></td>
        <td><?php echo $row['a_datetiime']; ?></td>
        <td><?php 
        if($row['a_status']=="Processing"){
            ?><span class="btn btn-primary btn-sm"><?php echo $row['a_status']; ?></span><?php 
        }else if($row['a_status']=="Appointed"){
            ?><span class="btn btn-success btn-sm"><?php echo $row['a_status']; ?></span><?php 
        }else if($row['a_status']=="Canceled"){
            ?><span class="btn btn-danger btn-sm"><?php echo $row['a_status']; ?></span><?php 
        }
        ?>
        </td>
        <td>
            <form class="form-inline form-group" action="appointment.php?a_id=<?php echo $row['a_id']; ?>" method="post">
                <select class="form-control" id="status" name="status">
                  <option value="Processing">Processing</option>
                  <option value="Appointed">Appointed</option>
                  <option value="Canceled">Canceled</option>
                </select>
               <input type="submit" class="btn btn-danger my-2 my-sm-0" value="Update" id="update" name="update">
            </form>
        </td>
    </tr>
    	<?php
		}
    }else{
    echo "No Appointment Available";
    }?>
  </tbody>
</table> 
 </div>

    <br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>