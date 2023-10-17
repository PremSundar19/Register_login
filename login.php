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
    $email = $_POST['email']; 
    $password = $_POST['password'];
    
    

    $conn = mysqli_connect("localhost", "root", "", "crudphp");

    $query = "SELECT * FROM register WHERE email = '$email'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $storedHashedPassword = $row['password'];
        if (password_verify($password, $storedHashedPassword)) {
           if($row['status'] === "approved"){
               header("Location: Lander.html");
               exit;
           }else{
               $loginError =  "Your account is pending approval or has been rejected by the admin.";
           }
        } else {
            $loginError = "Incorrect password. Please try again.";
        }
    } else {
        $loginError = "Please register or check your email.";
    }
}
?>
    <div class="container">
       <div class="row justify-content-center">
         <div class="col-md-6">
                    <h2>Login Here</h2>
                    <?php if (isset($loginError)) { ?>
                       <div class="alert alert-danger"><?php echo $loginError; ?></div>
                    <?php } ?>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  oninput="validateEmail(this)" required>
                            <small class="text-danger" id="emailError"></small>
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
