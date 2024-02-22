<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="icon" type="image/x-icon" href="images/favicon1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav">
            <li class="nav-item">
            <a class=" navbar-brand" href="welcome"><img src="images/home.png" style="width:40px; height:auto" alt="Home"></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" style="color:#E74E35; font-size:20px;" href="welcome"><b>Taskify</b></a>
            </li>
            </ul>
        <form class="d-flex">
            <a href="login" class="login"><button class="btn btn-light me-3 login" type="button">Login</button></a>
            <a href=""><button class="btn me-2" style="background-color:#E74E35; color:white;" type="button">Signup</button></a>
        </form>
        </div>
    </nav>
<div id="welcome"><br><br><br>
    <div class="container mt-5">
        <div class="shadow-lg p-4 mb-4 bg-white">
            <center><p class="h3">Sign Up</p></center>
            <div class="container mt-3"> 
                <div class="alert alert-danger" id="nameerror" style="display: none;"></div>
                <div class="alert alert-danger" id="emailerror" style="display: none;"></div>
                <div class="alert alert-danger" id="passworderror" style="display: none;"></div>
                <div class="alert alert-danger" id="cpassworderror" style="display: none;"></div>
                <div class="alert alert-danger" id="err" style="display: none;"></div>
                <div class="alert alert-danger" id="error" style="display: none;"></div>
                <form id="fsignup">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                        <label for="pwd">Password</label> <!--for:password-->
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="password" class="form-control" id="pwdd" placeholder="Re-enter password" name="confirm_password" required>
                        <label for="pwdd">Confirm Password</label> <!--confirm_password-->
                    </div>
                    <center><button type="submit" name="submit" class="btn" style="width:150px; background-color:#E74E35; color:white;">Sign Up</button><center>
                    <hr>
                    <p>Already have an account?&nbsp;<a href="login" class="login" style="text-decoration:none;color:#E74E35;">Login</a></p>
                </form>
            </div>
        </div>
    </div> 
</div>
<div id="a"></div> 

<script>
    $(document).ready(function(){

        $(".login").click(function(event){
            event.preventDefault();
            $("#welcome").hide();
            $("#a").load("login");

        });

        
        
        function validateEmail(email){
            if(email !== ''){
                return true;
            }else{
                $("#emailerror").show();
                $("#emailerror").html("Please enter your email");
                return false;
            }
        } 

        function validatePassword(password){
            if(password !== ''){
                var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                if (regex.test(password)){
                    return true;
                }else{
                $("#passworderror").show();
                $("#passworderror").html("Password must contain at least one lowercase letter, one uppercase letter, one digit, and be at least 8 characters long");
                return false;
                }
            }else{
                $("#passworderror").show();
                $("#passworderror").html("Please enter the password");
                return false;
            }
        } 

        function validateConfirmPassword(confirmPassword){
            if(confirmPassword !== ''){
                var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                if (regex.test(confirmPassword)){
                    return true;
                }else{
                    $("#cpassworderror").show();
                    $("#cpassworderror").html("Confirm Password must contain at least one lowercase letter, one uppercase letter, one digit, and be at least 8 characters long");
                    return false;
                }
            }else{
                $("#cpassworderror").show();
                $("#cpassworderror").html("Please enter the confirm password");
                return false;
            }
        } 

        function validateName(name){
        if(name !== ''){
            return true;
        }else{
            $("#nameerror").show();
            $("#nameerror").html("Please enter your name");
            return false;
        }
        }

        $("#fsignup").submit(function(event){
            event.preventDefault();

            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#pwd").val();
            var confirmPassword = $("#pwdd").val();

            var nameValid = validateName(name);
            var emailValid = validateEmail(email);
            var passwordValid = validatePassword(password);
            var confirmPasswordValid = validateConfirmPassword(confirmPassword);

            if (nameValid && emailValid && passwordValid && confirmPasswordValid && password === confirmPassword){
                var base_url = "<?php echo base_url(); ?>";
                var token = ''
                $.ajax({
                url: base_url + "ssignup",
                type: "POST",
                data: $("#fsignup").serialize(),
                success: function(response){
                    if(response.access_token){
                        token = response.access_token
                        localStorage.setItem("taski_fy_user_token",token);
                        $("#fsignup")[0].reset();
                        window.location.href = base_url + 'aflogin';
                    }else{
                        let message = response[0];
                        $("#error").show();
                        $("#error").html(message);
                    }   
                }
                });
            }else{
                $("#error").show();
                $("#error").html("Password doesn't match");
            }
        });     
    });
</script>
</body>
</html>