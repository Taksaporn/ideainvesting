<!DOCTYPE html>
<html lang="en">

  <head>
     <?php include 'databaseConnect.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rebalance</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">
  </head>

  <body>
    <div class="tagline-upper text-center text-heading text-shadow text-black mt-3 d-none d-lg-block" style=" font-weight: normal">IDEA INVESTING
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
            <li class="nav-item active px-lg-2">
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
      <!--  table detail header -->
      <table class="table table-striped">
          <thead>
            <tr>
              <th style=" color: black; ">Idea Name</th>
              <th style=" color: black; ">Current Idea Value</th>
              <th style=" color: black; ">Return to Date</th>
            </tr>
          </thead>
          <tbody>
        <?php
          include 'databaseConnect.php';
          $UserID = 1;
          $ideaID = $_GET['id'];

          if ($_SERVER['REQUEST_METHOD']=="POST") 
          {
            $getMoney=$_POST['inputmoney'];
          }
          
          $result1 = $conn->query("SELECT * FROM idea WHERE ideaID = $ideaID" );
          while($row1 = $result1->fetch_assoc())
          {   
            $ideaID = $row1['IdeaID'];
            $Name = $row1['InvestName'];
            $investamount=$row1['InvestAmount'];
            $ReturnInvest=$row1['ReturnInvest'];
            if ($ReturnInvest<$investamount) 
            {
            echo '<tr>
                    <td><a style=" color: red;">'.$Name.'</a></td>'.
                    '<td><a style=" color: red;">฿'.$investamount.'</a></td>'.
                    '<td><a style=" color: red;">฿'.$ReturnInvest.'</a></td>'.
                  '</tr>';
              }
            else
            {
              echo '<tr>
                      <td><a style=" color: green;">'.$Name.'</a></td>'.
                      '<td><a style=" color: green;">฿'.number_format($investamount).'</a></td>'.
                      '<td><a style=" color: green;">฿'.number_format($ReturnInvest).'</a></td>'.
                    '</tr>'; 
            }
        }
        //<!-- input money for idea -->
        ?>
        </tbody>
        </table><br><!-- end table detail header -->

        <!-- input money for idea -->
        <form action="redirectAddInvestamount.php" name="inputmoney"  id ="inputmoney" method="post">
          <div >
            <a class="symbolbaht" id="symbolbaht"></a><br>
            <input type="hidden" value= "<?php echo $ideaID ?>" name="ideaID">
            <input type="hidden" value= "<?php echo $getMoney; ?>" name="inputmoney">
            <button class="btn btn-info " type="submit" > Confirm Trade</button>
          </div>
        </form>

        <!-- input money for idea -->
        <!--  table detail stocks idea -->
        <h4>Money Preview : <?php echo $getMoney; ?></h4>
        <h4 style=" font-weight: normal"><br><b>Stocks in This Idea<b></h4>
        <table class="table table-striped" style="font-size: 12px">
          <thead>
            <tr>
              <th >Name Company</th>
              <th >Symbol</th>
              <th >Action</th>
              <th >Weight in Idea</th>
              <th >Price</th>
              <th >Shares</th>
              <th >Est. amount</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $resultsymbol= $conn->query("SELECT * FROM stockidea WHERE ideaID=$ideaID");
            while($rowsymbol=$resultsymbol->fetch_assoc())
            {
              $Symbol=$rowsymbol['Symbol'];
              $Percent=$rowsymbol['Percent'];
              $resultlistofcompanies = $conn->query("SELECT * FROM listofcompanies WHERE Symbol='$Symbol'");
              while($rowlistofcompanies = $resultlistofcompanies->fetch_assoc())
              { 
                $Company=$rowlistofcompanies['Company'];
                  echo '<tr style="font-weight: normal;">
                    <td><a  id="Company">'.$Company.'</a></td>
                    <td><a  id="Symbol">'.$Symbol.'</a></td>
                    <td><a  id="Action">buy</a></td>
                    <td><a  id="Weight">'.$Percent.'</a></td>';
              }
	            $dateToday='2016-12-30';
              //$Firstdate='2014-01-02';
              $resultGetdateToday = $conn->query("SELECT dateToday FROM idea WHERE ideaID = $ideaID");
              $rowGetdateToday= $resultGetdateToday->fetch_array();  //Get price when create the idea
              $GetdateToday = $rowGetdateToday[0];

	            $resultprice = $conn->query("SELECT * FROM historyprice WHERE Symbol='$Symbol' AND datePrice='$GetdateToday'");
	            while ($rowprice = $resultprice->fetch_assoc()) 
	            {
                  $Priceclose=$rowprice['Priceclose'];
                  $shareowns=intval(($getMoney*($Percent/100))/$Priceclose);
	                echo '<td><a  id="Price">'.$Priceclose.'</a></td>
                        <td><a  id="shares">'.intval($shareowns).'</a></td>
                        <td><a  id="amount">'.($shareowns*$Priceclose).'</a></td></tr>';
	            }	
            }
          ?>
          </tbody>
        </table>                            
      </div>

    <footer class=" text-center py-5">
      <div class="container">
        <p class="m-0" style="color: white; font-weight: normal">Copyright &copy; Taksaporn&Theeranite </p>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>