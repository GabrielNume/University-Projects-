<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   <link rel="stylesheet" href="./app.css" />
   <link rel="stylesheet" href="./sigin.css" />
    
    
</head>

<body class="ba">
    <?php
    require_once "./header.php"
    ?>

    <?php
    $errors = $_GET;
    if (!empty($errors)) {
        echo "<br><br>";
        foreach ($errors as $error) {
            echo "<p style=color:white;>$error</p>";
        }
    }
    ?>
   
    <div class="box admin_center">
	<form action="./sigin_A.php" method="post">
		<span class="text-center">Sign-in</span>

        <div class="input-container">
		<input type="text " name="nume" autocomplete="off"  >
		<label>Name</label>		
	</div>
        
	<div class="input-container">
		<input type="text " name="email" autocomplete="off"  >
		<label>Email</label>		
	</div>
	<div class="input-container">		
		<input type="Password" name="parola"  autocomplete="off" >
		<label>Password</label>
	</div>
   
		<input type="submit" class="btn"  name="submit" value="Sign-in">
      
        
</form>	
</div>
   

    <?php
    require_once "./footer.php";
    ?>



</body>

</html>