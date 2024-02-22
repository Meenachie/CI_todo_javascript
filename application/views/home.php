<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskify</title>
    <link rel="icon" type="image/x-icon" href="images/favicon1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class=" navbar-brand" href=""><img src="images/home.png" style="width:40px; height:auto" alt="Home"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#E74E35; font-size:20px;" href=""><b>Taskify</b></a>
            </li>
            </ul>
            <form class="d-flex" action="<?php echo base_url('logout');?>" method="post">
                <button class="btn me-3 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#myModal" style="background-color:#E74E35; color:white; width:200px" type="button">Create New Task &nbsp&nbsp<img src="images/plus.png" style="width:15px; height:auto;" ></button>
                <div class="dropdown">
                <button type="button" class="btn" style="border:none" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/user.png" style="width:30px; height:auto" alt="user">
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="profile" id="profile">Profile</a></li>
                    <li><a class="dropdown-item" href="change_password" id='changePassword'>Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><input class="dropdown-item"  id="logout" type="submit" name="logout" value="Log Out"></li>
                </ul>
                </div>
            </form>
        </div>
    </nav><br><br><p></p><br><br>
    <div class="modal fade" id="myModal">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header border-0">
            <h4 class="modal-title">To Do</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="model-body">
            <form id="ftask">
            <textarea type="text" class="form-control" id="task" placeholder="new task" name="task" style="height: 100px;"></textarea>
            
        </div>
        <div class="modal-footer border-0">
            <button class="btn btn-danger" type="submit" name="add" style="background-color:#E74E35; color:white;">Add task</button>
        </div>
        <form>
    </div>
    </div>
    </div>

    <div class="container-fluid">
        <center><p class="h1" style="color:#E74E35;"> To Doo </p></center>
    </div>
    <div class="container" id="ttask">
        <table class="table mt-5">
        <thead>
            <tr>
            <th scope="col">S.No</th>
            <th scope="col">Task</th>
            <th scope="col">Status</th>
            <th scope="col">Created On</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody id="results">
        </tbody>
        </table>
    </div><br>
    <center><h4 id="notask" style="display: none;"></h4></center>

<script>

    function editTask(id){
        //console.log(id)
        window.location.href = 'bfedit/' + id;
    }

    function deleteTask(id) {
        //console.log(id)
        let token = localStorage.getItem("taski_fy_user_token");
        $.ajax({
            url: 'sdelete/' + id,
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer '+ token
            },
            success: function(response) {
                getAllTasks();
            },
            error: function(xhr, status, error) {
                alert("Error deleting item: " + xhr.responseText);
            }
        });
    }

    //create a ajax call to get all tasks and send the token along with it
    function getAllTasks()
    {
        let token = localStorage.getItem("taski_fy_user_token");
        let dataDisplay = '<tr>';
        var values = ''
        $.ajax({
            url: 'sread',
            type: 'GET',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer '+ token
            },
            success: function (result) {
                if(result.length > 0) { var a=1;
                    $("#notask").hide();
                    $("#ttask").show();
                    for(var i = 0; i < result.length; i++) {
                        values += '<tr>';
                        values += '<td>&nbsp&nbsp'+ a +'</td>';
                        values += '<td>'+result[i]['task']+'</td>';
                        values += '<td>'+result[i]['status']+'</td>';
                        values += '<td>'+result[i]['created_on']+'</td>';
                        values += "<td>&nbsp&nbsp&nbsp<a onclick='editTask(" + result[i]['id'] + ");'><img src='images/edit.png'></a></td>";
                        values += "<td>&nbsp&nbsp&nbsp<a onclick='deleteTask(" + result[i]['id'] + ");' id='del'><img src='images/del.png'></a></td>";
                        values += '</tr>';
                        a++; 
                    }
                    
                    document.getElementById('results').innerHTML = values;
                        
                }
                else{
                    $("#ttask").hide();
                    $("#notask").show();
                    $("#notask").text("No tasks found!! Start creating your tasks")
                    console.log('no tasks found');
                }
            },
            error: function (error) {
                console.log(result)
            }
        });
    }

    
    $(document).ready(function(){
            
        getAllTasks();

        $('.dropdown-item').on('mousedown', function(){
            $(this).css('background-color', '#E74E35');
        });

        $("#ftask").submit(function(event){
            event.preventDefault();
            let token = localStorage.getItem("taski_fy_user_token");
            $.ajax({
            url: "screate",
            type: "POST",
            data: $("#ftask").serialize(),
            headers: {
                'Authorization': 'Bearer '+ token
            },
            success: function(response){
                if(response){
                    $("#ftask")[0].reset();
                    $("#myModal").modal('hide');
                    getAllTasks();
                }else{
                    alert("Failed, Try again!!");
                }   
            }
            });
        });

        $("#profile").click(function(event){
            event.preventDefault();
            var base_url = "<?php echo base_url(); ?>";
            window.location.href = base_url + 'vprofile';
        });

        $("#changePassword").click(function(event){
            event.preventDefault();
            var base_url = "<?php echo base_url(); ?>";
            window.location.href = base_url + 'vchange_password';
        });

        $("#logout").click(function(event){
        event.preventDefault();
        var base_url = "<?php echo base_url(); ?>";
        localStorage.removeItem("taski_fy_user_token");
        window.location.href = base_url + 'welcome';
        });

        if (!localStorage.getItem('taski_fy_user_token')){
            var base_url = "<?php echo base_url(); ?>";
            window.location.href = base_url + 'welcome'; 
        }
        
    });
</script>

</body>
</html>