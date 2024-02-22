<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update task</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('images/favicon1.png');?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class=" navbar-brand home" href="home"><img src="<?php echo base_url('images/home.png');?>" style="width:40px; height:auto" alt="Home"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link home" style="color:#E74E35; font-size:20px;" href="home"><b>Taskify</b></a>
            </li>
            </ul>
        </div>
    </nav><br><br><p></p><br><br>

    <div class="container-fluid">
        <form id="fupdate">
        <div class="container">
        <div class="row">
        <div class="col col-lg col-sm me-2">
            <label class="form-label" for="task" >Task</label>
            <textarea class= "form-control border-#adb5bd" id="task" name="task" style="width:320px;height:100px;"></textarea>
        </div>
        <div class="col col-lg col-sm">
            <label class="form-label" for="date" >Created On</label>
            <input type="text" class="form-control border-#adb5bd" id="date" name="datetime" style="width:250px;height:50px;" placeholder="" readonly>
        </div>
        <div class="col col-lg col-sm">
        <label class="form-label" for="dropdown">Status</label> 
        <select class="form-select" name="status" style="width:250px;height:50px;">
        <option id="status" value="" selected hidden></option>
        <option>Todo</option>
        <option>In Progress</option>
        <option>Completed</option>
        </select>
        </div>
        </div><br><br>
        <input type="submit" name="submit" class="btn" style="width: 150px; background-color:#E74E35; color:white;" value="Save changes">
        </div>
        </form>
    </div>
    

<script>
   
    $(document).ready(function(){
        function getTask(){
            let token = localStorage.getItem("taski_fy_user_token");
            let oldurl = window.location.href; // Get current URL
            let id = oldurl.substring(oldurl.lastIndexOf('/') + 1); // Extract ID from URL
            $.ajax({
                url: '/sreadtask/' + id,
                type: 'GET',
                contentType: 'application/json',
                headers: {
                    'Authorization': 'Bearer '+ token
                },
                success: function(result){
                    var task = result[0]['task'];
                    var addtask = $('#task');
                    addtask.text(task);
                    
                    var status = result[0]['status'];
                    var addstatus = $('#status');
                    addstatus.text(status);
                    addstatus.val(status);

                    var created_on = result[0]['created_on'];
                    var addtime = $('#date');
                    addtime.attr('placeholder', created_on);
                    
                },
                error: function (error) {
                    console.log(result)
                }
            });
            
        }
        getTask();

        $("#fupdate").submit(function(event){
            event.preventDefault();
            let token = localStorage.getItem("taski_fy_user_token");
            let oldurl = window.location.href; 
            let id = oldurl.substring(oldurl.lastIndexOf('/') + 1);
            var base_url = "<?php echo base_url(); ?>";
            
            var formData = $('#fupdate').serializeArray(); 
            var jsonData = {};
            $.each(formData, function(index, field){
                jsonData[field.name] = field.value;
            });
            
            $.ajax({
                url: '/supdate/' + id,
                type: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify(jsonData),
                headers: {
                    'Authorization': 'Bearer '+ token
                },
                success: function(result){
                    window.location.href = base_url + 'aflogin';
                },
                error: function (error) {
                    console.log(result)
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