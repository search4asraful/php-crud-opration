<?php
  include 'config.php';
  $id = $_GET['id'];

  $sql = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];
  $name = $row['name'];
  $phone = $row['phone'];
  $email = $row['email'];

  if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $name = validateInput($_POST['name'], "Name field is required");
    $phone = validateInput($_POST['phone'], "Phone field is required");
    $email = validateInput($_POST['email'], "Email field is required");

    if(empty($errors)){
    // SQL Query
    $sql = "UPDATE users SET name='$name', phone='$phone', email='$email' WHERE id='$id'";
    $result = mysqli_query($connect, $sql);

    if($result){
      header('location:index.php');
    }else{
      die(mysqli_error($connect));
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container col-md-12 mt-5">
      <div class="col-md-3"></div>
      <div class="card mx-auto col-md-6">
          <div class="card-header">
            <h3>Create user</h3>
            <a href="index.php" class="btn btn-success float-end" style="margin-top: -40px;">Go list</a>
          </div>
          <div class="card-body">
          <form action="#" method="POST">

          <?php
          if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error) {
              echo '<span>'.$error.'</span><br>';
            }
            echo '</div>';
          }
          ?>

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="<?php echo "$name";?>" class="form-control" id="name" placeholder="Enter full name">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" name="phone" value="<?php echo "$phone";?>" class="form-control" id="phone" placeholder="Enter phone number">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="<?php echo "$email";?>" class="form-control" id="email" placeholder="Enter email address">
          </div>
          <button type="submit" name="submit" class="btn btn-warning">Update info</button>
        </form>
          </div>
        </div>
      <div class="col-md-3"></div>
    </div>
  </body>
</html>