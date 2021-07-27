<?php
include "connection.php";
session_start();
if(!isset($_GET['id']) ){ header("Location: index.php"); exit(); }
if(!isset($_SESSION['user:id'])){
    header("Location: login.php");
}
$user_id = $_SESSION['user:id'];
$course_id = (int)$_GET['id'];
$row = $conn->query("select * from  users where id = '$user_id' ")->fetch();
$course = $conn->query("select * from  courses where id = '$course_id' ")->fetch();

if($course['user_id'] != $user_id){die();}
$msg = "";

if(isset($_POST['submit'])){

    $course_name = $_POST['coure_name'];
    $course_day = $_POST['day'];
    $course_time = $_POST['time'];
    $course_class= $_POST['coure_class'];
    $course_in_week = $_POST['coure_time_week'];

    $stmt = $conn->prepare(" UPDATE `courses` SET `courseName`='$course_name',`courseTime`='$course_time',`courseClass`='$course_class',`courseTime_inWeek`= '$course_in_week' , `courseDay` = '$course_day' WHERE id = $course_id ");
    $executed = $stmt->execute();
    if($executed){
        $msg = '<div class="alert alert-success" role="alert">
        Edit Done Seccfully. <a href="courses.php" class="btn-link"> Back </a>
     </div>';
    }else{
        $msg = '<div class="alert alert-danger" role="alert">
        There is error try agin.
        </div>';
    }

    
}
$course = $conn->query("select * from  courses where id = '$course_id' ")->fetch();




?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Courses</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/DateTimePicker.min.js"></script>
        <link rel="stylesheet" href="css/DateTimePicker.min.css">
        

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Course Table</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="editUser.php">Edit User</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Course</div>

                            <a class="nav-link" href="add.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                                Add Course
                            </a>
                            <a class="nav-link" href="courses.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Edit Courses
                            </a>
                            <div class="sb-sidenav-menu-heading">Setting</div>
                            <a class="nav-link" href="editUser.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Edit Your Accout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $row['firstName'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Edit Courses <b><?php echo $course['courseName'] ?></b> </li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Your Course Table
                            </div>
                            <div class="card-body">
                                <?php echo $msg ?>
                                
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Course Name</label>
                                    <input type="text" class="form-control" name="coure_name"  value="<?=$course['courseName']?>">
                                </div>
                                <div class="form-group pt-2">
                                    <label>Course Day</label>
                                    
                                    <select class="form-control" name="day">
                                        <option value="<?=$course['courseDay']?>"><?=numToDay($course['courseDay'])?></option>
                                        <option value="1">Sunday</option>
                                        <option value="2">Monday</option>
                                        <option value="3">Tuesday</option>
                                        <option value="4">Wedenday</option>
                                        <option value="5">Thursday</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group pt-2">
                                    <label>Course Time</label>
                                    <input type="text" class="form-control form-control-user" name="time" value="<?=$course['courseTime']?>" id="only-time" data-field="time" placeholder="<?=$course['courseTime']?>" readonly="">
                                </div>
                                <div class="form-group pt-2">
                                    <label>Class Room</label>
                                    <input type="text" class="form-control" name="coure_class"  value="<?=$course['courseClass']?>">
                                </div>
                                <div class="form-group pt-2">
                                    <label>Course Time in Week</label>
                                    <input type="text" class="form-control" name="coure_time_week"  value="<?=$course['courseTime_inWeek']?>">
                                </div>
                                <br>
                                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>

	
		<div id="dtBox"></div>
	
		<script type="text/javascript">
        $(document).ready(function()
    {
        $("#dtBox").DateTimePicker({
            dateFormat: "yyyy-MM-dd",
            timeFormat: "hh:mm AA",

        });

    });
		</script>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Summer Trainng 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
    </body>
</html>
