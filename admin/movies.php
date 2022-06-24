<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MDM - Categories</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        
    </head>
    <?php
    session_start();
    if(isset($_SESSION['login_user']) !=true){
        header('location: login.html?msg="You must login first"');
    }
    require_once("../scripts/dbconnect.php");
    ?>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><img src="../images/MDM.png" height="100" width="120" alt="Logo"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    <?php echo $_SESSION['login_user']; ?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../scripts/user.php?logout=true">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-list-alt" aria-hidden="true"></i></div>
                                Categories
                            </a>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-list-alt" aria-hidden="true"></i></div>
                                Movies
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['login_user']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Movies</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Movies</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3>Add New Movie</h3>
                                <form method="post" action="../scripts/movies.php" enctype="multipart/form-data">
                                    <div class="row">
                                      <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Movie Title</label>
                                            <input name="movie" type="text" class="form-control" placeholder="Movie Name" required>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Release Date</label>
                                            <input name="rdate" type="date" class="form-control" placeholder="Release Date" required>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Genres</label>
                                            <select id="" class="form-control" name="genres" required>
                                            <?php 
                                                $checksql = "SELECT * FROM `categories`";
                                                $result = $conn->query($checksql);
                                            
                                                if(mysqli_num_rows($result) > 0)
                                                {
                                                while($row = $result->fetch_assoc()){
                                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                }
                                                }
                                                else{
                                                echo $conn->error;
                                                }
                                            ?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Ratings</label>
                                            <input type="number" class="form-control" name="ratings" min="1" max="10">
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Poster</label>
                                            <input type="file" class="form-control" name="image" required>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <br/>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit" name="addmovie">Add Movie</button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Movies
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Movie Title</th>
                                            <th>Release Date</th>
                                            <th>Genres</th>
                                            <th>Ratings</th>
                                            <th>Poster</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Movie Title</th>
                                            <th>Release Date</th>
                                            <th>Genres</th>
                                            <th>Ratings</th>
                                            <th>Poster</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            require_once("../scripts/dbconnect.php");
                                            $sql = "SELECT * FROM `movies` JOIN categories ON movies.cat_id=categories.id;";
                                            if($result = $conn->query($sql)){
                                                while($row = $result->fetch_assoc()){
                                                echo('<tr id="'.$row["id"].'"><td>'.$row["id"].'</td><td>'.$row["title"].'</td><td>'.$row["date"].'</td><td>'.$row["name"].'</td><td>'.$row["ratings"].'</td><td><img src="../'.$row["image"].'" height="70" width="70" alt="Poster"></td><td><button class="btn btn-info edit-btn" type="button" data-toggle="modal" data-target="#editmodal" data-title="'.$row['title'].'" data-id="'.$row['id'].'" data-date="'.$row['date'].'" data-ratings="'.$row['ratings'].'" data-cat="'.$row['cat_id'].'">Edit</button>
                                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deletemodal" onclick="deletemove('.$row["id"].')">Delete</button></td></tr>');
                                                }
                                            
                                            }
                                            else{
                                                echo($conn->error);
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; MDM 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<!-- Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodalLabel">Update Movie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="../scripts/movies.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" class="id" value="">
            <div class="row">
                <div class="form-group">
                    <label for="">Movie Title</label>
                    <input name="movie" type="text" class="form-control title" placeholder="Movie Name" required>
                </div>
                <div class="form-group">
                    <label for="">Release Date</label>
                    <input name="rdate" type="date" class="form-control rdate" placeholder="Release Date" required>
                </div>
                <div class="form-group">
                    <label for="">Genres</label>
                    <select id="" class="form-control cat" name="genres" required>
                    <?php 
                        $checksql = "SELECT * FROM `categories`";
                        $result = $conn->query($checksql);
                    
                        if(mysqli_num_rows($result) > 0)
                        {
                        while($row = $result->fetch_assoc()){
                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        }
                        }
                        else{
                        echo $conn->error;
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ratings</label>
                    <input type="number" class="form-control ratings" name="ratings" min="1" max="10">
                </div>
                
                <div class="form-group">
                    <label for="">Poster</label>
                    <input type="file" class="form-control image" name="image" required>
                </div>
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" type="submit" name="updatemovie">Update Movie</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Delete modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Movie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want delete Movie?</p>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="" id="dellink" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>                                           
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
        <script>
            $('#editmodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var title = button.data('title');
            var date = button.data('date');
            var cat = button.data('cat');
            var ratings = button.data('ratings');
            var image = button.data('image');
            var modal = $(this)
            modal.find('.id').val(id);
            modal.find('.title').val(title);
            modal.find('.rdate').val(date);
            modal.find('.cat').val(cat);
            modal.find('.ratings').val(ratings);
            modal.find('.image').val(image);
            });

            function deletemove(id){
                document.getElementById("dellink").href="../scripts/movies.php?delete="+id;
            }

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const msg = urlParams.get('msg');
            if(msg !=undefined){
              alert(msg);
            }
        </script>
    </body>
</html>
