<?php include_once 'newhello.php'; ?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" href="bluespace.ico">
   <link rel="stylesheet" href="customchart.css">
   <link rel="stylesheet" href="slider.css">
  <title>CO2 Analysis System</title>
  </head>
  <body>
    <form method="POST">
        <div class="switch-container">
            <label class="switch">
                <input type="checkbox" id="saveData" name="saveData">
                <span class="slider"></span>
            </label>
            <input type="submit" id="saveButton" value="Save Data">
        </div>
    </form>
    <div class="container">
        <div class="chart">
            <canvas id="barchart" width="450" height="500"></canvas>
        </div> 
    	<div class="solorta">
    	<div class="chart">
            <canvas id="myChart2"  width="500" height="500"></canvas>
        </div> 
    	</div>
        <div class="bigcreate">
            <div class="secondcontainer">
    		 <div class="chart">
    		 <canvas id="doughnut"  width="300" height="300"></canvas>
    		 </div>
    <div class="create">
    <div class="spacecreate1">
    <font color="white" size=4><?php echo $PCoef; ?></font>
    </div>
    <div class="spacecreate2">
    <font color="white" size=4><?php echo $DHT; ?></font>
    </div>
    <div class="spacecreate3">
    <font color="white" size=3><?php echo $toplam11; ?> <?php echo $toplam12; ?></font>
    </div>
    </div>
    </div>
    </div>
    </div>
    
<script>
    <?php
        if (isset($toplam3)) echo "const toplam3 = $toplam3;\n\t";
        if (isset($toplam4)) echo "const toplam4 = $toplam4;\n\t";
        if (isset($toplam5)) echo "const toplam5 = $toplam5;\n\t";
        if (isset($toplam6)) echo "const toplam6 = $toplam6;\n\t";
        if (isset($toplam7)) echo "const toplam7 = $toplam7;\n\t";
    ?>
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="datacolor.js"></script>
<script src="chart2.js"></script>
<script src="slider.js"></script>

<script>
 const ctx = document.getElementById('barchart').getContext('2d');
 const barchart = new Chart(ctx,hello('bar'));    
 const ctx2 = document.getElementById('doughnut').getContext('2d');
 const doughnut = new Chart(ctx2,hello('doughnut'));    
</script>
</body>
</html>