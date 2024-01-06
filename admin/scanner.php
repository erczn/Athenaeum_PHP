<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type = "text/javascript" src = "js/instascan.min.js"></script>
    <script type = "text/javascript" src = "js/vue.min.js"></script>
    <script type = "text/javascript" src = "js/adapter.min.js"></script>
    <script type = "text/javascript" src = "js/jquery.min.js"></script>
    <script type = "text/javascript" src = "js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link href="css/scan.css" rel="stylesheet" type="text/css" />
    
    <title>Athenaeun: QR Code Scanner</title>
    </head>
    <body>
        <main>
            <section class="glass">
                <div class="scanner">
                    <form action="scan-function.php" method="post" class="form-horizontal">
                        <h1>ATHENAEUM: QR Code</h1>
                        <input type="text" name="text" id="text" readonly="" placeholder="scan qr code" class="form-control" style = "display:none;">
                        <video id="preview" width="100%" ></video>
                        <div class="message">
                        <?php
                                if(isset($_SESSION['error'])){
                                    echo" 
                                        <div class='alert alert-danger alert-dismissible' id='myAlert'>
                                        <a href='#' class='close'>&times;</a>
                                        ".$_SESSION['error']."
                                        </div>
                                    ";
                                }
                                if(isset($_SESSION['success'])){
                                    echo "
                                        <audio autoplay src='beep.mp3'></audio>
                                        <div class='alert alert-success alert-dismissible' id='myAlert'>
                                        <a href='#' class='close'>&times;</a>
                                        ".$_SESSION['success']."
                                        </div>
                                        ";
                                }
                                
                            ?>
                        </div>
                    </form>
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
                        document.getElementById('text').value=c;
                        document.forms[0].submit();
                        
                    });
                </script>  
            </section>
            <div class="box1">            </div>
            <div class="box2">            </div>
            
        </main>
        <!--script for close pop up message-->
        <script>
            $(document).ready(function(){
                $(".close").click(function(){
                    $("#myAlert").alert("close");
                });
            });
        </script>

    </body>

</html>