<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
 header("Location: home.php");
 exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

 // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if(empty($pass)){
  $error = true;
  $passError = "Please enter your password.";
 }

 // if there's no error, continue to login
 if (!$error) {
  
  $password = hash('sha256', $pass); // password hashing

  $res=mysqli_query($conn, "SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
  
  if( $count == 1 && $row['userPass']==$password ) {
   $_SESSION['user'] = $row['userId'];
   header("Location: home.php");
  } else {
   $errMSG = "Incorrect Credentials, Try again...";
  }
  
 }

}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Login & Registration System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="#">BIGLIBRARY</a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                    &#9776;
                </button>
                <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                    <li class="dropdown order-1">
                        <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">sign in<span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right mt-2" style="width: 300px !important;">
                            <li class="px-3 py-2" >
                                <form class="form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                                    <?php
                            if ( isset($errMSG) ) {
                            echo $errMSG; 
                            }
                            ?>
                                        <div class="form-group">
                                            <input id="emailInput" name="email" placeholder="Email" class="form-control form-control-sm" type="text" value="<?php echo $email; ?>" maxlength="40" required="">
                                            <span class="text-danger"><?php echo $emailError; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input id="passwordInput" name="pass" placeholder="Password" class="form-control form-control-sm" type="password" maxlength="15" required="">
                                            <span class="text-danger"><?php echo $passError; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block" name="btn-login">sign in</button>
                                        </div>
                                        <div class="form-group text-center">
                                            <a href="register.php" class="btn btn-outline-success">Sign up</a>
                                        </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
        <!-- carousel -->
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://images.pexels.com/photos/12064/pexels-photo-12064.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" height="500">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://images.pexels.com/photos/1034008/pexels-photo-1034008.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" height="500">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://images.pexels.com/photos/926680/books-book-shopping-old-books-926680.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" height="500">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
      </a>
        </div>
        <!-- -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="box">
                        <div class="display1">
                            <i class="fas fa-book text-success" style="font-size: 45px; padding-left: 80px; "></i>
                            <p style="font-size: 35px;">Join the library</p>
                        </div>
                        <P>Aat vero eros et accumsan et iusto odio dignissim qui blandit praesent luptaum zzelenit augue duis dolore te feugait nulla facilisi. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem vestigationes demonstraverunt lectores legere me lius quo</P>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="box">
                        <div class="display">
                            <i class="fas fa-glasses text-primary" style="font-size: 45px; padding-left: 140px;"></i>
                            <p class="text-center" style="font-size: 35px;">Help</p>
                        </div>
                        <P>Secilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptaum zzelenit augue duis dolore te feugait nulla facilisi. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem vestigatio</P>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="box">
                        <div class="display">
                            <i class="fas fa-bookmark text-danger" style="font-size: 45px; padding-left: 80px;"></i>
                            <p style="font-size: 35px;">Ask a librarian</p>
                        </div>
                        <P>Adio dignissim qui blandit praesent luptaum zzelenit augue duis dolore te feugait nulla facilisi. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem</P>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!--cards -->

        <div class="container">
          <h1 class="mt-5 mb-5">MOST POPULAR</h1>
            <div class="row">
                <div class="col_lg_4 mr-5 mb-5">
                    <div class="card" style="width: 20rem;">
                        <img class="card-img-top" src="https://www.ajc.com/rf/image_large/Pub/p7/AJC/2016/12/08/Images/518VhA3dH9L._SX329_BO1,204,203,200__20161208114646.jpg" height="300">
                        <div class="card-body">
                            <h5 class="card-title">HARRY POTTER</h5>
                            <p class="card-text">.....</p>
                            <p>....</p>
                            <a href="#" class="btn btn-primary">Reservation</a>
                        </div>
                    </div>
                </div>
                <div class="col_lg_4 mr-5 mb-5">
                    <div class="card" style="width: 20rem;">
                        <img class="card-img-top" src="https://d1gzo5vknddaf.cloudfront.net/uploads/image/file/24984/DIVERGENT.jpg" height="300">
                        <div class="card-body">
                            <h5 class="card-title">DIVERDENT</h5>
                            <p class="card-text">.....</p>
                            <p>....</p>
                            <a href="#" class="btn btn-primary">Reservation</a>
                        </div>
                    </div>
                </div>
                <div class="col_lg_4 mr-5 mb-5">
                    <div class="card" style="width: 20rem;">
                        <img class="card-img-top" src="https://www.penguin.co.uk/content/dam/prh-consumer/penguin/articles/find-your-next-read/reading-lists/2017/dec/xmas/rebel%20girls%20cover.jpg" height="300">
                        <div class="card-body">
                            <h5 class="card-title">GOOD NIGHT STORIES FOR REBEL GIRLS</h5>
                            <p class="card-text">.....</p>
                            <p>....</p>
                            <a href="#" class="btn btn-primary">Reservation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php ob_end_flush(); ?>