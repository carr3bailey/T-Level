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
<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
  <script src="../js/graphs.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body onload="startTime()">
  <header class="py-3 mb-3 border-bottom">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
      <div class="dropdown">
        <?php echo "<a href='"."home.php"."'>"?>
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
          <div class="d-flex justify-content-center" id="welcome">
          <h4><strong><?php
                                    //Creates Query 
                                    $selectname = "SELECT fname FROM users WHERE username='" . $_SESSION['username'] . "'";
                                    //Connects to DB and uses Query from above
                                    $result = $connect->query($selectname);
                                    //Fetches data from query
                                    $fname = $result->fetch_array()['fname'] ?? '';
                                    //Prints fetched data
                                    echo $fname; ?>'s</strong> attendance and punctuality</h4>
          </div>
        </div>
  <div class="container-fluid pb-3">
          <div class="d-grid gap-3" style="grid-template-columns: 2fr 2fr;">
              <div class="box bg-light border rounded-3">
                <div id="contentBox">
                  <h1>Attendance</h1>
                </div>
              </div>
              <div class="box bg-light border rounded-3">
                <div id="contentBox">
                  <h1>Punctuality</h1>
                </div>
              </div>
          </div>
        </div>
      <div class="container-fluid pb-3">
        <div class="d-grid gap-3" style="grid-template-columns: 2fr 2fr;">
          <div class="box bg-light border rounded-3">
            <div class="d-flex justify-content-center" id="contentBox">
              <canvas id="myChart" width="600" height="420"></canvas>
              <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: ['Term 1', 'Term 2', 'Term 3', 'Term 4'],
                    datasets: [{
                      label: 'Attendance Percentage',
                      data: [98, 99, 94, 96],
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: false,
                    scales: {
                      yAxes: [{
                        display: true,
                        ticks: {
                          suggestedMin: 80, // minimum will be 0, unless there is a lower value.
                        }
                      }]
                    }
                  }
                });
              </script>
            </div>
          </div>
          <div class="box bg-light border rounded-3">
            <div class="d-flex justify-content-center" id="contentBox">
              <canvas id="myChart2" width="600" height="420"></canvas>
              <script>
                const ctx2 = document.getElementById('myChart2').getContext('2d');
                const myChart2 = new Chart(ctx2, {
                  type: 'bar',
                  data: {
                    labels: ['Term 1', 'Term 2', 'Term 3', 'Term 4'],
                    datasets: [{
                      label: 'Punctuality Percentage',
                      data: [88, 100, 74, 93],
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: false,
                    scales: {
                      yAxes: [{
                        display: true,
                        ticks: {
                          suggestedMin: 80, // minimum will be 0, unless there is a lower value.
                        }
                      }]
                    }
                  }
                });
              </script>
            </div>
          </div>
        </div>
      </div>
</body>

</html>