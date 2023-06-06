<?php 
    include('../db_connect.php');
    session_start();

    // add officer
    if(isset($_POST['add_officer'])){
        $officers_query = mysqli_query($conn, "SELECT * FROM batch_officers WHERE alumnus_id = '".$_POST["alumnus_id"]."'");
        $officer = mysqli_fetch_assoc($officers_query);

        if (!$officer){
            $position_query = mysqli_query($conn, "SELECT * FROM batch_officers WHERE batch = '".$_POST["batch"]."' and position = '".$_POST["position"]."'");
            $position = mysqli_fetch_assoc($position_query);

            if (!$position){
                $query = "INSERT INTO batch_officers (batch, position, alumnus_id) VALUES('".$_POST['batch']."','".$_POST['position']."','".$_POST['alumnus_id']."')";
                mysqli_query($conn, $query);
                $_SESSION['add_officer'] = true;
                $_SESSION['add_officer_message'] = " Officer added successfully!";
            }else{
                $_SESSION['add_officer_error'] = true;
                $_SESSION['add_officer_error_message'] = "Selected position for that batch is already filled up!";
            }
        }else{
            $_SESSION['add_officer_error'] = true;
            $_SESSION['add_officer_error_message'] = "Selected alumnus is already an officer!";
        } 
    }

    // delete officer
    if(isset($_GET['delete_officer'])){
        $query = "DELETE from batch_officers WHERE id = '".$_GET["delete_officer"]."'";
        mysqli_query($conn, $query);
        $_SESSION['delete_officer'] = true;
        $_SESSION['delete_officer_message'] = " Officer deleted successfully!";

    }

    header('Location: ../index.php?page=batch_officers');
?>