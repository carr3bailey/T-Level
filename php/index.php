<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>GibJohn Tutoring · Sign In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
<!-- Login form -->
<main class="form-signin">
<form action="" method="post">
    <a href="../html/frontpage.html"><img src="../assets/logob.png" alt="" width="150"></a>
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>
    <!-- Username field -->
    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
      <label for="username">Username</label>
    </div>
    <!-- Password field -->
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <!-- PHP for checking login credentials and echoing errors -->
    <div class="text-danger">
      <?php
      include "config.php";


      if(isset($_POST['but_submit'])){
          $invalid = 0;
          $username = mysqli_real_escape_string($connect,$_POST['username']);
          $password = mysqli_real_escape_string($connect,$_POST['password']);

          //checks if username and password fields have data
          if ($username != "" && $password != ""){
              //queries database and checks if it appears > 0
              $sql_query = "select count(*) as cntUser from users where username='".$username."' and password='".$password."'";
              $result = mysqli_query($connect,$sql_query);
              $row = mysqli_fetch_array($result);

              $count = $row['cntUser'];
              //if count > 0 login, else invalid
              if($count > 0){
                  $_SESSION['username'] = $username;
                  header('Location: home.php');
              }else{
                  echo("Invalid username or password");
              }

          }

      }
      ?>
    </div>
    <button class="w-100 btn btn-lg btn-primary" name="but_submit" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2002–2022</p>
  </form>
</main>
  </body>
</html>

