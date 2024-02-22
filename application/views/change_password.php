<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
    <link rel="icon" type="image/x-icon" href="images/favicon1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class=" navbar-brand home" href="home"><img src="images/home.png" style="width:40px; height:auto" alt="Home"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link home" style="color:#E74E35; font-size:20px;" href="home"><b>Taskify</b></a>
            </li>
            </ul>
        </div>
    </nav><br><br><p></p><br>
    <div class="container mt-5">
    <div class="alert alert-success" id="message" style="display: none;"></div>
    <div class="shadow-lg p-4 mb-4 bg-white">
    <center><p class="h3">Change Password</p></center>
    <div class="container mt-3">
    <form id="fpwd">
    <div class="form-floating mt-3 mb-3">
      <input type="password" class="form-control" id="oldpwd" placeholder="Old password" name="oldpwd">
      <label for="oldpwd">Old Password</label>
      <small class="text-danger"></small>
    </div>
    <div class="form-floating mt-3 mb-3">
      <input type="password" class="form-control" id="newpwd" placeholder="New password" name="newpwd">
      <label for="newpwd">New Password</label>
      <small class="text-danger"></small>
    </div>
    <center><button type="submit" name="submit" class="btn" style="width: 150px; background-color:#E74E35; color:white;">Submit</button><center>
    </form>
    </div>
  </div>
</div>    

<script>

  $(document).ready(function(){

    $("#fpwd").submit(function(event){
      
      event.preventDefault();
      let token = localStorage.getItem("taski_fy_user_token");
      var base_url = "<?php echo base_url(); ?>";
      var formData = $('#fpwd').serializeArray(); 
      var jsonData = {};
      $.each(formData, function(index, field){
          jsonData[field.name] = field.value;
      });
      $.ajax({
      url: base_url +"schange_pwd",
      type: "PUT",
      contentType: 'application/json',
      data: JSON.stringify(jsonData),
      headers: {
        'Authorization': 'Bearer '+ token
      },
      success: function(response){
        $("#fpwd")[0].reset();
        $('#message').show();
        $('#message').text('Password Updated Successfully');   
      },
      error: function(xhr, status, error) {
      console.log(xhr.responseText);
      $('#message').show(); 
      $('#message').text('Old Password is wrong');
    }
      });
    });

    $(".home").click(function(event){
    var base_url = "<?php echo base_url(); ?>";
    event.preventDefault();
    window.location.href = base_url + 'aflogin';
    });

    if (!localStorage.getItem('taski_fy_user_token')){
      var base_url = "<?php echo base_url(); ?>";
      window.location.href = base_url + 'welcome'; 
    }

  });
</script>
</body>
</html>