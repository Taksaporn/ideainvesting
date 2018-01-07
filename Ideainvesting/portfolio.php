<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Your idea</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">
  </head>

  <body>

    <div class="tagline-upper text-center text-heading text-shadow text-black mt-3 d-none d-lg-block">IDEA INVESTING
    <form action="redirectAddDatetoday.php" method="post">
      <?php 
        include 'databaseConnect.php';
        $resultscalendar=$conn->query("SELECT * FROM idea " );
        while ($rowcalendar=$resultscalendar->fetch_assoc()) 
        {
          $dateToday=$rowcalendar['dateToday'];
        }
        echo '<input type="Date" id="datepicker" name="setdateToday" class="boxdate" value='.$dateToday.'>';
      ?>
       <button type="submit" class="buttonsetdate btn-primary" >Set Date</button>
    </form>
    </div>

    <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-light bg-faded ">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Idea investing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active px-lg-2 ">
              <a class="nav-link text-uppercase text-expanded " href="performance.php">portfolio</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="portfolio.php">your idea</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="createIdea.php">Build an Idea</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="transaction.php">Transactions</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="index.php">| Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="bg-faded p-4 my-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style=" color: black; ">Idea Name
              <a href="redirectbeforegotocreateidea.php" class="btn btn-info" role="button" style="margin-left: 20px">Build a Idea</a></th>
              <th>Status</th>
            </tr>
          </thead>
            <tbody>
              <?php
              $UserID = 1;
                include 'databaseConnect.php';
                //<!while loop to fetch stock list!>
                          $result1 = $conn->query("SELECT * FROM idea WHERE UserID = $UserID" );
                           while($row1 = $result1->fetch_assoc())
                              {   $ideaID = $row1['IdeaID'];
                                  $Name = $row1['InvestName'];
                                  $investamount=$row1['InvestAmount'];
                                  if ($investamount==0) 
                                  {
                                    echo '<tr>
                                    <td><a style="text-decoration: none;  color: black; " href="ideaDetail.php?id='.$ideaID.'">'.$Name.'</a></td>'.'<td><I>This idea is not invested</I></td>'
                                    .'<td><a style="text-decoration: none; color: white;" href="Rebalance.php?id='.$ideaID.'" type="button" class="btn btn-info">'.'  Trade'.'</a></td>
                                  </tr>';
                                  }
                                  else
                                  {
                                    echo '<tr>
                                    <td><a style="text-decoration: none;  color: black; " href="ideaDetail.php?id='.$ideaID.'">'.$Name.'</a></td><td>฿'.number_format($investamount)
                                    .'</td><td></td>
                                  </tr>';
                                  }
                          }
                ?>
                <!--end while loop-->
            </tbody>
        </table>
    </form>
      </div>
    </div>

    <footer class=" text-center py-5">
      <div class="container">
        <p class="m-0" style=" color:white; ">Copyright &copy; Taksaporn&Theeranite</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>