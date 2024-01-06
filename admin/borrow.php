<?php
    include("connection.php");
    $sql = "SELECT * FROM book";
    $result = mysqli_query($conn, $sql) or die("Error " . mysqli_error($conn));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Book Borrowing</title>

    <!-- Style -->
    <link href="css/book_borrowing.css" rel="stylesheet" type="text/css"/>

    <script type = "text/javascript" src = "js/instascan.min.js"></script>
    
    <link href="book_borrowing.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<main>
    <div class = "glass">
        <div class = "side-bar">
            <h2>Student Information</h2>
        <!--
            <?php
                //echo "<img src='".$user_data['user_picture']."' class='qr-img'>";
            ?>
            -->
            <form action="borrow_function.php" method = "POST" class="form">
                <div class = "fields">
                    <span class="label">Student number: </span>
                    <input type="text" name="id" readonly = "" id = "id">
                </div>
                <div class="fields">
                    <span class="label">Title: </span>
                    <input list="books" name="book" autocomplete="off">
                    <datalist id="books">
                    <?php while($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></option>
                    <?php } ?>
                    </datalist>
                    <?php mysqli_close($conn); ?>

                </div>
                
                
                <div class = "btns">
                    
                    <input type="submit" value="Save" id = "save">

                    <input type="reset" value="Clear" id = "clear">

                </div>
            </form>

        </div>
        <div class = "scanner">
            <span class="title">BOOK BORROWING</span>
            <br>
            <video id="preview" width="100%" ></video>
                <div class="message">
                    <?php
                        if(isset($_SESSION['error'])){
                            echo" 
                                <div class='alert alert-danger alert-dismissible' id='myAlert'>
                                <a href='#' class='close'>&times;</a>
                                ".$_SESSION['error']."
                                </div>";
                                }
                        if(isset($_SESSION['transaction_success'])){
                            echo "
                                <div class='alert alert-success alert-dismissible' id='myAlert'>
                                <a href='#' class='close'>&times;</a>
                                ".$_SESSION['transaction_success']."
                                </div>";
                                }            
                    ?>
                </div>
        </div>
        <script>
                let scanner = new Instascan.Scanner({video: document.getElementById('preview')})
                Instascan.Camera.getCameras().then(function(cameras){
                    if(cameras.length > 0){
                        scanner.start(cameras[0]);
                    } else{
                        alert("No Camera Found!")
                    }
                }).catch(function(e){
                    console.error(e)
                    ;});

                scanner.addListener('scan', function(c){
                    document.getElementById('id').value=c;
                    document.forms[0].read();
                    
                });
            </script>
            <script>
                $(document).ready(function(){
                    $(".close").click(function(){
                        $("#myAlert").alert("close");
                    });
                });
            </script>
    </div>
    </main>
</body>
</html>