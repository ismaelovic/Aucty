<?php include('server.php');
session_start();
include('head.php')
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Velkommen til EventBook</title>

        <style>
            .btn-success {
                margin-top: 4vh;
                margin-bottom: 3vh;
                font-family: 'Ubuntu', sans-serif;
                border-radius: 10px;
            }

            input,
            select {
                text-align: left;
            }
        </style>
    </head>

    <body>
      <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header"> <a class="navbar-brand" href="index.php">EventBook</a> </div>

                <ul class="nav navbar-nav navbar-right" style="margin-right: 1vw;">
                  <?php if (isset($_SESSION['username'])) { ?>
                    <ul class="nav navbar-nav">
                        <li><a href="kundetjek.php">Tjek bestillinger</a></li>
                    </ul>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo ucfirst($_SESSION['username']); ?><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="update.php">Opdater oplysninger</a></li>
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
        <div class="content">
            <div class="con row">
                <h3>Tilføj medarbejder</h3> </div>
              <div class="" style="grid-column:1/3;">
                <?php include('errors.php'); ?>
                  <?php echo isset($msg)?$msg:"";?>
              </div>
            <form method="post" action="addOwner.php">
                <div class="brugerInfo">
                   <div class="input-group row">
                   <label>Fornavn</label>
                   <input type="text" name="firstName"> </div>
                   <div class="input-group row">
                   <label>Efternavn</label>
                   <input type="text" name="lastName"> </div>
                   <div class="input-group row">
                   <label>Telefon nummer</label>
                   <input type="text" name="number"> </div>
                   <div class="input-group row">
                   <label>E-mail</label>
                   <input type="email" name="email"> </div>
                   <div class="input-group row">
                   <label>Adgangskode</label>
                   <input type="password" name="password_1"> </div>
                   <div class="input-group row">
                   <label>Bekræft adgangskode</label>
                   <input type="password" name="password_2"> </div>

                   </div>

                    <div class="input-group" style="grid-column: 1/3; margin:auto;">
                        <button type="submit" class="btn btn-success" name="reg_Owner">Opret</button>
                    </div>
            </form>
        </div>



    </body>

    </html>
