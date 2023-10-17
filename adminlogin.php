<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  
<?php

if (isset($_POST['submit'])) {
    $demoEmail = "admin123@gmail.com";
    $demoPassword = "Admin@123";
    $email = $_POST['email']; 
    $password = $_POST['password'];


    // echo $demoEmail;
    // echo "<br>";
    // echo $email;
    // echo "<br>";
    // echo $demoPassword;
    // echo "<br>";
    // echo $password;


   
    if ($demoEmail === $email) {
        if ($password === $demoPassword) {
            header("Location:index.php");
            exit;
        } else {
            $loginError = "Incorrect password. Please try again.";
        }
    } else {
        $loginError = "Please register or check your email.";
    }
}
?>
 <div id="message" style="display: none;"><?php echo $msg;?></div>
    <div class="container">
       <div class="row justify-content-center">
         <div class="col-md-6">
                    <h2>Admin Login Here</h2>
                    <?php if (isset($loginError)) { ?>
                       <div class="alert alert-danger"><?php echo $loginError; ?></div>
                    <?php } ?>
                    <form action="adminlogin.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  oninput="validateEmail(this)" required>
                            <small class="text-danger" id="emailError"></small>
                            <small class="text-danger" id="emailError"><?php ?></small>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" oninput="validatePassword()" required>
                            <small class="text-danger" id="passwordError"></small>
                        </div>
                        <input type="submit" name="submit" value="submit" class="btn btn-primary mb-2" >
                    </form>
                </div>
         </div> 
    </div>  
    <script>
        function validatePassword(){
                        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                        const password = document.getElementById("password").value;
                        if (password.match(passwordPattern)) { 
                            document.getElementById("passwordError").textContent = "";   
                            } else {
                                document.getElementById("passwordError").textContent = "*Password should contains one capital letter,one symbol,one number";
                            }
                      }

                      function validateEmail(input) {
                            const email = input.value;
                            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                            if (!emailPattern.test(email)) {
                                document.getElementById("emailError").textContent = "* Please enter a valid email address.";
                            } else {
                                document.getElementById("emailError").textContent = "";
                            }
                        }
    </script> 
    </body>
</html>
