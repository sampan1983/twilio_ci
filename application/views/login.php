<!DOCTYPE html>

<html>

<head>

  <title>SMS Login</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>csss/style.css">

  <link href="<?php echo base_url(); ?>vendors/css/toastr.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

  <script src="https://kit.fontawesome.com/a81368914c.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>

/*  .divclass{



  }

  span.remember_class{

    margin-right: 60%;

    display: block;

    text-align: right;

    text-decoration: none;

    color: #999;

    font-size: 0.9rem;

    transition: .3s;

    

}

span:hover {

    color: #38d39f;

}*/



.remember_class {

    width: 100%;

    display: inline-block;

}

.remember_class label {

    font-weight: 700;

    float: left;

    font-size: 14px;

    color: #999;

}

.remember_class label:hover {

    color: #38d39f;

}

input#rememberme {

    margin: 0px 8px 0px;

    position: relative;

    top: 1px;

}



</style>

</head>

<body>

  <div class="divclass">

  <!-- <img class="wave" src="<?php echo base_url(); ?>imgg/wave.png"> -->

  <div class="container">



    <div class="row divclass02">

      <div class="col-md-6">

    <div class="img">

      <img src="<?php echo base_url(); ?>imgg/bg.svg">

    </div>

    </div>

    <div class="col-md-6">

    <div class="login-content">

      <form id="loginform">

        <img src="<?php echo base_url(); ?>imgg/avatar.svg">

        <h2 class="title">Welcome</h2>

              <div class="input-div one">

                 <div class="i">

                    <i class="fas fa-user"></i>

                 </div>

                 <div class="div">

                    <!-- <h5>Username</h5> -->

                    <input type="text" class="input" id="email" name="username" placeholder="Username">

                 </div>

              </div>

              <div class="input-div pass">

                 <div class="i"> 

                    <i class="fas fa-lock"></i>

                 </div>

                 <div class="div">

                    <!-- <h5>Password</h5> -->

                    <input type="password" class="input"  name="password" id="password" placeholder="Password">

                 </div>

              </div>

          <div class="remember_class"><label><input id="rememberme" name="rememberme" value="remember" type="checkbox"> &nbsp;Remember me</label>

              <a href="#" class="forget">Forgot Password?</a>

              </div>

              <input type="submit" class="btn" value="Login" onclick="lsRememberMe()">

            </form>

        </div>

        </div>

        </div>



    </div>

  </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>jss/main.js"></script>

</body>

</html>





  <script src="<?php echo base_url(); ?>vendors/js/jquery.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/popper.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/bootstrap.min.js"></script>



    <script src="<?php echo base_url(); ?>vendors/js/toastr.min.js"></script>





<script type="text/javascript">



  $('#loginform').submit(function(evt){





    evt.preventDefault();



    var form = $(this).serialize();



  $.ajax({



        type : 'ajax',



        method : 'post',



        data : form,



        dataType : 'json',



        url : '<?php echo base_url(); ?>Login/loginfun',



        success:function(r){



console.log(r);



          if (r==true) {



          location.href = '<?php echo base_url();?>Dashboard';



       







        }



        else if (r == 'wrong') {



                              toastr.error('username or password wrong','Login Failed');



        }



        else{



                    console.log(r);











        }



        },



        error:function(xhr,status,error){



          console.log(xhr.responseText);



        }



  });



  })



</script>



<script type="text/javascript">

  const rmCheck = document.getElementById("rememberme"),

    emailInput = document.getElementById("email");

    passwordInput = document.getElementById("password");



if (localStorage.checkbox && localStorage.checkbox !== "") {

  rmCheck.setAttribute("checked", "checked");

  emailInput.value = localStorage.username;

   passwordInput.value = localStorage.password;

} else {

  rmCheck.removeAttribute("checked");

  emailInput.value = "";

  passwordInput.value = "";

}



function lsRememberMe() {

  if (rmCheck.checked && emailInput.value !== "") {

    localStorage.username = emailInput.value;

    localStorage.password = passwordInput.value;

    localStorage.checkbox = rmCheck.value;

  } else {

    localStorage.username = "";

    localStorage.password = "";

    localStorage.checkbox = "";

  }

}

</script>