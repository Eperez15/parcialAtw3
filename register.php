<?php
include('connection.php');

$passcode	= $connect->real_escape_string($_POST["passcode"]);	
$csrf		= $connect->real_escape_string($_POST["csrf"]);

require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();



if ($csrf == $_SESSION["token"]) {
	$googlecode = $connect->real_escape_string($_POST['googlecode']);
	$fname 		= $connect->real_escape_string($_POST['fname']);
	$lname 		= $connect->real_escape_string($_POST['lname']);
	$email 		= $connect->real_escape_string($_POST['email']);		
	$username	= $connect->real_escape_string($_POST['username']);		
	$password	= $connect->real_escape_string($_POST['password']);

	$status 	= 1;
	
	/* Check IF Username or email used Before */
	$query		= db_query("select * from  google_auth where email='".$email."' or username='".$username."'");	
	$resuser = mysqli_num_rows($query);
	if($resuser > 0){
		header('Location:register.php?error=2');
		exit();
	}else{
		$mysql = db_query("insert into google_auth set	fname	= '".$fname."', 
														lname	= '".$lname."',
														email	= '".$email."',
														username	= '".$username."',
														password	= '".$password."',
														googlecode	= '".$googlecode."'");

		$_SESSION['email'] 	= $email;
		$_SESSION['secret'] = $googlecode;
		include_once ('mail.php');
		header('Location:device_confirmations.php');
		exit();
	}
	
}




?>

<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro</title>
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
                        <div class="form-area register-from">
                            <div class="form-content">
                                
                                
                                <ul>
                                    
										<h2>Registro</h2> <img src="https://imagenes.atwti.com/nube.png"  height="300" width="300">
									  
									 
									 
                                </ul>
                            </div>
                            <div class="form-input">
                                <h2>Registro</h2>
                                <form name="reg" action="register.php" method="POST">
								<input type="hidden" name="csrf" 	 value="<?php print $_SESSION["token"]; ?>" >
								<input type="hidden" name="googlecode" value="<?php echo $secret; ?>" >
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
												<input type="text" name="fname" autocomplete="off" id="fname" value="<?php echo $fname; ?>" required />
                                                <label>Nombre</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
												<input type="text" name="lname" id="lname" autocomplete="off" value="<?php echo $lname; ?>" required  />
                                                <label>Apellido</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
										<input type="email" name="email" id="email" autocomplete="off" value="<?php echo $email; ?>" required />
                                        <label>Correo Electronico</label>
                                    </div>
                                    <div class="form-group">
										<input type="text" name="username" id="username" autocomplete="off" value="" required>
                                        <label>Usuario</label>
                                    </div>
                                    <div class="form-group">
										<input type="password" name="password" id="password" autocomplete="off" value="" required>
                                        <label>Contraseña</label>
                                    </div>
                                    
                                    <div class="a2z-button">
                                        <button type="submit" class="a2z-btn">Crear cuenta</button>
                                    </div>
									<div class="form-text">
                                        <span>Ya tienes una cuenta?  <a href="login.php">Ingresar</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="assets/js/jquery-1.12.4.min.js"></script>
        <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>