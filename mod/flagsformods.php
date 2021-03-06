<?php include "../base.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Charcoal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <script type="text/javascript">var baseURL="<?php echo baseURL();?>"
    $(document).ready(function(){$('.togglebtn').on('click',function(){$(this).toggleClass('active');});
    $('.togglebtn#invalidtoggle').on('click',function(){$('.main-table tr:has(.text-success)').toggle();})
    })
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php  
  if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']) && $_SESSION["isnetworkmod"]==1)  
  {  
  ?>
  <?php echo NavBar($_SESSION["Site"]); ?>
    </div>
    <div class="col-md-offset-1 col-md-10">
    <table class="table main-table">
        <?php
            $result = array();
            $query = PDODatabaseObject()->prepare("SELECT * FROM flags s left join users u  on s.handledBy=u.id WHERE s.handled=1 AND s.toFlag = 1 AND s.site=? ORDER BY s.handleDate desc");
            $query->execute(array($_SESSION["Site"]));
            $flags = $query->fetchAll();
            foreach($flags as $row) {
                echo "<tr class='date-row' id='" . $row['handleDate'] . "'><td>";
                echo "<div class='comment'>";
                echo "<span class='text-primary'><h4 class='site-text text-info" . $row["Text"] .  "'>" . $row["Text"] . " </a></h4></span><span class='text-muted'>marked <strong>" . (($row["wasValid"]==1) ? "<span class='text-success'>valid</span>" : "<span class='text-danger'>invalid</span>") . "</strong> by <span class='text-primary'><strong>" . (($row['ischarcoalmod'] == 1) ? $row["username"] . " &diams;" : (($row['isnetworkmod']==1) ? $row["username"] . " &#9826;" : $row['username'])) . "</strong></span>" . " <span class='text-muted'>" . (($row['handleDate']==NULL) ? "" : TimeElapsed($row["handleDate"])) . "</span></span>";
                echo "</div>";
                echo "</td></tr>";
                array_push($result, $row["PostId"]);
          }
          $result = implode(",",$result);
          echo "<tr class='ids' id='1'><td>";
          echo "<div class='comment'>";
          echo "<span class='text-muted'>" .  $result . "</span>";
          echo "</div>";
          echo "</td></tr>";
          ?>
      </table>
    </div>
<?php
}  
else  
{
  echo '<p>Heh, nice try</p>';
}  
?>  
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </body>
</html>
