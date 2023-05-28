<?php
include 'db_connect.php';
session_start();

function user_exist($email) {
    include 'db_connect.php';

    $get_user_by_email = mysqli_query($conn, "SELECT * FROM users WHERE username='".$email."' ORDER BY id DESC LIMIT 1"); 
    if (mysqli_num_rows($get_user_by_email) > 0) {
      return true;
    } 
    return false;
}

if ($_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
    $csvFile = $_FILES['csv_file']['tmp_name'];

    try{
        // Read the CSV file
        $data = [];
        if (($handle = fopen($csvFile, "r")) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }

        // Display the CSV data in an HTML table
        $counter = 0;
        foreach ($data as $index=>$row) {
            if($index != 0){
                $user_exist = user_exist($row[6]);

                if(!$user_exist){
                    mysqli_query($conn,"INSERT INTO alumnus_bio(firstname,middlename,lastname,gender,batch,course_id,email,connected_to,status, date_created, avatar) 
                    VALUES('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','1','".date("Y-m-d")."', '1602730260_avatar.jpg')");

                    $last_inserted_id = mysqli_insert_id($conn);
                    $full_name = $row[0]." ".$row[1];
                    mysqli_query($conn,"INSERT INTO users (name,username,password,type,alumnus_id, auto_generated_pass) VALUEs('".$full_name."','".$row[6]."','".md5($row[7])."','3','".$last_inserted_id."', '')");
                    
                    $counter++;
                }
            }
        }
        
    $_SESSION['num_entries'] = $counter;
    }catch(Exception $e) {
        $_SESSION['error'] = 1;
    }
    header('Location: index.php?page=approved_alumni');

} else {
    echo 'Error uploading the CSV file.';
}
?>