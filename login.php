<?php
include('connection.php');
use Google\Cloud\Translate\V3\TranslateClient;
$csrf		=	$connect->real_escape_string($_POST["csrf"]);

if ($csrf == $_SESSION["token"]) {
	$username	= $connect->real_escape_string($_POST['username']);
	$password	= $connect->real_escape_string($_POST['password']);

	
	/* Check Username and Password */
	$query		= db_query("select * from google_auth where (email='".$username."' or username='".$username."') and password='".$password."' ");	

	$resuser = mysqli_num_rows($query);
	if($resuser > 0){
		$row = mysqli_fetch_array($query);
		$_SESSION['email'] 	= $row['email'];
		$_SESSION['secret'] = $row['googlecode'];
		
		header('Location:device_confirmations2.php');
		exit();
	}else{
		$msg="Invalid Username or Password";												
		header('Location:login.php?error=1');
		exit();
	}
	
}

/* print message */
$msg = $connect->real_escape_string($_GET["error"]);
if($msg == 1){ $strmsg = "Invalid Username or Password"; }


?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inicio de Sesion</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/layout.css">
        <link rel="stylesheet" href="assets/css/form-design.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">  
</head>
    <body class="a2z-wrapper">
        
        <!--Start a2z-area-->
        <section class="a2z-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <div class="form-area login-form">
							 
                            <div class="form-input">
                                <h2>Inicio de sesion </h2>
								<span class="error"><?php print $strmsg; ?></span>
                                <form name="reg" action="login.php" method="POST">
								<input type="hidden" name="csrf" 	 value="<?php print $_SESSION["token"]; ?>" >
								<input type="hidden" name="passcode" value="<?php echo $passcode; ?>" >
                                    <div class="form-group">
										<input type="text" name="username" id="username" autocomplete="off" value="" required>
                                        <label>Correo electronico o usuario</label>
                                    </div>
                                    <div class="form-group">
										<input type="password" name="password" id="password" autocomplete="off" value="" required>
                                        <label>Contraseña</label>
                                    </div>
                                    <div class="a2z-button">
                                        <button class="a2z-btn">Ingresar</button>
                                    </div>
									
									 <div class="form-text text-right">
                                        <a href="register.php">Crear cuenta </a>
                                    </div>
									
                                </form>
                            </div>
							<div class="form-content">
                                <ul>
                                    
										<img src="https://imagenes.atwti.com/nube.png"  height="300" width="300">
									  
									 
									 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--End a2z-area-->
        <!-- jquery  -->
        <script src="assets/js/jquery-1.12.4.min.js"></script>
        <!-- Bootstrap js  -->
        <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>