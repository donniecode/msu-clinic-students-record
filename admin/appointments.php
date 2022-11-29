<?php include_once ('../includes/header.php'); ?>

<?php include_once ('topbar.php'); ?>

<?php
$approve = $_GET['approve'];
$decline = $_GET['decline'];

if (isset($_GET['approve'])) {

    $app = $_GET['approve'];
    $status = "approved";

    $query = "UPDATE appointments SET ";
    $query .= "app_status  = '{$status}' ";
    $query .= "WHERE app_id = $app ";

    $update_query = mysqli_query($conn, $query);
    if (!$update_query) {
        die("Query failed" . mysqli_error($conn));
    }
}

if (isset($_GET['decline'])) {

    $app = $_GET['decline'];
    $status = "declined";

    $query = "UPDATE appointments SET ";
    $query .= "app_status  = '{$status}' ";
    $query .= "WHERE app_id = $app ";

    $update_query = mysqli_query($conn, $query);
    if (!$update_query) {
        die("Query failed" . mysqli_error($conn));
    }
}

?>


    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-9">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Requests</h6>

                    </div>
                    <!-- Card Body -->

                    <div class="card-body">
                        <div class="row">
                            <?php

$sql = "SELECT * FROM appointments JOIN students ON students.stud_id = appointments.stud_id ORDER BY appointments.app_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $app_id = $row["app_id"];
        $full_names = $row["full_names"];
        $gender = $row["gender"];
        $reg_number = $row["reg_number"];
        $title = $row["title"];
        $description = $row["description"];
        $date = $row["date"];
        $app_status = $row["app_status"];
?>

                <div class="col-md-4 mt-2">
                    <div class="card">
                        <div class="card-header font-weight-bold">RefNo:00<?php echo $app_id; ?></div>
                        <div class="card-body">
                            <div class="mb-2 ng-binding font-weight-bold ">
                                <span class="text-dark">
                                <?php echo $full_names .' <b class="text-info">('. $gender .')</b>'; ?>
                                <br>
                                <p>(<?php echo $reg_number; ?>)</p> 
                            </div>
                            <hr>
                            <div class="mb-2 ng-binding">
                                <span class="font-weight-bold text-dark">Title :</span> <?php echo $title; ?>
                            </div>
                            <div class="mb-2 ng-binding bg-light">
                                <span class="font-weight-bold text-dark">Description :</span> <?php echo $description; ?>
                            </div>
                            <small class="text-muted text-info">Date: <?php echo $date; ?></small>
                                <br>

                            <div class="mb-2 ng-binding bg-light">
                                <p>
                                    <?php
                                    if($app_status === "approved"){
                                        echo "<p class='font-weight-bold text-success'>Appointment Status : $app_status</p>";
                                    }elseif($app_status === "declined"){
                                        echo "<p class='font-weight-bold text-danger'>Appointment Status : $app_status</p>";
                                    }
                                    else{
                                        echo "<p class='font-weight-bold text-warning'>Appointment Status : $app_status</p>";
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="mb-2 ng-binding bg-light">
                                <a href="appointments.php?approve=<?php echo $app_id ?>" class="btn btn-success">Approve</a>
                                <a href="appointments.php?decline=<?php echo $app_id ?>" class="btn btn-danger">Decline</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php include_once ('../includes/footer.php'); ?>