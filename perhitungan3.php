<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $_SESSION['judul']." - ".$_SESSION['welcome']." - oleh ".$_SESSION['by'];?></title>
	
    <!-- Bootstrap core CSS -->
    <link href="ui/css/bootstrap.css" rel="stylesheet">
	<link href="ui/css/united.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="ui/css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--script src="./index_files/ie-emulation-modes-warning.js"></script-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
	<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#808080;">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_SESSION['judul'];?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse" style="background-color:#808080;">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="kriteria.php">Data Kriteria</a></li>
			   <li><a href="subkriteria.php">Data Sub Kriteria</a></li>
              <li><a href="alternatif.php">Data Alternatif</a></li>
              <li class="active"><a href="#">Perhitungan</a></li>
			  <li><a href="logout.php">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	  <br><br><br>
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Perhitungan</li>
		</ol>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading" style="background-color:#808080;">Perhitungan</div>
		  <div class="panel-body">
		  
		  		<select name="kain" onchange="location = this.value;">
					<option value="Kain">----Kain----</option>
					<option value="perhitungan.php">Katun</option>
					<option value="perhitungan2.php">Denim</option>
					<option value="perhitungan3.php">Sifon</option>
				</select>
				
			<div class="text-right"><button class="btn btn-primary btn-sm" onclick="myFunction()" style="background-color:#808080;">Print</button></div>
			<center>
				<?php
					
					$koma = 4;
					$alt = get_alternatif();
					$alt_name = get_alt_name();
					$kep = get_kepentingan();
					$cb = get_costbenefit();
					$kri = get_kriteria();
/*					$min = get_min();
					$max = get_max();*/
					$k = jml_kriteria();
					$a = jml_alternatif();

					// ======================================================================== //
					echo "<b>Data kriteria</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>Cost / Benefit</b></td>";
						for($i=0;$i<$k;$i++){
							echo "<td>".ucwords($cb[$i])."</td>";
						}
					echo "</tr>";
					echo "<tr><td><b>Bobot</b></td>";
						for($i=0;$i<$k;$i++){
							echo "<td>".ucwords($kep[$i])."</td>";
						}
					echo "</tr>";
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Matrix Alternatif - Kriteria</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							echo "<td>".$alt[$i][$j]."</td>";	
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Rating Kecocokan</b></br>";
					$hrg = [];
					$klts = [];
					$plyn = [];					
					$kcctn = [];
					$arrall = [];

					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							if($j==0){
								if(($alt[$i][$j]) >= 2500000){
								 	$nilai = 1;
								 }else if(($alt[$i][$j]) >= 2000000){
								 	$nilai = 2;
								 }else if(($alt[$i][$j]) >= 1700000){
								 	$nilai = 3;
								 }else if(($alt[$i][$j]) > 1400000){
								 	$nilai = 4;
								 }else if(($alt[$i][$j]) <= 1400000){
								 	$nilai = 5;
								 }else{
								 	$nilai = 0;
								 }								
								array_push($hrg, $nilai);
								$arrall[$i][] = $nilai;
								echo "<td>".$nilai."</td>";
							}else if($j==1){
								if(($alt[$i][$j]) == "Buruk"){
									$nilai = 1;
								}else if(($alt[$i][$j]) == "Sedang"){
									$nilai = 3;
								}else if(($alt[$i][$j]) == "Baik"){
									$nilai = 5;
								}else{
									$nilai = 0;
								}
								array_push($klts, $nilai);
								$arrall[$i][] = $nilai;
								echo "<td>".$nilai."</td>";
							}else if($j==2){
								if(($alt[$i][$j]) > 3 ){
									$nilai = 1;
								}else if(($alt[$i][$j]) >= 1 ){
									$nilai = 2;
								}else if(($alt[$i][$j]) == 0 ){
									$nilai = 3;
								}else{
									$nilai = 0;
								}
								array_push($plyn, $nilai);
								$arrall[$i][] = $nilai;
								echo "<td>".$nilai."</td>";
							}else if($j==3){
								 if(($alt[$i][$j]) == "Ringan"){
								 	$nilai = 3;
								 }else if(($alt[$i][$j]) == "Berat" ){
								 	$nilai = 2;
								 }else{
								 	$nilai = 0;
								 }								
								array_push($kcctn, $nilai);
								$arrall[$i][] = $nilai;
								echo "<td>".$nilai."</td>";
							}else{
								echo "<td>".$alt[$i][$j]."</td>";
								$arrall[$i][] = $nilai;
							}
								
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Nilai Min - Max tiap Kriteria </b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>Nilai Minimal</b></td>";
					$max = [];
					$min = [];
						for($i=0;$i<$k;$i++){
							if($i==0){
								echo "<td>".min($hrg)."</td>";
								array_push($min, min($hrg));
							}else if($i==1){
								echo "<td>".min($klts)."</td>";
								array_push($min, min($klts));
							}else if($i==2){
								echo "<td>".min($plyn)."</td>";
								array_push($min, min($plyn));
							}else if($i==3){
								echo "<td>".min($kcctn)."</td>";
								array_push($min, min($kcctn));
							}else{
								echo "<td></td>";
							}
							
						}
					echo "</tr>";
					echo "<tr><td><b>Nilai Maximal</b></td>";
						for($i=0;$i<$k;$i++){
							if($i==0){
								echo "<td>".max($hrg)."</td>";
								array_push($max, max($hrg));
							}else if($i==1){
								echo "<td>".max($klts)."</td>";
								array_push($max, max($klts));
							}else if($i==2){
								echo "<td>".max($plyn)."</td>";
								array_push($max, max($plyn));
							}else if($i==3){
								echo "<td>".max($kcctn)."</td>";
								array_push($max, max($kcctn));
							}else{
								echo "<td></td>";
							}
						}
					echo "</tr>";
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Matrix Ternormalisasi</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						 for($j=0;$j<$k;$j++){
							if($cb="cost"){
						 		$mt[$i][$j] = $arrall[$i][$j]/$max[$j];
						 	}else{
						 		$mt[$i][$j] = $min[$j]/$alt[$i][$j];
						 	echo "<td>".round($mt[$i][$j],$koma)."</td>";
						 }
						 }
						for($j=0;$j<$k;$j++){
							if($cb="benefit")
								$mt[$i][$j] = $arrall[$i][$j]/$max[$j];
							else
								$mt[$i][$j] = $min[$j]/$arrall[$i][$j];
							echo "<td>".round($mt[$i][$j],$koma)."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Matrix Terbobot</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							$mtb[$i][$j] = $mt[$i][$j]*$kep[$j];
							echo "<td>".round($mtb[$i][$j],$koma)."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Hasil Akhir</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th><th>V</th></tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						$v[$i][0] = 0;
						for($j=0;$j<$k;$j++){
							$v[$i][0] = $v[$i][0] + $mtb[$i][$j];
						}
						$v[$i][1] = $alt_name[$i];
 						echo "<td>".round($v[$i][0],$koma)."</td>";
					}
					echo "</table><hr>";
					usort($v, "cmp");
					$i = 0;
					while (list($key, $value) = each($v)) {
						$hsl[$i] = array($value[1],$value[0]); 
						$i++;
					}
					// ======================================================================== //
					echo "<b>Hasil Analisa</b></br>";
					 echo "Berikut ini hasil analisa diurutkan berdasarkan hasil nilai tertinggi. </br>Jadi dapat disimpulkan bahwa Alternatif Calon Karyawan terbaik adalah <b>".ucwords(($hsl[0][0]))."</b> dengan nilai <b>".round($hsl[0][1],$koma)."</b>.";
					 echo "<table class='table table-striped table-bordered table-hover'>";
					 echo "<thead><tr><th>No.</th><th>Alternatif</th><th>Hasil Akhir</th></tr></thead>";
					 echo "<tbody>";
					 for($i=0;$i<$a;$i++){
						echo "<tr><td>".($i+1).".</td><td>".ucwords(($hsl[$i][0]))."</td><td>".round($hsl[$i][1],$koma)."</td></tr>";
					}
					echo "</tbody></table><hr>";
					
					
										function jml_kriteria(){	
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											return $kriteria->num_rows;
										}
										
										function jml_alternatif(){	
											include 'configdb.php';
											$alternatif = $mysqli->query("select * from alternatif where id_kain = '3'");
											return $alternatif->num_rows;
										}
										
										function get_kriteria(){
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=1;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i] = $row["kriteria"];
												$i++;
											}
											return $kri;
										}
										
										function get_kepentingan(){
											include 'configdb.php';
											$kepentingan = $mysqli->query("select * from kriteria");
											if(!$kepentingan){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kepentingan->fetch_assoc()) {
												@$kep[$i] = $row["kepentingan"];
												$i++;
											}
											return $kep;
										}
										
										function get_costbenefit(){
											include 'configdb.php';
											$costbenefit = $mysqli->query("select * from kriteria");
											if(!$costbenefit){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $costbenefit->fetch_assoc()) {
												@$cb[$i] = $row["cost_benefit"];
												$i++;
											}
											return $cb;
										}
										
										function get_alt_name(){
											include 'configdb.php';
											$alternatif = $mysqli->query("select alt.*, s.nm_sup AS nm_sup from alternatif alt 
join supplier s ON (alt.id_sup = s.id_sup) where id_kain = '3';");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i] = $row["nm_sup"];
												$i++;
											}
											return $alt;
										}

										
										function get_alternatif(){
											include 'configdb.php';
											$alternatif = $mysqli->query("select alt.*, s.nm_sup AS nama_supplier, a.nilai AS harga, b.nilai AS kualitas, c.nilai AS pelayanan, d.nilai AS kecacatan
from alternatif alt 
join supplier s ON (alt.id_sup = s.id_sup)
join harga a ON (alt.id_alternatif = a.id_alternatif) 
join kualitas b ON (alt.id_alternatif = b.id_alternatif) 
join pelayanan c ON (alt.id_alternatif = c.id_alternatif) 
join kecacatan d ON (alt.id_alternatif = d.id_alternatif) where id_kain = '3';");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i][0] = $row["harga"];
												@$alt[$i][1] = $row["kualitas"];
												@$alt[$i][2] = $row["pelayanan"];
												@$alt[$i][3] = $row["kecacatan"];
												$i++;
											}
											return $alt;
										}

										//function get_isi_kemampuandiri(){
										//	include 'configdb.php';
										//	$alternatif = $mysqli->query("select * from alternatif");
										//	if(!$alternatif){
										//		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
										//		exit();
										//	}
										//	$i=0;
										//	while ($row = $alternatif->fetch_assoc()) {
										//		@$alt[$i] = $row["kemampuan_diri"];
										//		$i++;
										//	}
										//	return $alt;
										//}

										
										
										function get_min(){
											include 'configdb.php';
											$min = $mysqli->query("select min(k1) as k1, min(k2) as k2, min(k3) as k3, min(k4) as k4 from alternatif");
											if(!$min){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$row = mysqli_fetch_array($min,MYSQLI_NUM);
											return $row;
										}
										
										function get_max(){
										 	include 'configdb.php';
										 	$min = $mysqli->query("select max(k1) as k1, max(k2) as k2, max(k3) as k3, max(k4) as k4 from alternatif");
										 	if(!$min){
										 		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
										 		exit();
										 	}
										 	$row = mysqli_fetch_array($min,MYSQLI_NUM);
										 	return $row;
										 }
										
										function cmp($a, $b){
											if ($a == $b) {
												return 0;
											}
											return ($a > $b) ? -1 : 1;
										}

										function print_ar(array $x){	//just for print array
											echo "<pre>";
											print_r($x);
											echo "</pre></br>";
										}
				?>
			</center>
		  </div>
		  <div class="panel-footer" style="background-color:#808080;"><b class="text-primary">By <?php echo $_SESSION['by'];?></b><b class="pull-right text-primary">2020</b></div>
		</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="ui/js/jquery-1.10.2.min.js"></script>
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	
	<script>
	function myFunction() {
		window.print();
	}
	</script>
</body></html>