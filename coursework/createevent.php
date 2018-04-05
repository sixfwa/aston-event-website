<?php
// Title for the page
$title = "Create An Event";

include_once "header.php";
include_once "pdo.php";

// Whether the information has been filled in
$createdInfo = false;
// Whether a picture has been added
$createdPicture = false;
// Name of the file
$file_name = "";
// Has an image been set
if (isset($_FILES['image'])) {
  $errors = array();
  // Name of the file
  $file_name = $_FILES['image']['name'];
  // Size of the file
  $file_size = $_FILES['image']['size'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $file_type = $_FILES['image']['type'];
  // Used to check what sort of image file it is
  $file_1 = explode('.', $file_name);
  $file_2 = end($file_1);
  $file_ext = strtolower($file_2);
  // Contains all of the legitimate file types that can be uploaded
  $expansions = array("jpeg","jpg","png");
  // Checks if the the file format uploaded exists in the $expansions array
  if (in_array($file_ext, $expansions) === false) {
     $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
  }
  // Checks if the file size is "MB"
  if ($file_size > 2097152) {
     $errors[] = 'File size is too large. Maximum file size is 2 MB';
  }
  // If there were no errors then add the file to the uploads directory
  if (empty($errors) == true) {
     move_uploaded_file($file_tmp, "uploads/".$file_name);
     $createdPicture = true;
  } else {
     print_r($errors);
  }
}
/*
  Checks whether all of the fields are set along with the image.
  Creates a SQL statement to insert data into the aston_events
  table. Uses placeholders to ensure security.
  Then adds the data to the SQL database
*/
if (isset($_POST['eventname']) && isset($_POST['options']) &&
  isset($_POST['email']) && isset($_POST['number']) &&
  isset($_POST['date']) && isset($_POST['time']) &&
  isset($_POST['description']) && isset($_POST['location']) && $createdPicture) {
    $sql = "INSERT INTO aston_events (event_name, category, email, mobile, day, clock,
    description, image, location) VALUES (:eventname, :options, :email, :mobile, :day,
    :clock, :description, :image, :location)";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute(array(
      ':eventname' => $_POST['eventname'],
      ':options' => $_POST['options'],
      ':email' => $_POST['email'],
      ':mobile' => $_POST['number'],
      ':day' => $_POST['date'],
      ':clock' => $_POST['time'],
      ':description' => $_POST['description'],
      ':image' => $file_name,
      ':location' => $_POST['location']
    ));
    $createdInfo = true;
}

// If a user is signed in
if (isset($_SESSION["user"])) {
// The event information has been filled in correctly, display a success message
if ($createdInfo && $createdPicture) { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success">
        <strong>Success!</strong> Event Added.
      </div>
    </div>
  </div>
<?php } ?>
<div class="row">
  <div class="col">
    <h4>Fill in the From to Create an Event</h4>
  </div>
</div>
<div class="row">
  <div class="col">
    <!-- Form -->
    <form method="post" enctype="multipart/form-data">
      <!-- Event Name -->
      <div class="form-group">
        <label for="eventname">Event Name</label>
        <input type="text" class="form-control" name="eventname" required>
      </div>
      <!-- Event Category -->
      <div class="form-group">
        <label for="category">Category </label>
        <p><div class="btn-group" data-toggle="buttons">
          <label class="btn btn-default">
            <input type="radio" name="options" value="sport"> Sport
          </label>
          <label class="btn btn-default">
            <input type="radio" name="options" value="culture"> Culture
          </label>
          <label class="btn btn-default">
            <input type="radio" name="options" value="other"> Other
          </label>
        </div></p>
      </div>
      <!-- Location -->
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" class="form-control" required>
      </div>
      <!-- Contact Email -->
      <div class="form-group">
        <label for="email">Contact Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <!-- Contact Number -->
      <div class="form-group">
        <label for="number">Contact Number</label>
        <input type="number" name="number" class="form-control">
      </div>
      <!-- Date -->
      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" name="date" required>
      </div>
      <!-- Time -->
      <div class="form-group">
        <label for="Time">Time</label>
        <input type="time" class="form-control" name="time" required>
      </div>
      <!-- Description -->
      <div class="form-group">
        <label for="password">Description</label>
        <textarea name="description" rows="5" cols="80" class="form-control" required></textarea>
      </div>
      <!-- Image Upload -->
      <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" class="form-control" name="image" id="image" required>
      </div>
      <!-- Create Evemt Button -->
      <button type="submit" class="btn btn-primary" name="submit">Create Event</button>
    </form>
  </div>
  <div class="col">
    <p>Please be sure to fill in all fields.</p>
  </div>
</div>
<?php } else { ?>
  <div class="row">
    <div class="col">
      <h5>In order to create an event, please <a href="index.php">register</a> as an event organiser.</h5>
      <h5>Or <a href="signin.php">Sign In</a> if you already are one.</h5>
    </div>
  </div>
<?php
}
include_once "footer.php";
?>
