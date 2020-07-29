<?php include('server.php');
  if ($_SESSION['user_type'] != 'admin') {
       session_destroy();
	     header("location: front.php");
   }

	if (!isset($_SESSION['username'])) {
    session_destroy();
		header('location: front.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: front.php");
	}
  $firma = $_SESSION['user_shop'];
  $firmaId = $_SESSION['companyId'];
  echo "<script type='text/javascript'>alert(' valgt: $firmaId, navn: $firma')</script>";
  include('head.php');
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Håndter medarbejdere</title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
          .container {
                margin-top: 7vh;
            }

            .resultat input[type=text] {
                width: 5vw;
                border: none;
                background-color: whitesmoke;
                text-align: center;
            }
            .imgGallery img {
              padding: 8px;
              max-width: 100px;
            }
            footer {
                margin-top: 12vh;
            }
        </style>
    </head>

    <body>
        <header>
          <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                  <div class="navbar-header"> <a class="navbar-brand" href="index.php">EveBnb</a> </div>

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
        <div class="imageContainer">
            <div class="row con">
                <h3>Tilføj billeder af <?php echo $firma?></h3></div>

                <div class="imgGallery">
                  <!-- image preview -->
                </div>

                <form action="" method="post" enctype="multipart/form-data" class="mb-3">
                  <div class="custom-file">
                    <input type="file" name="fileUpload[]" class="custom-file-input" value="Vælg billeder" id="chooseFile" multiple>
                    <label class="custom-file-label" for="chooseFile">Vælg billeder</label>
                    <input type="text" name="companyId" value="<?php echo $firmaId; ?>" hidden>
                  </div>

                  <button type="submit" name="submitImage" class="btn btn-primary btn-block mt-4">
                    Upload Files
                  </button>
                </form>
                <div class="alert <?php echo $response["status"]; ?>">
                   <?php echo $response["message"]; ?>
                </div>
        </div>

        <footer>

        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
  $(function () {
    // Multiple images preview with JavaScript
    var multiImgPreview = function (input, imgPreviewPlaceholder) {

      if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();

          reader.onload = function (event) {
            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
          }

          reader.readAsDataURL(input.files[i]);
        }
      }

    };

    $('#chooseFile').on('change', function () {
      multiImgPreview(this, 'div.imgGallery');
    });
  });
</script>
    </body>


    </html>
