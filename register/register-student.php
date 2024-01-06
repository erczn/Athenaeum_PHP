<?php
    require("phpqrcode/qrlib.php");
    require("connection.php");
    require_once __DIR__ . '/connection.php';

    $id_error = "";
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
            <form action="" method="post" class="form-vertical">
                <!-- Input boxes for the login form -->
                <div class = "input-box">
                    <select name="type" onchange="if (this.value) window.location.href=this.value">
                        <option value="#">Student</option>
                        <option value="register-faculty.php">Faculty</option>
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
                    <select name="course" required>
                        <option selected disabled>Choose a program</option>
                        <option value = "BSCS">Bachelor of Science in Computer Science</option>  
                        <option value = "BSIT">Bachelor of Science in Information Technology</option>  
                        <option value = "BSPYSCH">Bachelor of Science in Psychology</option>  
                        <option value = "BSOA">Bachelor of Science in Office Administration</option>  
                        <option value = "BSCRIM">Bachelor of Science in Criminology</option>
                        <option value = "BSBA">Bachelor of Science in Business Administration</option>  
                        <option value = "BSHM">Bachelor of Science in Hospitality Management</option>
                        <optgroup label="Bachelor of Science in Industrial Technology" >
                            <option class="major" value = "BSIT Major in Electronics Technology">BSIT Major in Electronics Technology</option>
                            <option class="major" value = "BSIT Major in Electrical Technology">BSIT Major in Electrical Technology</option>
                            <option class="major" value = "BSIT Major in Automotive Technology">BSIT Major in Automotive Technology</option>
                            <option class="major" value = "BSIT Major in Drafting Technology">BSIT Major in Drafting Technology</option>
                            <option class="major" value = "BSIT Major in Food Technology">BSIT Major in Food Technology</option>
                            <optgroup label="Bachelor of Science Technology and Livelihood Education">
                                <option class="major" value = "BSTLE Major in Home Economics">BSTLE Major in Home Economics</option>
                            </optgroup>
                        </optgroup>
                        <optgroup label="Graduate Program">
                            <option value="MBA">Master of Business Administration</option>
                            <option value="MAED">Master of Arts in Education</option>
                            <option value="EDD">Doctor of Education</option>
                            <option value="PROFED">Professional Education</option>
                        </optgroup> 
                    </select>
                </div>
                <div class = "input-box">
                    <input type="password" name="password"  placeholder = "Password" required>
                </div>
                <div class = "input-box">
                    <label for="files" class ="cor">I.D picture <br></label>
                    <input type="file" id = "files" name="id_pic" onchange="pressed()" accept="image/png, image/jpeg, image/jpg" required>
                </div>
                <div class = "input-box">
                    <label for="files" class ="cor">C.O.R <br></label>
                    <input type="file" id = "files"name="cor" onchange="pressed()" accept="image/png, image/jpeg, image/jpg" required>
                </div>
                
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
                <p><?php echo $id_error;?></p>
            </form>
        </div>
    </main>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //INPUTS
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $course = $_POST['course'];
            $pass = $_POST['password'];
            $id_pic = file_get_contents($_FILES['id_pic']['tmp_name']);
            $cor = file_get_contents($_FILES['cor']['tmp_name']);

            $sql = "SELECT * FROM ecclms.user WHERE id_number = '$id'";
            $query = $conn->query($sql);

            if($query !== false && $query -> num_rows > 0){
                $id_error = "Faculty ID already exist.";
            }
            else{
                //type
                $type = "student";

                //generate qt code
                $path = 'qrImages/';
                $file = $path.$id.".png";
                QRcode::png($id, $file);
                // success!

                $qr = file_get_contents('qrImages/'.$file);

                //save to user_info db
                $sql = "INSERT INTO ecclms.user (type, id_number, name, email, course, id_pic, password, qr, cor)
                VALUES('$type','$id_number', '$name', '$email', '$course', '$id_pic', '$password', '$qr', '$cor')";
                $query = $conn->query($sql);
                if ($query) {
                    header("Location: ../user/index.php");
                    $conn->close();
                }
            }
        }
    ?>
</body>
</html>