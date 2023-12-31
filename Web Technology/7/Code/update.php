<?php
include "config.php";

// Define variables and initialize with empty values
$fname_err = $lname_err = $email_err = $course_err = $batch_err = $city_err = $state_err = "";
$firstname = $lastname = $email = $course = $batch = $city = $state = "";

// Process update operation when form is submit
if (isset($_POST["id"]) && !empty($_POST["id"])) {
  // Get post id
  $id = $_POST["id"];

  if (empty($_POST["fname"])) {
    $fname_err = "*this field is required";
  } else {
    $firstname = trim($_POST["fname"]);
    if (!ctype_alpha($firstname)) {
      $fname_err = "Only letters are allowed";
    }
  }

  if (empty($_POST["lname"])) {
    $lname_err = "*This field is required";
  } else {
    $lastname = trim($_POST["lname"]);
    if (!ctype_alpha($lastname)) {
      $lname_err = "Only letters are allowed";
    }
  }

  if (empty($_POST["email"])) {
    $email_err = "*This field is required";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "*Please enter a valid email address";
    }
  }

  if (empty($_POST["course"])) {
    $course_err = "*This field is required";
  } else {
    $course = trim($_POST["course"]);
  }

  if (empty($_POST["batch"])) {
    $batch_err = "*This field is required";
  } else {
    $batch = trim($_POST["batch"]);
  }

  if (empty($_POST["city"])) {
    $city_err = "*This field is required";
  } else {
    $city = trim($_POST["city"]);
  }

  if (empty($_POST["state"])) {
    $state_err = "*This field is required";
  } else {
    $state = trim($_POST["state"]);
  }

  // Check input errors before updating record
  if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($course_err) && empty($batch_err) && empty($city_err) && empty($state_err)) {

    // Prepare a update statement
    $sql = "UPDATE students SET firstname = ?, lastname = ?, email = ?, course = ?, batch = ?, city = ?, state = ? WHERE id = ? ";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the statement as parameters
      mysqli_stmt_bind_param($stmt, "ssssissi", $firstname, $lastname, $email, $course, $batch, $city, $state, $id);

      // Execute the statement
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href='http://localhost/php_crud/';</script>";
        exit;
      } else {
        echo "Oops, Something went wrong. Please try again later.";
      }
    }
    // Close statement
    mysqli_stmt_close($stmt);
  }
  // Close connection
  mysqli_close($link);
} else {
  // Check if url contains id parameter
  if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get id from url
    $id = trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM students WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variable to a statement as parameter
      mysqli_stmt_bind_param($stmt, "i", $id);

      // Execute the statement
      if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
          // Fetch the record
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

          // Retrieve individual field value
          $firstname =  $row["firstname"];
          $lastname =  $row["lastname"];
          $email =  $row["email"];
          $course =  $row["course"];
          $batch =  $row["batch"];
          $city =  $row["city"];
          $state =  $row["state"];
        } else {
          // Redirect id url doesn't contain valid id parameter
          echo "<script>window.location.href='http://localhost/php_crud/';</script>";
          exit;
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }
    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
  } else {
    // Redirect if url doesn't contain id parameter
    echo "<script>window.location.href='http://localhost/php_crud/';</script>";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Data - PHP CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center pt-5">
      <div class="col-lg-6">
        <!-- form start -->
        <form action="<?= htmlspecialchars(basename($_SERVER["REQUEST_URI"])); ?>" method="post" class="bg-light p-4 shadow-sm" novalidate>
          <div class="row">
            <div class="col-lg-6 mb-3">
              <label for="fname" class="form-label">Firstname</label>
              <input type="text" name="fname" class="form-control" id="fname" value="<?= $firstname; ?>">
              <small class="text-danger"><?= $fname_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="lname" class="form-label">Lastname</label>
              <input type="text" name="lname" class="form-control" id="lname" value="<?= $lastname; ?>">
              <small class="text-danger"><?= $lname_err; ?></small>
            </div>

            <div class="col-lg-12 mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" id="email" value="<?= $email; ?>">
              <small class="text-danger"><?= $email_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="course" class="form-label">Course</label>
              <input type="text" name="course" class="form-control" id="course" value="<?= $course; ?>">
              <small class="text-danger"><?= $course_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="batch" class="form-label">Batch</label>
              <input type="number" name="batch" class="form-control" id="batch" value="<?= $batch; ?>">
              <small class="text-danger"><?= $batch_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" name="city" class="form-control" id="city" value="<?= $city; ?>">
              <small class="text-danger"><?= $city_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="state" class="form-label">State</label>
              <input type="text" name="state" class="form-control" id="state" value="<?= $state; ?>">
              <small class="text-danger"><?= $state_err; ?></small>
            </div>

            <div class="col-lg-12 mt-1">
              <input type="hidden" name="id" class="form-control" value="<?= $id; ?>">
              <input type="submit" class="btn btn-secondary btn-block w-100" value="Update Record">
            </div>
          </div>
        </form>
        <!-- form end -->
      </div>
    </div>
  </div>
</body>

</html>