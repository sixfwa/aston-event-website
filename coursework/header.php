<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    <title><?php echo $title; ?></title>
    <style>
      .navbar, .jumbotron {
        margin: 0px;
      }
      .navbar {
        margin-bottom: 5%;
      }
      a:link {
        text-decoration: none;
      }
      footer {
        margin-top: 5%;
      }
    </style>
  </head>
  <body>

    <div class="jumbotron bg-light">
      <h1><a class="link" href="index.php">ASTON EVENTS</a></h1>
    </div>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="explore.php">EXPLORE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="createevent.php">CREATE AN EVENT</a>
        </li>
        <li class="nav-item">
          <?php if (isset($_SESSION["user"])) { ?>
            <a class="nav-link" href="logout.php">LOG OUT</a>
          <?php } else { ?>
            <a class="nav-link" href="signin.php">SIGN IN</a>
          <?php } ?>
        </li>
      </ul>
    </nav>
    <div class="container">
