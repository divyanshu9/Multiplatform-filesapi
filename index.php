<?php
include('login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE HTML>
<html>
<head><title>Task</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
<link rel="stylesheet" href="customstyle.css">
<style></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"> </script>
</head>
<body>
<div class="container">
    <div class="card card-container">
    
    <button type="button" class="toggle lgn">Login</button>
        <button type="button" class="toggle sgn">Sign-Up</button>
    <hr><div class="togglable">
    <div id="signin">
        <form method="POST" action="login.php">
        <p>Username</p>
         <div  class="inner-addon left-addon"><i class="glyphicon glyphicon-user"></i>
        <input class="form-control" type="text" id="username" name="username"><br>
        </div>    
        <p>Password</p>
        <input class="form-control" type="password" id="password" name="password" placeholder="********"><br>
        <input class="btn btn-lg btn-success btn-block btn-signin" type="button" id="submit-login" value="submit">
        </form>
        <div style="text-align:center;"><span id="spansuccess"></span>
        <span id="spanerror"></span></div>
    </div>
    <div style="display:none;" id="signup">
        <form method="post" action="signup.php">
        <p>Username</p>
         <div  class="inner-addon left-addon"><i id="mainok" class="glyphicon glyphicon-user"></i>
        <input class="form-control" type="text" id="username" name="username"><br>
        </div> 
        <p>Email</p>
         <div  class="inner-addon left-addon"><i class="glyphicon glyphicon-envelope"></i>
        <input class="form-control" type="email" id="email" name="email"><br>
        </div>  
        <p>Password</p>
        <input class="form-control" type="password" id="password" name="pass1" placeholder="********"><br>
        <p>Confirm Password</p>
        <input class="form-control" type="password" id="password2" name="pass2" placeholder="********"><br>
        <input class="btn btn-lg btn-success btn-block btn-signin" type="button" id="submit-signup"  value="submit">
        </form>
        <div style="text-align:center;"><span id="spansuccess"></span>
        <span id="spanerror"></span></div>
    </div>
        </div>
        </div>
</div>    
<script type="application/javascript">
    $(document).ready(function(){
        $(document).on('click', '.sgn', function() {
            $("#signin").css("display","none");
            $("#signup").css("display","block");
            $(this).css({"cursor": "auto",background: "#fafafa"});
            $(".lgn").css({"cursor": "pointer",background: "#C2C7D0"});
        });
        $(document).on('click', '.lgn', function() {
            $("#signup").css("display","none");
            $("#signin").css("display","block");
            $(this).css({"cursor": "auto",background: "#fafafa"});
            $(".sgn").css({"cursor": "pointer",background: "#C2C7D0"});
        });
        $(document).on('click', '#submit-login', function() {
           var request = new XMLHttpRequest();
            if(request == null)
                alert('error in creating request object');
            var username = $("#signin").find("#username").val();
            var password = $("#signin").find("#password").val();
            if(username != '' && password != '')
                {
                    var url = "login.php?username=" + username + "&password=" + password;
                    request.open('POST',url,true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    request.onreadystatechange = updatePage;
                    request.send(url);
                }
            else {
                $("#signin").find("#spanerror").html(' Fields empty ');
            }
            function updatePage() {
                if(request.readyState==4)
                    if(request.status==200)
                        {
                            var response = JSON.parse(request.response);
                            console.log(response);
                            if(response.Response=="False") {
                                $("#signin").find("#spanerror").html(response.error);
                                $("#signin").find('form')[0].reset();
                            }
                            else if(response.Response=="True") {
                                $("#submit-login").attr("value",' Signing In ... ');
                                window.location = "profile.php";
                            }
                        }
            }
            
        });
        $(document).on('click', '#submit-signup', function() {
           var request = new XMLHttpRequest();
            if(request == null)
                alert('error in creating request object');
            var username = $("#signup").find('#username').val();
            var password = $("#signup").find("#password").val();
            var password2 = $("#signup").find("#password2").val();
            var email = $("#signup").find("#email").val();
            if(username != '' && password != '' && email != '')
                {
                    if(password==password2) {
                        var url = "signup.php?username=" + username + "&password=" + password + "&email=" + email;
                        request.open('POST',url,true);
                        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        request.onreadystatechange = updatePage;
                        request.send(url);
                    }
                    else
                        $("#signup").find("#spanerror").html(' Password Mismatch ');
                }
            else {
                $("#signup").find("#spanerror").html(' Fields empty ');
            }
            function updatePage() {
                if(request.readyState==4)
                    if(request.status==200)
                        {
                            var response = JSON.parse(request.response);
                            console.log(response);
                            if(response.Response=="False") {
                                $("#signup").find("#spanerror").html(response.error);
                                //$("#signup").find('form')[0].reset();
                            }
                            else if(response.Response=="True") {
                                $("#submit-signup").attr("value",' Creating Account... ');
                                $("#signup").find("#spanerror").html("");
                                var newc = '<br><p>'+response.success +' Click <a href="index.php">here to login</a></p>';
                                $("#signup").find("#spansuccess").replaceWith(newc);
                            }
                             
                        }
                    }   
            
        });
        
    });
    </script>
</body>
</html>