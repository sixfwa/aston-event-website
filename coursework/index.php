<?php
$title = "Home";
include_once "header.php";
include_once "pdo.php";

$created = false;

function cleanup($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['firstname']) && isset($_POST['lastname'])&&
    isset($_POST['email']) && isset($_POST['password']) &&
    isset($_POST['repassword'])) {

      $password = $_POST['password'];
      $repassword = $_POST['repassword'];

      if ($password === $repassword) {
        $sql = "INSERT INTO student_accounts (firstname, lastname, email, password)
        VALUES (:firstname, :lastname, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':firstname' => cleanup($_POST['firstname']),
          ':lastname' => cleanup($_POST['lastname']),
          ':email' => cleanup($_POST['email']),
          ':password' => $_POST['password']
        ));
        $created = true;
      }
    }

if (isset($_SESSION["name"])) {
?>
  <h4>Welcome <?php echo $_SESSION["name"]; ?></h4>
  <p>Check out the <a href="explore.php">EXPLORE</a> page to see what events are taking place at Aston</p>
  <p>Or create your own event on the <a href="createevent.php">CREATE AN EVENT</a> page</p>
<?php } else { ?>
  <?php if ($created) { ?>
    <div class="row">
      <div class="col">
        <div class="alert alert-success">
          <strong>Success!</strong> Accont Created.
        </div>
      </div>
    </div>
  <?php } ?>
  <!--Row 1-->
  <div class="row">
    <div class="col">
      <h5>Register to become an Aston Event Organiser</h5>
    </div>
    <div class="col"></div>
  </div>
  <!-- Row 2 with the register form -->
  <div class="row">
    <div class="col">
      <form method="post">
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" name="firstname" required>
        </div>
        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" name="lastname" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
          <label for="password">Re-Enter Password</label>
          <input type="password" class="form-control" name="repassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
    <div class="col">
      <p>
      Welcome to Aston Events. Keep updated on all
      of the events hosted by students of Aston University.

      If you want to create your own event then please register.
    </p>
    </div>
  </div>
<?php
}
include_once "footer.php";
?>
