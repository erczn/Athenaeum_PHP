<?php
    require("connection.php");
    
    $text = $_POST['text'];
    $date = date('Y-m-d');
    //$voice = new com("SAPI.SpVoice");

if (isset($_POST['text'])) {

    $sql = "SELECT * FROM user WHERE id_number = '$text'";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        $sql = "SELECT * FROM logins WHERE id_number = '$text' AND log_date = '$date' AND STATUS = '0'";
            $query = $conn->query($sql);
            
            //time out
            if($query->num_rows>0){
                $sql = "UPDATE logins SET time_out = NOW(), STATUS = 1 WHERE id_number = '$text' AND log_date = '$date' AND STATUS = '0'";
                $query = $conn->query($sql);
                $_SESSION['success'] = "Time out Successfully!";
                
                //$voice->speak("Time Out Successfully!");
            } else{ //time in
                $sql = "INSERT INTO logins(id_number,time_in,log_date, STATUS) VALUES('$text', NOW() , '$date', '0')";
                if($conn->query($sql) == TRUE){
                    
                    $_SESSION['success'] = "Attendance added Successfully!";
                    
                    //$voice->speak("Attendance added Successfully!");
                }else {
                    $_SESSION['fail'] = $conn->error;
                }
            }        

    }else{
        $_SESSION['invalid'] = $conn->error;
        //$voice->speak("Invalid QR code!");
    }
} 
else{
    $_SESSION['fail'] = "Please scan your QR code";
}
header("Location: scanner.php");
$conn->close();
?>