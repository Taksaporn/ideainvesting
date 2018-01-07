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
          <?php  
            $resultGetcash = $conn->query("SELECT cash FROM user WHERE userID = 1");
            $rowGetcash= $resultGetcash->fetch_array(); //Get price when create the idea
            $cash = $rowGetcash[0];
          ?>
            <tr>
              <th style=" color: black; ">Idea Name</th>
              <th style=" color: black; ">Current Idea Value</th>
              <th style=" color: black; ">Return to Date</th>
              <th style=" color: green; font-size: 28px;">Cash:<?php echo number_format($cash, 2); ?> </th>
              
            </tr>
          </thead>
          <tbody>
        <?php
          include 'databaseConnect.php';
          $UserID = 1;
          $ideaID = $_GET['id'];
          $result1 = $conn->query("SELECT * FROM idea WHERE ideaID = $ideaID" );
          while($row1 = $result1->fetch_assoc())
          {   
            $ideaID = $row1['IdeaID'];
            $Name = $row1['InvestName'];
            $investamount=$row1['InvestAmount'];
            $ReturnInvest=$row1['ReturnInvest'];
            if($investamount>0)
            {
              if ($ReturnInvest<$investamount) 
              {
                echo '<tr>
                        <td><a style=" color: red;">'.$Name.'</a></td>'.
                        '<td><a style=" color: red;">฿'.number_format($investamount).'</a></td>'.
                        '<td><a style=" color: red;">฿'.number_format($ReturnInvest).'</a></td>'.
                        '<td><button style="text-decoration: none; color: white;" class="btn btn-info" onclick="sellall()" id="sellall">'.'sell all'.'</button></td>'.
                      '</tr>';
              }
              else
              {
                echo '<tr>
                        <td><a style=" color: green;">'.$Name.'</a></td>'.
                        '<td><a style=" color: green;">฿'.number_format($investamount).'</a></td>'.
                        '<td><a style=" color: green;">฿'.number_format($ReturnInvest).'</a></td>'.
                        '<td><button style="text-decoration: none; color: white;"  class="btn btn-info" onclick="sellall()" id="sellall" >'.'sell all'.'</button></td>'.
                      '</tr>'; 
              }
            }
            else
            {
              if ($ReturnInvest<$investamount) 
              {
                echo '<tr>
                        <td><a style=" color: red;">'.$Name.'</a></td>'.
                        '<td><a style=" color: red;">฿'.number_format($investamount).'</a></td>'.
                        '<td><a style=" color: red;">฿'.number_format($ReturnInvest).'</a></td>'.
                        '<td><button style="text-decoration: none; color: white;" class="btn btn-info" onclick="buysum()" id= "buy">'.'buy'.'</button></td>'.
                      '</tr>';
              }
              else
              {
                echo '<tr>
                        <td><a style=" color: green;">'.$Name.'</a></td>'.
                        '<td><a style=" color: green;">฿'.number_format($investamount).'</a></td>'.
                        '<td><a style=" color: green;">฿'.number_format($ReturnInvest).'</a></td>'.
                        '<td><button style="text-decoration: none; color: white;"  class="btn btn-info" onclick="buysum()" id= "buy" >'.'buy'.'</button></td>'.
                      '</tr>'; 
              }
            }
        }
        //<!-- input money for idea -->   
        ?>
        </tbody>
        </table><br><!-- end table detail header -->
        
        <!-- redirect money to previeworder page-->
        <form action="previeworder.php?id=<?php echo $ideaID ?>" class="boxtradepreview" style="display:none;" id="inputpreview" name="inputpreview" method="post">
          Input your money for preview orders
          <input type="text" id="inputmoney" class="inputtrade" style="margin-left: 20px; margin-top: 10px;" name="inputmoney">
          <button style="text-decoration: none; color: white; " class="btn btn-info previeworder" type="submit" >previeworder</button>
        </form>
        <br><br><br><br><br><br>
        
        <!--  table detail stocks idea -->
        <h4 style=" font-weight: normal"><br><br><b>Stocks in This Idea<b></h4>
        <div id="showbuttonconfirm">
          <a href="sellall.php?ideaID=<?php echo $ideaID ?>" id="confirmsellall" style="text-decoration: none; color: white; display:none;" class="btn btn-danger previeworder">Confirm to sell</a>
        </div>
        
        <table class="table table-striped" style="font-size: 12px">
          <thead>
            <tr>
              <th >Name Company</th>
              <th >Symbol</th>
              <th >Action</th>
              <th >Price</th>
              <th >Weight in Idea</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $i = 0;
            $ideaID = $_GET['id'];
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
                    <td><a  id="Action'.$i.'"></a></td>
                    <td><a  id="Price">'.$Symbol.'</a></td>
                    <td><a  id="Weight">'.$Percent.'</a></td>
                    <td><a  id="shares"></a></td>
                    <td><a  id="amount"></a></td>
                  </tr>';
              }
              $i++;
            }
          ?>
              <script>
                function buysum() 
                {
                  document.getElementById("Action0").innerHTML = "Buy";
                  document.getElementById("Action1").innerHTML = "Buy";
                  document.getElementById("Action2").innerHTML = "Buy";
                  document.getElementById("Action3").innerHTML = "Buy";
                  document.getElementById("Action4").innerHTML = "Buy";
                  document.getElementById("Action5").innerHTML = "Buy";
                  document.getElementById("Action6").innerHTML = "Buy";
                  document.getElementById("Action7").innerHTML = "Buy";
                  document.getElementById("Action8").innerHTML = "Buy";
                  document.getElementById("symbolbaht").innerHTML = "Amount to invest ฿10,000 minimum";
                }

                function sellall() 
                {
                  //document.getElementById("Action").innerHTML = "sell all";
                  document.getElementById("Action0").innerHTML = "sell all";
                  document.getElementById("Action1").innerHTML = "sell all";
                  document.getElementById("Action2").innerHTML = "sell all";
                  document.getElementById("Action3").innerHTML = "sell all";
                  document.getElementById("Action4").innerHTML = "sell all";
                  document.getElementById("Action5").innerHTML = "sell all";
                  document.getElementById("Action6").innerHTML = "sell all";
                  document.getElementById("Action7").innerHTML = "sell all";
                  document.getElementById("Action8").innerHTML = "sell all";
                  document.getElementById("symbolbaht").innerHTML = "Sell entire position(฿)";
                }

              </script>
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

<script>
  $(document).ready(function()
  {
    $("#buy").click(function()
    {
      $("#inputpreview").toggle();
      $("#confirmsellall").hide();
    });

    $("#sellall").click(function()
    {
      $("#confirmsellall").toggle();
      $("#inputpreview").hide();

    });
  });
</script>



