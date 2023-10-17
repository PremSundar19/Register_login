<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php
       if(isset($_POST['sumbit'])){

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $phone = intval($_POST["phone"]);
            $gender = $_POST["gender"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $Password2 = $_POST["confirmPassword"];
            $hashedConfrimPassword = password_hash($Password2, PASSWORD_BCRYPT);

            $conn = mysqli_connect("localhost","root","","crudphp");
            $sql = "INSERT INTO register  (first_name, last_name, email,phone, gender, address, password, confirm_Password)  VALUES('$firstname','$lastname','$email',$phone,'$gender','$address','$hashedPassword','$hashedConfrimPassword');";
            if(mysqli_query($conn,$sql)){
            header("refresh:3; url=login.php");
             echo "Registered successfully";
            exit;
            }else{
                echo "Something went wrong";
            }            
       }
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 style="color: green;">Register Here</h2>
                    <form action="register.php" method="post" onsubmit="return validateForm();">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" oninput="validateFirstName(this);" required>
                                <small class="text-danger" id="fnameError"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" oninput="validateLastName(this);" required>
                                <small class="text-danger" id="lnameError"></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  oninput="validateEmail(this)" required>
                            <small class="text-danger" id="emailError"></small>
                        </div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="row mb-3">
                                <div class="col-md-2">
                                <input type="text" class="form-control" id="code" name="code" value="+91" readonly>
                        </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="phone" name="phone" pattern="[6-9][0-9]{9}" oninput="validatePhone(this);" maxlength="10" required>
                                <small class="text-danger" id="phoneError"></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label><br>
                            <input type="radio" id="male" name="gender" value="male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female" required>
                            <label for="female">Female</label>
                            <input type="radio" id="others" name="gender" value="others" required>
                            <label for="others">Others</label>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" oninput="validatePassword1();" required>
                            <small class="text-danger" id="passwordError"></small>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" oninput="validatePassword2();" required>
                            <small class="text-danger" id="confirmPasswordError"></small>
                        </div>
                        <input type="submit" name="sumbit" value="submit" class="btn btn-primary mb-2" >
                    </form>
                    <small id="errorpassword" class="text-danger"></small>
                </div>
            </div>
        </div>
        <script>
                    //first name validate
                    function validateFirstName(input){
                        var nameError = document.getElementById("fnameError");
                         var regex = /[0-9!@#$%^&*()_+{}\[\]:;|/='"<>,?~\\-]/;
                       if (regex.test(input.value)) {
                            nameError.innerText = "* Warning : number / symbol not allowed.";
                            input.value= input.value.replace(/[^A-Za-z]/g, '');
                           } else { 
                            nameError.innerText = "";
                        }
                    }
                     //last name validate
                    function validateLastName(input){
                        var nameError = document.getElementById("lnameError");
                         var regex = /[0-9!@#$%^&*()_+{}\[\]:;|/='"<>,.?~\\-]/;
                       if (regex.test(input.value)) {
                            nameError.innerText = "* Warning : number / symbol not allowed.";
                            input.value= input.value.replace(/[^A-Za-z]/g, '');
                           } else { 
                            nameError.innerText = "";
                        }
                    }
                    
                    //phone number validate
                    function validatePhone(input){
                        var regex = /[A-Za-z /!@#$%^&*()_+{}\[\]:;|/='"<>,.?~\\-]/;

                        // var phoneErr =  document.getElementById("phoneError");
                        var phone = input.value;
                        if(regex.test(input.value)){
                            input.value= input.value.replace(/[^0-9]/g, '');
                        }
                       if(phone >= 6000000000 && phone <= 9999999999){
                        phoneErr.textContent = "";
                       }else if(phone < 6000000000 || phone > 9999999999){
                        phoneErr.textContent = "*phone number should between 6000000000 - 9999999999";
                       }else if(phone < 0){
                        phoneErr.textContent = "* negative value not allowed";
                       }
                       
                    }

                    function validateForm() {
                        const password = document.getElementById("password").value;
                        const confirmPassword = document.getElementById("confirmPassword").value;

                        if (password !== confirmPassword) {
                            document.getElementById("passwordError").textContent = "Passwords does not matched.";
                            return false; 
                        } else {
                            document.getElementById("passwordError").textContent = "";
                            return true; 
                        }
                    }


                      function validatePassword1(){
                        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                        const password = document.getElementById("password").value;
                        if (password.match(passwordPattern)) { 
                            document.getElementById("passwordError").textContent = "";   
                            } else {
                                document.getElementById("passwordError").textContent = "*Password should contains one capital letter,one symbol,one number";
                            }
                      }
                      
                      function validatePassword2(){
                        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                        const password = document.getElementById("confirmPassword").value;
                        if (password.match(passwordPattern)) { 
                            document.getElementById("confirmPasswordError").textContent = "";   
                            } else {
                                document.getElementById("confirmPasswordError").textContent = "*Password should contains one capital letter,one symbol,one number";
                            }
                      }

                    //validating email
                    function validateEmail(input) {
                            const email = input.value;
                            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                            if (!emailPattern.test(email)) {
                                document.getElementById("emailError").textContent = "* Please enter a valid email address.";
                            } else {
                                document.getElementById("emailError").textContent = "";
                            }
                        }
                        
                     // validate salary
                     function validateSalary(input){
                        const salary = parseFloat(input.value);
                            if (isNaN(salary) || salary < 0) {
                                document.getElementById("salaryError").textContent = "* Salary must be a non-negative number.";
                                input.value =  "";
                            } else {
                                document.getElementById("salaryError").textContent = "";
                            }
                     }
        </script>        
</body>
</html>
