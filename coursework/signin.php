<?php
$title = "Sign In";
include_once "header.php";
include_once "pdo.php";
$exist = false;
if (isset($_POST['email']) && isset($_POST['password'])) {
  unset($_SESSION["user"]);
  unset($_SESSION["name"]);
  $stmt = $pdo -> query("SELECT email, password FROM student_accounts");

  $email = $_POST['email'];
  $password = $_POST['password'];

  while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    if ($row['email'] === $email && $row['password'] === $password) {
      $exist = true;
      $_SESSION["name"] = $row['email'];
    }
  }
}

if ($exist) {
  $_SESSION["user"] = $_POST["email"];
  $_SESSION["success"] = "Logged In";
  header("Location: index.php");
} else {
  $_SESSION["error"] = "Incorrect Email or Password";

}

if (isset($_SESSION["user"])) {
?>
  <p>Logged In</p>
  <a href="logout.php">Logout</a>
<?php } else { ?>
<div class="row">
  <!-- Column 1 -->
  <div class="col">
    <form method="post">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="form-group">
        <label for="email">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
  </div>
  <div class="col">
    <p>Sign in if you want to create events.</p>
  </div>
</div>
<?php
}
include_once "footer.php";
?>
