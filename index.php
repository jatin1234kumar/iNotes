<?php
// connet to the database

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudapp";

$conn = mysqli_connect($servername, $username, $password, $database);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Crud app - main</title>
  <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Normal css -->
  <link rel="stylesheet" href="styles/basic.css" />
  <link rel="stylesheet" href="styles/style.css" />

  <style>
    .statusBox {
      position: relative;
      top: 0;
      left: 0;
      right: 0;
      width: 100%;
      animation: fade-out 2s ease forwards;
      height: 3rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .statusinfo {
      font-size: 1.2rem;
      text-transform: capitalize;
      color: white;
      font-weight: 700;
      letter-spacing: 1.5px;
      opacity: 0;
      animation: pop-up 1s ease .5s forwards;
    }

    @keyframes pop-up {
      0% {
        opacity: 0;
        scale: 0;
      }

      80% {
        opacity: 1;
        scale: 1.2;
      }

      100% {
        opacity: 0;
        scale: 1;
      }
    }

    @keyframes fade-out {
      0% {
        height: 0;
        opacity: 0;
      }

      70% {
        height: 3rem;
        opacity: 1;
      }

      100% {
        height: 0;
        opacity: 0;
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="statusBox" style="
   background-color: <?php
   if (!$conn) {
     echo "red";
   } else {
     echo "lightgreen";
   }
   ?>
        ;">
    <?php
    if (!$conn) {
      echo "<div class='statusinfo'>offline</div>";
    } else {
      echo "<div class='statusinfo'>online</div>";
    }
    ?>
  </div>

  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Php code -->

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO `userdata` (`Title`, `Description`) VALUES ('$title', '$desc')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "code got inserted successfully";
    } else {
      echo "code does not get inserted successfully";
    }
  }


  ?>

  <div class="container my-3">
    <h3>Add a note</h3>
    <form method="post" action="/index.php">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
          placeholder="name@example.com">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add note</button>
    </form>
  </div>

  <div class="container">
    <?php
      $sql2 = "SELECT * FROM 'userdata'";
      $result2 = mysqli_query($conn, $sql2);
      while ($row = mysqli_fetch_assoc($result2)){
        echo $row['S.no.'] . $row['Title'] . $row['Description'];
        echo "<br>";
      }
    ?>
  </div>

  <!-- bootstrap script -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  <!-- Main script -->
  <script src="scripts/script.js"></script>
  <noscript> javascript is needed to proceed further............. </noscript>
</body>

</html>