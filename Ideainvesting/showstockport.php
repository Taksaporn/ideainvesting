<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
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
       <button type="submit" class="buttonsetdate" >set Date</button>
    </form></div>
    <!-- Navigation -->
       <nav class="navbar navbar-expand-lg navbar-light bg-faded">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Idea investing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active px-lg-2 ">
              <a class="nav-link text-uppercase text-expanded " href="performance.php" >portfolio</a>
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
    <?php
        $UserID = 1;
        include 'databaseConnect.php';
        $sumport=0;
        $suminvest=0;
        $resultsumport=$conn->query("SELECT * FROM idea WHERE userID=$UserID");
        //$sumport=number_format($resultsumport, 2);
        while ( $rowsumport = $resultsumport->fetch_assoc()) 
        {
          $UserID=$rowsumport['UserID'];
          $sumport+=$rowsumport['ReturnInvest'];
          $suminvest+=$rowsumport['InvestAmount'];
        }
        $resultportfolio=100000+($sumport-$suminvest);
        $cash=100000-$suminvest;

        //show performance
        echo '<h3><b>Investment Summary</b></h3>
          <div class="boxport" align="center">
          <a style="font-size:10px">Portfolio Value<br>
          <a style="font-size:30px">฿'.number_format($resultportfolio, 2).'</a></a>
            <div class="boxcurrent" align="center">
            <a  style="font-size:10px">Positions<br>
            <a style="font-size:30px">฿'.number_format($sumport, 2).'</a></a>
              <div class="boxcash" align="center">
                <a  style="font-size:10px">Cash<br>
                <a style="font-size:30px">฿'.number_format($cash, 2).'</a></a>
              </div>
            </div>
          </div><br><br>';

          //show sum stock page
      
      	echo '<h4><b>Investments
          <a href="performance.php" style="text-decoration: none; color: white;" type="button" class="btn btn-info">View idea</a>&nbsp;&nbsp;
          <a href="showstockport.php?UserID='.$UserID.'" style="text-decoration: none; color: white;" type="button" class="btn btn-info">View stock</a></b></h4>
			<table class="table table-striped">
			    <thead>
			        <tr>
			            <th>stock</th>
			            <th>amount stock</th>
			        </tr>
			    </thead>
			    <tbody>';
			    	$resultqueryStock = $conn->query("SELECT * FROM sumcalculatestock WHERE userID=$UserID GROUP BY stockName" );
			        while($rowqueryStock = $resultqueryStock->fetch_assoc())
			        {   
			        	$ideaID=$rowqueryStock['ideaID'];
			        	$stockName=$rowqueryStock['stockName'];
			        	$stockamount=$rowqueryStock['stockamount'];
			        	if($stockName==$stockName)
			        	{
			        		$resultsumsamestock= $conn->query("SELECT SUM(stockamount)FROM sumcalculatestock WHERE stockName='$stockName'");
			        		$rowsumsamestock= $resultsumsamestock->fetch_array();  //Get price when create the idea
                  $Getstockamount = $rowsumsamestock[0];
					    	  echo '<tr>
					            <td> '.$stockName.'</td>
					            <td>'.$Getstockamount.' </td>
					        </tr>';	
				    	}
			    	}
	?>
			</tbody>
		</table>
    
    </div>
    </div>
    <footer class=" text-center py-5">
      <div class="container">
        <p class="m-0" style=" color:white; ">Copyright &copy; Taksaporn&Theeranite</p>
      </div>
    </footer>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>