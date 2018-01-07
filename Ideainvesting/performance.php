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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

   
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

          echo '<input type="Date" id="" name="setdateToday" class="boxdate" value='.$dateToday.'>';
        ?>
       <button type="submit" class="buttonsetdate btn-primary" >Set Date</button>
    </form>
  </div>
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
        include 'databaseConnect.php';
            
        //start calculate performmance

        $truncatetable="TRUNCATE table sumcalculatestock";
        $conn->query($truncatetable);
        $resultgetDatechange=$conn->query("SELECT dateToday FROM idea ");
        $rowgetDatechange = $resultgetDatechange->fetch_array();
        $getDatechange = $rowgetDatechange[0];
        
        $UserID = 1;
        
       
        $result3 = $conn->query("SELECT * FROM idea where InvestAmount !=0" );
        while($row3 = $result3->fetch_assoc())
        {
          $IdeaID=$row3['IdeaID'];
          performance($IdeaID);
        }
        

          //update money
          $sumport=0;
          $Positions=0;
          $suminvest=0;
          $cash=0;
          $resultGetmoney = $conn->query("SELECT usermoney FROM user WHERE userID = 1");
          $rowGetmoney= $resultGetmoney->fetch_array(); //Get price when create the idea
          $usermoney = $rowGetmoney[0];

          $resultsumport=$conn->query("SELECT * FROM idea WHERE userID=$UserID");
          while ( $rowsumport = $resultsumport->fetch_assoc()) 
          {
            $UserID=$rowsumport['UserID'];
            $sumport+=$rowsumport['ReturnInvest'];
            $suminvest+=$rowsumport['InvestAmount'];
          }

          $resultGetcash = $conn->query("SELECT cash FROM user WHERE userID = 1");
          $rowGetcash= $resultGetcash->fetch_array(); //Get price when create the idea
          $cash = $rowGetcash[0];

           
          //$cash=($usermoney-$suminvest); //cash in account 
          $resultportfolio=$sumport+$cash;//all value in account   

          $sqlupdateposition= "UPDATE user SET positions = $sumport WHERE userID = 1 ";
          $conn->query($sqlupdateposition);

          $sqlupdateportfolioValue= "UPDATE user SET portfolioValue = $resultportfolio WHERE userID = 1 ";
          $conn->query($sqlupdateportfolioValue); 

          //$sqlupdatecash= "UPDATE user SET cash = $cash WHERE userID = 1 ";
          //$conn->query($sqlupdatecash);    
          
          $resultuser=$conn->query("SELECT * FROM user WHERE userID=$UserID");
          while ( $rowuser = $resultuser->fetch_assoc()) 
          {
            $portfolioValue=$rowuser['portfolioValue'];
            $positions=$rowuser['positions'];
            $cash=$rowuser['cash'];
          }

          //end update money
          //show over all return performance
          if ($positions!=0) 
          {
            echo '<h3><b>Investment Summary</b></h3>
              <div class="boxport" align="center">
              <a style="font-size:10px">Portfolio Value<br>
              <a style="font-size:30px">฿'.number_format($portfolioValue, 2).'</a></a>
                <div class="boxcurrent" align="center">
                <a  style="font-size:10px">Positions<br>
                <a style="font-size:30px">฿'.number_format($positions, 2).'</a></a>
                  <div class="boxcash" align="center">
                    <a  style="font-size:10px">Cash<br>
                    <a style="font-size:30px">฿'.number_format($cash, 2).'</a></a>
                  </div>
                </div>
              </div><br><br>';
          }
          else
          {
             echo '<h3><b>Investment Summary</b></h3>
              <div class="boxport" align="center">
              <a style="font-size:10px">Portfolio Value<br>
              <a style="font-size:30px">฿'.number_format($cash, 2).'</a></a>
                <div class="boxcurrent" align="center">
                <a  style="font-size:10px">Positions<br>
                <a style="font-size:30px">฿'.number_format($positions, 2).'</a></a>
                  <div class="boxcash" align="center">
                    <a  style="font-size:10px">Cash<br>
                    <a style="font-size:30px">฿'.number_format($cash, 2).'</a></a>
                  </div>
                </div>
              </div><br><br>';
          }
         
          
          //end show over all return performance

          //show return each idea   
          echo '<h4><b>Investments
          <a href="performance.php" style="text-decoration: none; color: white;" type="button" class="btn btn-info">View idea</a>&nbsp;&nbsp;
          <a href="showstockport.php?UserID='.$UserID.'" style="text-decoration: none; color: white;" type="button" class="btn btn-info">View stock</a></b></h4>
                  <table class="table table-striped" width="80%" style="color:black;">
                    <thead>
                      <tr>
                        <td align="left" ><B>Idea Name</B></td>
                        <td align="left"><B>date Purchase</B></td>
                        <td align="left"><B>Cost</B></td>
                        <td align="left"><B>Current Value</B></td>
                        <td align="left"><B>Profit</B></td>
                        <td align="left"><B>Return to Date(%)</B></td>
                        <td align="left"><B>Detail</B></td>
                        <td align="left"><B>Rebalance</B></td>
                      </tr>  
                    </thead>';
                 
                 
          $result1 = $conn->query("SELECT * FROM idea WHERE UserID = $UserID" );
          while($row1 = $result1->fetch_assoc())
          {   
            $ideaID = $row1['IdeaID'];
            $Name = $row1['InvestName'];
            $InvestAmount=$row1['InvestAmount'];
            $DateCreated=$row1['DateCreated'];
            $dateToday=$row1['dateToday'];
            $ReturnInvest= $row1['ReturnInvest'];
            $ReturnPercent = bcadd($row1['ReturnPercent'],'0',2);
            if( $InvestAmount!=0) 
            {
              if ($ReturnPercent<0) 
              {
                echo '<tbody>
                        <tr>
                        <td><a style="text-decoration: none; color:black; ">'.$Name.'</a></td>
                        <td><a style="text-decoration: none; color:black; ">'.$DateCreated.'</a></td>'.
                        '<td>฿'.number_format($InvestAmount, 2).'</td>'.
                        '<td>฿'.number_format($ReturnInvest, 2).'</td>'.
                        '<td style="color:red ; ">฿'.number_format($ReturnInvest-$InvestAmount, 2).'</td>'.
                        '<td style="color:red ; ">'.$ReturnPercent.'</td>'.'
                        <td><a style="text-decoration: none ; color:white;" href="ideaDetail.php?id='.$ideaID.'" type="button" class="btn btn-info">'.' view idea'.'</a></td>'.
                        '<td><a style="text-decoration: none ; color:white;" href="Rebalance.php?id='.$ideaID.'" type="button" class="btn btn-info">'.' Trade'.'</a></td>'.
                        '</tr>';
              }
              else
              {
                echo '<tr>
                        <td><a style="text-decoration: none; color:black; ">'.$Name.'</a></td>
                        <td><a style="text-decoration: none; color:black; ">'.$DateCreated.'</a></td>'.
                        '<td>฿'.number_format($InvestAmount, 2).'</td>'.
                        '<td>฿'.number_format($ReturnInvest, 2).'</td>'.
                        '<td style="color:green; ">฿'.number_format($ReturnInvest-$InvestAmount, 2).'</td>'.
                        '<td style="color:green; ">'.$ReturnPercent.'</td>'.'
                        <td><a style="text-decoration: none ; color:white;" href="ideaDetail.php?id='.$ideaID.'" type="button" class="btn btn-info">'.' view idea'.'</a></td>'.
                        '<td><a style="text-decoration: none ; color:white;" href="Rebalance.php?id='.$ideaID.'" type="button" class="btn btn-info">'.' Trade'.'</a></td>'.
                      '</tr>
                    </tbody>';
              }
            }
          }
        //end calculate performmance
        //end show return each idea 
      ?>
        </table>
      </div>
    </div>
</body>

<footer class=" text-center py-5">
  <div class="container">
    <p class="m-0" style=" color:white; ">Copyright &copy; Taksaporn&Theeranite</p>
  </div>
</footer>

</html>

<?php
  function performance($IdeaID)
  {
    $UserID = 1;
    include 'databaseConnect.php';

    $pricereturn=0;
    $priceToday=0;
    $returnInvest=0;
    //fetch_array InvestAmount

    $sqlSetReturninvest = "UPDATE idea SET ReturnInvest = 0  WHERE ideaID = '$IdeaID'";
    $conn->query($sqlSetReturninvest);

    $sqlSetReturnpercent = "UPDATE idea SET ReturnPercent = 0 WHERE ideaID = '$IdeaID'";
    $conn->query($sqlSetReturnpercent);

    $resultInvestAmount=$conn->query("SELECT oldinvest FROM idea where IdeaID = $IdeaID");
    $rowInvestAmount = $resultInvestAmount->fetch_array();
    $InvestAmount = $rowInvestAmount[0];
    //end fetch_array InvestAmount

    //fetch_array datePurchase
    $resultdatePurchase=$conn->query("SELECT DateCreated FROM idea where IdeaID = $IdeaID");
    $rowdatePurchase = $resultdatePurchase->fetch_array();
    $datePurchase = $rowdatePurchase[0];
    //end fetch_array datePurchase

    //fetch_array dateToday
    $resultdateToday=$conn->query("SELECT dateToday FROM idea where IdeaID = $IdeaID");
    $rowdateToday = $resultdateToday->fetch_array();
    $dateToday = $rowdateToday[0];
    //end fetch_array dateToday

    //check datePrice of stock 
    $resultfinddatePurchase=$conn->query("SELECT datePrice FROM historyprice where datePrice='$datePurchase'");
    $rowfindfirstdate = $resultfinddatePurchase->fetch_array();
    $datePurchase = $rowfindfirstdate[0];
    while ($datePurchase==null) 
    {
      $startDate = date_create($datePurchase);
      date_modify($startDate, '+1 day');
      $datePurchase=date_format($startDate, 'Y-m-d');
    }
    //end check datePrice of stock 


    //check datePrice of stock where dateToday
    $resultfinddateToday=$conn->query("SELECT datePrice FROM historyprice where datePrice='$dateToday'");
    $rowfinddateToday = $resultfinddateToday->fetch_array();
    $dateToday = $rowfinddateToday[0];
    while ($dateToday==null) 
    {
      $dateTodaytemp = date_create($dateToday);
      date_modify($dateTodaytemp, '+1 day');
      $dateToday=date_format($dateTodaytemp, 'Y-m-d');
    }
    //end check datePrice of stock where dateToday

    //find PriceClose where datePurchase and dateToday
    $result4 = $conn->query("SELECT * FROM stockidea WHERE ideaID = $IdeaID" );
    while($row4 = $result4->fetch_assoc())
    {
      $symbol = $row4['Symbol'];
      $percent = $row4['Percent'];
      //$investeachStock=$Invest*($percent/100);

      $result2 = $conn->query("SELECT Priceclose FROM historyprice WHERE datePrice = '$datePurchase' and Symbol='$symbol'");
      $rowPriceclosePurchase=$result2->fetch_array();
      $stockprice=$rowPriceclosePurchase[0];
      
      $amountStock1=intval(($InvestAmount*($percent/100))/$stockprice);
      $investStock1=$amountStock1*$stockprice;

      $result5 = $conn->query("SELECT Priceclose FROM historyprice WHERE datePrice = '$dateToday' and Symbol='$symbol'");
      $rowPricecloseToday=$result5->fetch_array();
      $priceToday=$rowPricecloseToday[0];

      $sql="INSERT INTO sumcalculatestock (userID ,ideaID ,Investamount ,stockName ,stockamount ,priceCreate ,priceToday ,returnInvest) VALUES ('$UserID', '$IdeaID', '$investStock1', '$symbol', '$amountStock1', '$stockprice', '$priceToday', '$returnInvest')";
      $conn->query($sql);
      //$sql2 = "UPDATE sumcalculatestock SET priceToday = '$priceToday' WHERE stockName = '$symbol' ";
      //$conn->query($sql2);
    }
    //end find PriceClose where datePurchase and dateToday

    //calculate Return invest
    $result6 = $conn->query("SELECT * FROM sumcalculatestock WHERE ideaID = '$IdeaID'");
    while($row6 = $result6->fetch_assoc())
    {
      $ReturnInvest= doubleval($row6['stockamount']*$row6['priceToday']);
      $pricereturn += $ReturnInvest;
    }

    $sql4 = "UPDATE idea SET ReturnInvest = '$pricereturn' WHERE ideaID = '$IdeaID' ";
    $conn->query($sql4);
    //end calculate Return invest

    $result1 = $conn->query("SELECT ReturnInvest FROM idea WHERE ideaID = '$IdeaID'");
    $rowReturninvest = $result1->fetch_array();
    $ReturnInvest= $rowReturninvest[0];

    $resultfindInvestamount = $conn->query("SELECT InvestAmount FROM idea WHERE ideaID = '$IdeaID'");
    $rowfindInvestamount = $resultfindInvestamount->fetch_array();
    $InvestAmount= $rowfindInvestamount[0];

    $findReturnPercent=doubleval( (($ReturnInvest*100)/$InvestAmount) )-100;

    //echo $findReturnPercent.'<br>';
    //echo $InvestAmount.'<br>';
    //echo $ReturnInvest.'<br>';

    $sql5 = "UPDATE idea SET ReturnPercent = $findReturnPercent WHERE ideaID = '$IdeaID' ";
    $conn->query($sql5);

    mysqli_close($conn);
  }
?>
