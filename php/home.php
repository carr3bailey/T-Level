<?php
include "config.php";

// Check if user is loggged in or not
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
}

// logout
if (isset($_POST['but_logout'])) {
  session_destroy();
  header('Location: ../html/frontpage.html');
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Headers · Bootstrap v5.1</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">



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

    #contentBox {
      margin: 10px;
    }

    .box {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
    }

    #welcome {
      margin: auto;
      display: flex;
      justify-content: center;
      font-size: 120%;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="../css/headers.css" rel="stylesheet">
</head>

<body onload="startTime()">
  <main>
    <header class="py-3 mb-3 border-bottom">
      <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/logoc.png" class="logoleft" width="45" height="45">
          </a>
        </div>

        <div class="d-flex align-items-center">
          <div id=txt class="w-100 text-end me-3">
            <script>
              function startTime() {
                const today = new Date();
                //Gets hours, minutes and seconds and assigns them each variables
                let hours = today.getHours();
                let minutes = today.getMinutes();
                let seconds = today.getSeconds();
                //Replaces numbers under 10 with correct notation
                minutes = checkTime(minutes);
                seconds = checkTime(seconds);
                //Replaces text within this div with the time
                document.getElementById('txt').innerHTML = hours + ":" + minutes + ":" + seconds;
                setTimeout(startTime, 1000);
              }
              //without this times would look like 3:4:7 instead of 03:04:07
              function checkTime(i) {
                if (i < 10) {
                  i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
              }
            </script>
          </div>

          <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../assets/user.jpg" alt="user" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form method='post' action=""><input class="dropdown-item" type="submit" value="Logout" name="but_logout"></form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <div class="container-fluid pb-3">
      <div class="d-grid gap-3">
        <div class="box bg-light border rounded-3">
          <div id="welcome">
            <p>Welcome back <strong><?php
                                    //Creates Query 
                                    $selectname = "SELECT fname FROM users WHERE username='" . $_SESSION['username'] . "'";
                                    //Connects to DB and uses Query from above
                                    $result = $connect->query($selectname);
                                    //Fetches data from query
                                    $fname = $result->fetch_array()['fname'] ?? '';
                                    //Prints fetched data
                                    echo $fname; ?>!</strong></p>
          </div>
        </div>
        <div class="container-fluid pb-3">
          <div class="d-grid gap-3" style="grid-template-columns: 2fr 2fr;">
            <a href=# class="text-decoration-none text-reset">
              <div class="box bg-light border rounded-3">
                <div class="me-auto" id="contentBox">
                  <h1>Uncompleted Tasks</h1>
                  <?php
                  $result = mysqli_query($connect, "SELECT * FROM tasks");
                  $rows = mysqli_num_rows($result);
                  echo "You have " . $rows . " tasks to complete";
                  ?>
                </div>
              </div>
            </a>
            <a href=dashboard.php class="text-decoration-none text-reset">
              <div class="box bg-light border rounded-3">
                <div id="contentBox">
                  <h1>View Progress</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pretium rhoncus commodo. Etiam varius, elit vel feugiat fringilla, nunc lectus placerat elit, vitae sollicitudin nulla tellus vitae quam. Aliquam pulvinar nisl ac ante malesuada, tincidunt posuere nibh bibendum.</p>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="container-fluid pb-3">
          <div class="d-grid gap-3" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="box bg-light border rounded-3">
              <div id="contentBox">
                <h1>Insert News</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pretium rhoncus commodo. Etiam varius, elit vel feugiat fringilla, nunc lectus placerat elit, vitae sollicitudin nulla tellus vitae quam. Aliquam pulvinar nisl ac ante malesuada, tincidunt posuere nibh bibendum.</p>
              </div>
            </div>
            <div class="box bg-light border rounded-3">
              <div id="contentBox">
                <h1>Insert News</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pretium rhoncus commodo. Etiam varius, elit vel feugiat fringilla, nunc lectus placerat elit, vitae sollicitudin nulla tellus vitae quam. Aliquam pulvinar nisl ac ante malesuada, tincidunt posuere nibh bibendum.</p>
              </div>
            </div>
            <div class="box bg-light border rounded-3">
              <div id="contentBox">
                <h1>Insert News</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pretium rhoncus commodo. Etiam varius, elit vel feugiat fringilla, nunc lectus placerat elit, vitae sollicitudin nulla tellus vitae quam. Aliquam pulvinar nisl ac ante malesuada, tincidunt posuere nibh bibendum.</p>
              </div>
            </div>
          </div>
        </div>
  </main>
</body>

</html>