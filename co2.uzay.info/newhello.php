<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="../datavalue.js"></script>
<script src="../datavalue2.js"></script>

  <?php
        include_once 'db.php';
        
        $PCoef = '×' . ($_COOKIE["toplam2"]) . ' / ' . ($_COOKIE["toplam1"]) . 's';
        $toplam3 = $_COOKIE["toplam3"];
        $toplam4 = $_COOKIE["toplam4"];
        $toplam5 = $_COOKIE["toplam5"];
        $toplam6 = $_COOKIE["toplam6"];
        $toplam7 = $_COOKIE["toplam7"];
        $toplam8 = $_COOKIE["toplam8"];
        $per = '%' . ($toplam8);
        $DHT = round(($_COOKIE["toplam9"] / 10) - 140, 4) . '°C %' . round(($_COOKIE["toplam10"] / 10) - 100, 4);
        $toplam11 = $_COOKIE["toplam11"] * pow(10,-7) - 90;
        $toplam12 = $_COOKIE["toplam12"] * pow(10,-7) - 180;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
            $sql = "INSERT INTO CO2 (DHT, SpaceData, TheoCO2, PCoef, CO2, CH4, C2H5OH, CO, lat, lng)
                    VALUES ('" . $DHT . "', '" . $per . "', '" . $toplam3 . "ppm', '" . $PCoef . "', '" . $toplam4 . "ppm', '" . $toplam5 . "ppm', '" . $toplam6 . "ppm', '" . $toplam7 . "ppm', '" . $toplam11 . "', '" . $toplam12 . "')";

                    if ($conn->query($sql) === TRUE) {
                    } 
                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                
                    $conn->close();
            }
?>   