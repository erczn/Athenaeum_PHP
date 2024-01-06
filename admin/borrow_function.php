<?php
    include("connection.php");
    date_default_timezone_set('Asia/Singapore');
    $id_number = $_POST['id'];
    $date = date('Y-m-d h:i:s a');
    $book = $_POST['book'];

    if (isset($_POST['id'])) {

        $sql = "SELECT * FROM ecclms.user WHERE id_number = '$id_number'";
        $query = $conn->query($sql);
    
        if ($query->num_rows > 0) {
            $sql = "SELECT * FROM book_transaction WHERE id_number = '$id_number' AND STATUS = '0'";
            $query = $conn->query($sql);
            
            //time out
            if($query->num_rows>0){
                $sql = "UPDATE book_transaction SET Return_date = '$date' , STATUS = 1 WHERE Id_number = '$id_number' AND STATUS = '0'";
                $query = $conn->query($sql);
                $_SESSION['transaction_success'] = "Return Successfully!";
                
                //$voice->speak("Time Out Successfully!");
            } else{ //time in
                $sql = "INSERT INTO book_transaction(title, id_number, Borrowed_date, STATUS) VALUES('$book','$id_number', '$date', '0')";
                if($conn->query($sql) == TRUE){
                    
                    $_SESSION['transaction_success'] = "Borrow Successfully!";
                    
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
header("Location: book_borrowing.php");
$conn->close();
