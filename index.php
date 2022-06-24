<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MDM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">
            <img src="images/MDM.png" width="120" height="90" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="placeholder"> &nbsp; </span>
            </li>
            
                <li class="nav-item">
                <a class=" btn btn-link nav-link" href="admin/login.html">Login <i class="fa fa-sign-in"></i></a>
                </li>
                <li class="nav-item">
                    <a class=" btn btn-link nav-link" href="admin/register.html">Signup <i class="fa fa-user"></i></a>
                </li>
          </ul>
        </div>
      </nav>
      
      
      <!-- page Container -->
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <!-- Carousel Start -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="images/slide1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/slide2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/slide3.jpg" alt="Third slide">
                        </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!-- Carousel Ends -->

              </div>
          </div>
          <!-- Product category -->
          <div class="row">
            <p aria-hidden="true">
                <span class="placeholder col-12"></span>
                <hr>
                    <h1 class="text-muted">Welcome to MDM</h1>
                <hr/>
            </p>
          </div>
          <div class="row">
            <div class="card-deck">
              <?php 
                  require_once("scripts/dbconnect.php");
                  $sql = "SELECT * FROM `movies` JOIN categories ON movies.cat_id=categories.id;";
                  if($result = $conn->query($sql)){
                      while($row = $result->fetch_assoc()){
                      
                        ?>
                        <div class="card">
                          <img src="<?php echo $row["image"]; ?>" class="card-img-top" alt="<?php echo $row["title"]; ?>">
                          <div class="card-body">
                            <h5 class="card-title">Movie Title: <b><?php echo $row["title"]; ?></b></h5>
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Release Date: <b><?php echo $row["date"]; ?></b></li>
                            <li class="list-group-item">Genres: <b><?php echo $row["name"]; ?></b></li>
                            <li class="list-group-item">Ratings: <b><?php echo $row["ratings"]; ?></b></li>
                          </ul>
                      </div>
                        
                        <?php
                      }
                  
                  }
                  else{
                      echo($conn->error);
                  }
              ?>
            </div>
          </div>
         
          
          <!-- Product category Ends -->
          <div class="row">
            <p aria-hidden="true">
                <span class="placeholder col-6"></span>
                <hr>
            </p>
          </div>
        
    </div>
    <!-- Footer -->
<footer class="page-footer font-small bg-dark text-white pt-4">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
  
      <!-- Grid row -->
      <div class="row">
  
        <!-- Grid column -->
        <div class="col-md-6 mt-md-0 mt-3">
  
          <!-- Content -->
          <h5 class="text-uppercase">About MDM</h5>
          <p>The Movie Database Manager is a popular, user editable database for movies and TV shows.
          Our focus is on building high quality data that's easy to edit and view,
          You can view movie poster release dates ratings etc. 
        </p>
        </div>
        <!-- Grid column -->
  
        <hr class="clearfix w-100 d-md-none pb-3">
  
        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">
            <img src="images/MDM.png" width="250" height="150" alt="Logo">
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">
  
          <!-- Links -->
          <h5 class="text-uppercase">Links</h5>
  
          <ul class="list-unstyled">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="admin/index.php">Dashboard</a>
            </li>
            <li>
              <a href="admin/movies.php">Movies</a>
            </li>
            <li>
              <a href="admin/login.html">Login</a>
            </li>
          </ul>
  
        </div>
        <!-- Grid column -->
  
      </div>
      <!-- Grid row -->
  
    </div>
    <!-- Footer Links -->
  
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2022 Copyright: MDM </div>
    <!-- Copyright -->
  
  </footer>
  <!-- Footer -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script>
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const msg = urlParams.get('msg');
if(msg !=undefined){
  alert(msg);
}


</script>
</body>
</html>