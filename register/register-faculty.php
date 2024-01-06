<?php
    require("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athenaeum: Register</title>

    
    <!-- Style -->
    <link rel="stylesheet" href="css/register.css?v=<?php echo time(); ?>"/>
    
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
            
            <h2>REGISTER</h2>

            <!-- This form is for login system -->
            <form class="form-vertical">
                <!-- Input boxes for the login form -->
                <div class = "input-box">
                    <select name="type" onchange="if (this.value) window.location.href=this.value">
                        <option value="register-student.php">Student</option>
                        <option selected disabled value="#">Faculty</option>
                    </select>
                </div>
                <div class = "input-box">
                    <input type="text" name="id"  placeholder = "I.D. Number" required>
                </div>
                <div class = "input-box">
                    <input type="text" name="name"  placeholder = "Name" required>
                </div>
                <div class = "input-box">
                    <input type="text" name="email"  placeholder = "Email" required>
                </div>
                <div class = "input-box">
                    <input type="password" name="password"  placeholder = "Password" required>
                </div>
                <div class = "input-box">
                    <label for="files" class ="cor">I.D picture <br></label>
                    <input type="file" id = "files"name="student_cor" onchange="pressed()" accept="image/png, image/jpeg, image/jpg" required>
                </div>
            </form>
            <div class = "button">
                <input type="submit" value="Register" id="button">
            </div>
            <div class="terms">
                <p>By creating an account, you agree to our <a class="terms" href="terms.html">Terms</a></p>
            </div>
            <div class = "reg_btn">
                <span class = "details">
                    Already hava an account?
                </span>
                <a href="../index.php">Login</a>
            </div>
        </div>
    <?php
        
    ?>
</body>
</html>