<?php
    //check if the user is login
    function checkLogin($conn){
        if(isset($_SESSION['id_number'])){

            $id = $_SESSION['id_number'];
            $sql = "SELECT * FROM users WHERE id_number = '$id' ";
            $query = $conn->query($sql);

            if($query->num_rows>0){
                $user_data = $query->fetch_assoc(); 
                return $user_data;
            }
        } 
    }