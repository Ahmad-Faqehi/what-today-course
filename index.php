<?php 
include "connection.php";

session_start();
// To chcek if user is not login
if(!isset($_SESSION['user:id'])){
    header("Location: login.php");
}
$user_id = $_SESSION['user:id'];
$today =  date("l");
$num_day = dayToNum($today);
$num_cource = $conn->query("select count(*) from  courses where user_id = '$user_id' ")->fetchColumn();
$num_cource_today = $conn->query("select count(*) from  courses where user_id = '$user_id' and courseDay = '$num_day'  ")->fetchColumn();
$row = $conn->query("select * from  users where id = '$user_id' ")->fetch();
$cources = $conn->query("select * from  courses where user_id = '$user_id' and courseDay = '$num_day' ")->fetchAll();
$times = $conn->query("select courseTime_inWeek from  courses where user_id = '$user_id' and courseDay = '$num_day' ")->fetchAll();
$total_time = 0;
foreach($times as $val){
    $total_time += (int)$val['courseTime_inWeek'];
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
                            <li class="breadcrumb-item active">Home Page</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Today
                                    <div class="h5 mb-0 pt-3"> <?php echo $today ?> </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                <div class="card-body">Total Courses today
                                    <div class="h5 mb-0 pt-3"> <?php echo $num_cource_today ?> </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Your Course Table Today
                            </div>
                            <div class="card-body">
                            <?php if($num_cource == 0): ?>
                            <div class="alert alert-warning" role="alert">
                               You don't hava any course on your table yet. <a href="add.php" class="btn-link">Add Cousre</a>
                            </div>
                            <?php endif ?> 

                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Course Name</th>
                                            <th>Time</th>
                                            <th>Class Room</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Day</th>
                                            <th>Course Name</th>
                                            <th>Time</th>
                                            <th>Class Room</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($cources as $cource): ?>
                                        <tr>
                                            <td><span style="display: none"><?=$cource['courseDay'] ?></span><?php echo numToDay($cource['courseDay']) ?></td>
                                            <td><?php echo $cource['courseName'] ?></td>
                                            <td><?php echo $cource['courseTime'] ?></td>
                                            <td><?php echo $cource['courseClass'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
