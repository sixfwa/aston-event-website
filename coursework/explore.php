<?php
$title = "Explore";
include_once "header.php";
include_once "pdo.php";

$sport = false;
$culture = false;
$other = false;

$stmt = $pdo -> query("SELECT event_name, category, day, image, location FROM aston_events");

function sortByCategory($type) {
  if ($_POST['sort']) {
    
  }
  switch ($type) {
    case "sport":
      $sport = true;
      break;
    case "culture":
      $culture = true;
    case "other":
      $other = true;
  }
}

?>
<div class="row">
  <div class="col">
    <h4>Aston University Events: </h4>
  </div>
  <div class="col">
    <form method="post">
      <div class="form-group">
        <label for="sort">Sort By</label>
        <select class="form-control" name="sort">
          <option value='latest'>Latest Events</option>
          <option value='sport'>Sport</option>
          <option value='culture'>Culture</option>
          <option value="other"></option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="sort">Sort</button>
    </form>
  </div>
</div>
<?php
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { ?>
  <div class="row">
    <div class="col-md-5">
      <!-- The cards for the events -->
      <div class="card">
        <img src="uploads/<?php echo ($row['image']); ?>"
        class="card-img-top" alt="Card Image" height="250">
        <div class="card-body">
          <h4 class="card-title"><?php echo ($row['event_name']); ?></h4>
          <p class="card-text">Category: <?php echo ucwords(($row['category'])); ?></p>
          <p class="card-text">Location: <?php echo ($row['location']); ?></p>
          <p class="card-text">Date: <?php echo ($row['day']); ?></p>
          <a href="#" class="card-link">More Information...</a>
        </div>
      </div>
    </div>
  </div>
  <br>
<?php } ?>

<?php
  include_once "footer.php";
?>
