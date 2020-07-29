<?php
include('server.php');
session_start();

  if ($_SESSION['user_type'] != 'admin') {
       session_destroy();
	     header("location: front.php");
   }

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "Du er ikke logget ind korrekt";
		header('location: front.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: front.php");
	}

	if (!isset($_SESSION['user_shop'])) {
    session_destroy();
		unset($_SESSION['user_type']);
		header("location: front.php");
	}
		$firma = $_SESSION['user_shop'];
		$firmaId = $_SESSION['companyId'];
		//echo "<script type='text/javascript'>alert('$firma med id: $firmaId')</script>";
include('head.php');
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>DanPanel Admin</title>
        <style>
            body {
                background-color: #f1f1f1;
            }

            .container {
                margin-top: 7vh;
            }

            footer {
                margin-top: 10vh;
            }
        </style>
    </head>

    <body>
        <header>
          <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                  <div class="navbar-header"> <a class="navbar-brand" href="front.php">EveBnb</a> </div>
                  <ul class="nav navbar-nav navbar-right" style="margin-right: 1vw;">
                    <?php if (isset($_SESSION['username'])) { ?>
                      <ul class="nav navbar-nav">
                        <?php if ($_SESSION['user_type'] != 'admin') {
                          ?>
                            <li><a href="adminindex.php">Min side</a></li>
                          <?php
                        } ?>

                      </ul>
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo ucfirst($_SESSION['username']); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class="logud" href="index.php?logout='1'" style="width:100%;">Log ud</a></li>
                        </ul>
                      </li>
                    <?php } else { ?>
                      <ul class="nav navbar-nav">
                          <li><a href="register.php">Opret bruger</a></li>
                          <li><a class="active" href="addVenue.php">Opret venue</a></li>
                      </ul>
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Log ind<span class="caret"></span></a>
                        <ul class="dropdown-menu" style="width: 10vw;">
                          <form class="form-horizontal" method="post" action="index.php" accept-charset="UTF-8">
                              <input class="form-control login" type="text" name="email" placeholder="E-mail">
                              <input class="form-control login" type="password" name="password" placeholder="adgangskode">
                              <div class="col-sm-6">
                              <button type="submit" class="btn btn-success " name="login_user">Log ind</button>
                              </div>
                              <div class="col-sm-6">
                              <a href="forgot.php">Glemt kode?</a>
                              </div>

                          </form>
                        </ul>
                      </li>
                      <?php
                    } ?>
                  </ul>
              </div>
          </nav>
        </header>
        <div class="container adminContainer">
            <div class="con row">
                <h3><strong>Velkommen tilbage</strong></h3> </div>
            <div class="wrapper row">
                <div class="index">
                    <?php  if (isset($_SESSION['username'])&&($_SESSION['user_type'])) : ?>
                        <h3> <br><img src="img/user.png"><strong><?php echo ucfirst($firma);?></strong></h3>
                        <?php endif ?>
                </div>

                <div class="status">
                  <?php


               $query = "SELECT count(bookingId) AS total FROM booking WHERE companyId = $firmaId";
                  //vare fundet fundet
                $result = mysqli_query($db, $query);
                    $values = mysqli_fetch_assoc($result);
                    $num_rows = $values['total'];

                // output data of each row
                       ?>
                <div class="col-xs-12 tekst">
                    <h4> <strong><?php echo $num_rows; echo ($num_rows==1 ? " bestilling" : " bestillinger" ) ?></strong></h4></div>


                </div>
                <div class="adminWidgets">
                  <a href="addImages.php">  <div class="addImages widget">
                      <img src="img/photo.svg" alt="">
                      <h3>Håndter billeder</h3>
                    </div></a>
                <a href="#">
                  <div class="adminCheck widget">
                    <img src="img/calendar.svg" alt="">
                    <h3>Tjek bestillinger</h3>
                  </div>
                </a>
                  <a href="#">
                    <div class="updateUser widget">
                      <img src="img/refresh.svg" alt="">
                      <h3>Opdater dine oplysninger</h3>
                    </div>
                  </a>
                  <a href="#">
                    <div class="widget">
                    </div>
                  </a>

                </div>
            </div>

        </div>
        <footer class="footer row">

        </footer>
    </body>

    </html>
