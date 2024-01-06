<?php
    require("connection.php");  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATHENAEUM: ECC Library Management Sysytem</title>
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" media="all" type="text/css"/>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!--Athenaeum logo-->
    <img src="images/athen-logo-new.png" alt="" class="athen-logo">
    
    <!-- This div is for glass effect of form -->
    <div class="glass">

        <!-- This form is for login system -->
        <form action="" method="post" class="form-vertical">

            <!-- Input boxes for the login form -->
            <div class = "input-box">
                <input type="text" name="id"  placeholder = "I.D. Number" required>
            </div>
            <div class = "input-box">
                <input type="password" name="password"  placeholder = "Password" required>
            </div>

            <!-- Login and register button -->
            <div class = "button">
                <input type="submit" value="Login" id="button">
            </div>
            <div class = "reg_btn">
                <span class = "details">
                    New to ATHENAEUM?
                </span>
                <a href="register/register-student.php">Create an account</a>
            </div>

        </form>
    </div>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id = $_POST['id'];
            $password = $_POST['password'];

            // Selecting sql database for users
            $sql = "SELECT * FROM ecclms.user WHERE id_number = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $pass = $row['password'];
            $type = $row['type'];
            if(strcasecmp($pass,$type)==0 && !empty($id) && !empty($password)){
                //echo "Login Successful";
                $_SESSION['id']=$id;
        
                if($type=='admin'){
                    header('location:admin/index.php');
                }
                elseif($type=="faculty"){
                    header('location:faculty/index.php');
                }
                else{
                    header('location:student/index.php');
                }
            }
            else{
                echo "<script type='text/javascript'>alert('Failed to Login! Incorrect ID number or Password')</script>";
            }
            
        }
    ?>
</body>
</html>