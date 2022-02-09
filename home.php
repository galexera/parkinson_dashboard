<?php
require('db.inc.php');

$e = mysqli_query($con,"SELECT count(*) as count from `speech_dataset`");
$a = mysqli_fetch_assoc($e);
$emp=$a['count'];
$d =mysqli_query($con,"SELECT DISTINCT count(*) OVER() FROM `speech_dataset` GROUP BY patient");
$c = mysqli_fetch_assoc($d);
$patient=$c['count(*) OVER()'];
$w =mysqli_query($con,"SELECT Count(*) FROM INFORMATION_SCHEMA.Columns where TABLE_NAME = 'speech_dataset'");
$we = mysqli_fetch_assoc($w);
$features=$we['Count(*)']-3;

$ds =mysqli_query($con,"SELECT AVG(`MDVP:Fo(Hz)`)  FROM `speech_dataset`");
$dsc = mysqli_fetch_assoc($ds);
$av1=$dsc['AVG(`MDVP:Fo(Hz)`)'];
$dsm =mysqli_query($con,"SELECT MAX(`MDVP:Fo(Hz)`) FROM `speech_dataset`");
$dscm = mysqli_fetch_assoc($dsm);
$av1max=$dscm['MAX(`MDVP:Fo(Hz)`)'];
$dsi =mysqli_query($con,"SELECT MIN(`MDVP:Fo(Hz)`) FROM `speech_dataset`");
$dsci = mysqli_fetch_assoc($dsi);
$av1min=$dsci['MIN(`MDVP:Fo(Hz)`)'];

$b =mysqli_query($con,"SELECT AVG(`MDVP:Jitter(%)`) FROM `speech_dataset`");
$bd = mysqli_fetch_assoc($b);
$av2=$bd['AVG(`MDVP:Jitter(%)`)'];
$bm =mysqli_query($con,"SELECT MAX(`MDVP:Jitter(%)`) FROM `speech_dataset`");
$bdm = mysqli_fetch_assoc($bm);
$av2max=$bdm['MAX(`MDVP:Jitter(%)`)'];
$bi =mysqli_query($con,"SELECT MIN(`MDVP:Jitter(%)`) FROM `speech_dataset`");
$bdi = mysqli_fetch_assoc($bi);
$av2min=$bdi['MIN(`MDVP:Jitter(%)`)'];

$h =mysqli_query($con,"SELECT AVG(`MDVP:Shimmer`) FROM `speech_dataset`");
$hrd = mysqli_fetch_assoc($h);
$av3=$hrd['AVG(`MDVP:Shimmer`)'];
$hm =mysqli_query($con,"SELECT MAX(`MDVP:Shimmer`) FROM `speech_dataset`");
$hrdm = mysqli_fetch_assoc($hm);
$av3max=$hrdm['MAX(`MDVP:Shimmer`)'];
$hi =mysqli_query($con,"SELECT MIN(`MDVP:Shimmer`) FROM `speech_dataset`");
$hrdi = mysqli_fetch_assoc($hi);
$av3min=$hrdi['MIN(`MDVP:Shimmer`)'];

$s =mysqli_query($con,"SELECT AVG(`HNR`) FROM `speech_dataset`");
$sm = mysqli_fetch_assoc($s);
$av4=$sm['AVG(`HNR`)'];
$sm =mysqli_query($con,"SELECT MAX(`HNR`) FROM `speech_dataset`");
$smm = mysqli_fetch_assoc($sm);
$av4max=$smm['MAX(`HNR`)'];
$si =mysqli_query($con,"SELECT MIN(`HNR`) FROM `speech_dataset`");
$smi = mysqli_fetch_assoc($si);
$av4min=$smi['MIN(`HNR`)'];

$m =mysqli_query($con,"SELECT count(patient) over() FROM `speech_dataset` WHERE `status`=0 GROUP BY `patient` limit 1");
$ma = mysqli_fetch_assoc($m);
$pp=$ma['count(patient) over()'];
$f =mysqli_query($con,"SELECT count(patient) over() FROM `speech_dataset` WHERE `status`=1 GROUP BY `patient` limit 1");
$fe = mysqli_fetch_assoc($f);
$np=$fe['count(patient) over()'];


$mo=mysqli_query($con,"SELECT `patient` FROM `speech_dataset` GROUP BY `patient`");
$graph=[];
$r=0;
while($mon = mysqli_fetch_assoc($mo)){
	
	array_push($graph,$mon['patient']);
	$r++;
}
$dt = mysqli_query($con,"SELECT AVG(`MDVP:Fo(Hz)`) from `speech_dataset` where `status` = 0 GROUP BY patient");
$data_comp=[];
$i=0;
while($datac = mysqli_fetch_assoc($dt)){
	
	array_push($data_comp,$datac['AVG(`MDVP:Fo(Hz)`)']);
	$i++;
}
$do = mysqli_query($con,"SELECT AVG(`MDVP:Fo(Hz)`) from `speech_dataset` where `status` = 1 GROUP BY patient");
$data_ong=[];
$j=0;
while($datao = mysqli_fetch_assoc($do)){
	
	array_push($data_ong,$datao['AVG(`MDVP:Fo(Hz)`)']);
	$j++;
}

$maf = mysqli_query($con,"SELECT  MAX(`MDVP:Fhi(Hz)`) from `speech_dataset` where `status` = 0 group by `patient`");
$data_maf=[];
$h=0;
while($dataf = mysqli_fetch_assoc($maf)){
	
	array_push($data_maf,$dataf['MAX(`MDVP:Fhi(Hz)`)']);
	$h++;
}

$mif = mysqli_query($con,"SELECT MAX(`MDVP:Fhi(Hz)`) from `speech_dataset` where `status` = 1 GROUP BY patient");
$data_mif=[];
$l=0;
while($datai = mysqli_fetch_assoc($mif)){
	
	array_push($data_mif,$datai['MAX(`MDVP:Fhi(Hz)`)']);
	$l++;
}

$mfa = mysqli_query($con,"SELECT  MIN(`MDVP:Flo(Hz)`) from `speech_dataset` where `status` = 0 group by `patient`");
$data_mfa=[];
$h=0;
while($datab = mysqli_fetch_assoc($mfa)){
	
	array_push($data_mfa,$datab['MIN(`MDVP:Flo(Hz)`)']);
	$h++;
}

$mfi = mysqli_query($con,"SELECT MIN(`MDVP:Flo(Hz)`) from `speech_dataset` where `status` = 1 GROUP BY `patient`");
$data_mfi=[];
$l=0;
while($datan = mysqli_fetch_assoc($mfi)){
	
	array_push($data_mfi,$datan['MIN(`MDVP:Flo(Hz)`)']);
	$l++;
}
//BAR GRAPH 
$hnp = mysqli_query($con,"SELECT AVG(`HNR`) FROM `speech_dataset` where `status` = 1 GROUP BY `patient`");
$data_hnp=[];
$h=0;
while($datam = mysqli_fetch_assoc($hnp)){
	
	array_push($data_hnp,$datam['AVG(`HNR`)']);
	$h++;
}

$hnn = mysqli_query($con,"SELECT AVG(`HNR`) FROM `speech_dataset` where `status` = 0 GROUP BY `patient`");
$data_hnn=[];
$l=0;
while($datak = mysqli_fetch_assoc($hnn)){
	
	array_push($data_hnn,$datak['AVG(`HNR`)']);
	$l++;
}

//PEN PRESSURE (NP)
$ppy = mysqli_query($con,"SELECT `Pressure` FROM `c2` where `Test_ID` = 0");
$data_ppy=[];
$h=0;
while($datam = mysqli_fetch_assoc($ppy)){
	
	array_push($data_ppy,$datam['Pressure']);
	$h++;
}

$ppx = mysqli_query($con,"SELECT (`Timestamp`-1732647300) AS `TIME` FROM `c2` where `Test_ID` = 0");
$data_ppx=[];
$l=0;
while($datak = mysqli_fetch_assoc($ppx)){
	
	array_push($data_ppx,$datak['TIME']);
	$l++;
}

//PEN PRESSURE (P)
$npy = mysqli_query($con,"SELECT `Pressure` FROM `p1` where `Test_ID` = 0");
$data_npy=[];
$h=0;
while($datam = mysqli_fetch_assoc($npy)){
	
	array_push($data_npy,$datam['Pressure']);
	$h++;
}

// $npx = mysqli_query($con,"SELECT (`Timestamp`-1822091191) AS `TIME` FROM `p1` where `Test_ID` = 0");
$npx = mysqli_query($con,"SELECT (`Timestamp`-1822077962) AS `TIME` FROM `p1` where `Test_ID` = 0");

$data_npx=[];
$l=0;
while($datak = mysqli_fetch_assoc($npx)){
	
	array_push($data_npx,$datak['TIME']);
	$l++;
}

//SPIRAL (S)
$sy = mysqli_query($con,"SELECT `X` FROM `p1` where `Test_ID` = 0");
$data_sy=[];
$h=0;
while($datsy = mysqli_fetch_assoc($sy)){	
	array_push($data_sy,$datsy['X']);
	$h++;
}

$sx = mysqli_query($con,"SELECT `Y` FROM `p1` where `Test_ID` = 0");
$data_sx=[];
$l=0;
while($datsx = mysqli_fetch_assoc($sx)){
	
	array_push($data_sx,$datsx['Y']);
	$l++;
}

//SPIRAL (S1)
$syy = mysqli_query($con,"SELECT `X` FROM `p1` where `Test_ID` = 1");
$data_syy=[];
$h=0;
while($datsyy = mysqli_fetch_assoc($syy)){
	
	array_push($data_syy,$datsyy['X']);
	$h++;
}

$sxx = mysqli_query($con,"SELECT `Y` FROM `p1` where `Test_ID` = 1");
$data_sxx=[];
$l=0;
while($datasxx = mysqli_fetch_assoc($sxx)){
	array_push($data_sxx,$datasxx['Y']);
	$l++;
}




?>
<!DOCTYPE html> 
<html>
<head>
	<title>Parkinson Disease Data Dashboard</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	

	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
	<!-- End import lib -->

	<link rel="stylesheet" type="text/css" href="dash.css">
	<link rel="icon" href="favicon.ico">
<style>
/* *{
padding: 0;
margin: 0;
background: cover!important;
}*/
body{
font-family:Graduate;
font-size:0.9rem;

} 
#logo{
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
animation: fill 0.5s ease forwards 1s;
}

#logo{
	stroke-dasharray: 90px;
	stroke-dashoffset: 900px;
	animation: line-anim 1s ease forwards 0.15s;
}
#logo path:nth-child(1){
stroke-dasharray: 100px;
stroke-dashoffset: 539.76px;
animation: line-anim 1s ease forwards;
}
#logo path:nth-child(2){
stroke-dasharray:835.34px;
stroke-dashoffset:835.34px;
animation: line-anim 1s ease forwards 0.15s;
}
#logo path:nth-child(3){
stroke-dasharray:478.73px;
stroke-dashoffset:478.73px;
animation: line-anim 1s ease forwards 0.3s;
}
#logo path:nth-child(4){
stroke-dasharray:535.80px;
stroke-dashoffset:535.80px;
animation: line-anim 1s ease forwards 0.45s;
}
#logo path:nth-child(5){
stroke-dasharray:382.72px;
stroke-dashoffset:382.72px;
animation: line-anim 1s ease forwards 0.6s; */

}


@keyframes line-anim{
	to{
		stroke-dashoffset:0;
	}
}
@keyframes fill{
	0%,100%{
		color: #FFF;
		fill:transparent;
		text-shadow: 0 0 10px #00B3FF;
	}
	5%,95%{
		color: #111;
		filter: blur(0px);
		text-shadow: none;
	}
}
.loader {
    position: fixed;
    z-index: 1009;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: black!important;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader.hidden {
    animation: fadeOut 1.5s;
    animation-fill-mode: forwards;
}

@keyframes fadeOut {
    100% {
        opacity: 1;
        visibility: hidden;
    }
}

.thumb {
    height: 100px;
    border: 1px solid black;
    margin: 10px;
}
.a-list{
	text-align: left !important;
}
.l-list{
	padding: 5px;
	font-size: medium;
}
</style>
</head>
<body class="overlay-scrollbar">
	<div class="loader">

	<svg width="653" height="93" viewBox="0 0 653 93" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.60001 14.9V4.5H32.16V14.9H23.06L41.39 76.65L59.85 14.9H54.65V4.5H82.73V14.9H77.53L95.86 76.65L114.32 14.9H105.22V4.5H132.78V14.9H126.28L104.18 89H88.19L68.69 23.61L49.19 89H33.2L11.1 14.9H4.60001Z" fill="black"/>
<path d="M145.828 4.5H207.708V29.98H197.308V14.9H166.888V41.55H197.308V51.95H166.888V78.6H197.308V63.52H207.708V89H145.828V78.6H154.928V14.9H145.828V4.5Z" fill="black"/>
<path d="M228.474 4.5H259.934V14.9H249.534V78.6H277.874V63.52H287.754V89H228.474V78.6H237.574V14.9H228.474V4.5Z" fill="black"/>
<path d="M350.111 58.32H360.511V74.7L346.991 89H314.231L300.711 74.7V18.8L314.231 4.5H346.991L360.511 18.8V35.18H350.111V24.13L341.921 15.68H319.431L312.671 22.57V70.93L319.301 77.82H341.791L350.111 69.37V58.32Z" fill="black"/>
<path d="M392.18 89L378.66 74.7V18.8L392.18 4.5H428.84L442.36 18.8V74.7L428.84 89H392.18ZM397.25 77.82H423.64L430.4 70.93V22.57L423.77 15.68H397.38L390.62 22.57V70.93L397.25 77.82Z" fill="black"/>
<path d="M484.271 78.6H493.371V89H463.211V78.6H472.311V14.9H463.211V4.5H489.731L514.301 65.99L538.871 4.5H565.391V14.9H556.291V78.6H565.391V89H535.231V78.6H544.331V19.19L520.021 78.6H508.581L484.271 19.19V78.6Z" fill="black"/>
<path d="M586.228 4.5H648.108V29.98H637.708V14.9H607.288V41.55H637.708V51.95H607.288V78.6H637.708V63.52H648.108V89H586.228V78.6H595.328V14.9H586.228V4.5Z" fill="black"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.600006 18.9V0.5H36.16V18.9H28.4199L41.4036 62.6393L54.4793 18.9H50.65V0.5H86.73V18.9H82.8899L95.8736 62.6393L108.949 18.9H101.22V0.5H136.78V18.9H129.261L107.161 93H85.2088L68.69 37.6071L52.1712 93H30.2189L8.11888 18.9H0.600006ZM11.1 14.9L33.2 89H49.19L68.69 23.61L88.19 89H104.18L126.28 14.9H132.78V4.5H105.22V14.9H114.32L95.86 76.65L77.53 14.9H82.73V4.5H54.65V14.9H59.85L41.39 76.65L23.06 14.9H32.16V4.5H4.60001V14.9H11.1ZM141.828 0.5H211.708V33.98H193.308V18.9H170.888V37.55H201.308V55.95H170.888V74.6H193.308V59.52H211.708V93H141.828V74.6H150.928V18.9H141.828V0.5ZM154.928 14.9V78.6H145.828V89H207.708V63.52H197.308V78.6H166.888V51.95H197.308V41.55H166.888V14.9H197.308V29.98H207.708V4.5H145.828V14.9H154.928ZM224.474 0.5H263.934V18.9H253.534V74.6H273.874V59.52H291.754V93H224.474V74.6H233.574V18.9H224.474V0.5ZM237.574 14.9V78.6H228.474V89H287.754V63.52H277.874V78.6H249.534V14.9H259.934V4.5H228.474V14.9H237.574ZM346.111 54.32H364.511V76.2915L348.713 93H312.508L296.711 76.2915V17.2084L312.508 0.5H348.713L364.511 17.2084V39.18H346.111V25.7504L340.227 19.68H321.11L316.671 24.2046V69.318L321.003 73.82H340.116L346.111 67.7313V54.32ZM350.111 69.37L341.791 77.82H319.301L312.671 70.93V22.57L319.431 15.68H341.921L350.111 24.13V35.18H360.511V18.8L346.991 4.5H314.231L300.711 18.8V74.7L314.231 89H346.991L360.511 74.7V58.32H350.111V69.37ZM390.457 93L374.66 76.2915V17.2084L390.457 0.5H430.563L446.36 17.2085V76.2915L430.563 93H390.457ZM497.371 74.6V93H459.211V74.6H468.311V18.9H459.211V0.5H492.44L514.301 55.2098L536.161 0.5H569.391V18.9H560.291V74.6H569.391V93H531.231V74.6H540.331V39.5276L522.706 82.6H505.895L488.271 39.5275V74.6H497.371ZM484.271 78.6V19.19L508.581 78.6H520.021L544.331 19.19V78.6H535.231V89H565.391V78.6H556.291V14.9H565.391V4.5H538.871L514.301 65.99L489.731 4.5H463.211V14.9H472.311V78.6H463.211V89H493.371V78.6H484.271ZM582.228 0.5H652.108V33.98H633.708V18.9H611.288V37.55H641.708V55.95H611.288V74.6H633.708V59.52H652.108V93H582.228V74.6H591.328V18.9H582.228V0.5ZM595.328 14.9V78.6H586.228V89H648.108V63.52H637.708V78.6H607.288V51.95H637.708V41.55H607.288V14.9H637.708V29.98H648.108V4.5H586.228V14.9H595.328ZM428.84 89L442.36 74.7V18.8L428.84 4.5H392.18L378.66 18.8V74.7L392.18 89H428.84ZM421.961 73.82L426.4 69.2954V24.182L422.068 19.68H399.059L394.62 24.2046V69.318L398.952 73.82H421.961ZM390.62 70.93V22.57L397.38 15.68H423.77L430.4 22.57V70.93L423.64 77.82H397.25L390.62 70.93Z" fill="white"/>
</svg>




    </div>
	<!-- navbar -->
	<div class="navbar">
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
			
		</ul>
		<ul class="navbar-nav nav-right">
			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
                <p class="dropdown-toggle" data-toggle="user-menu" style="color:white;" >Welcome <?php echo $_SESSION['USER_NAME']?></p>
				
				<ul id="user-menu" class="dropdown-menu">
						<li  class="dropdown-menu-item">
							<a href="logout.php " class="dropdown-menu-link">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span style="color:white;" >Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	
	</div>
	
	<div class="sidebar">
		<ul class="sidebar-nav">
		
			<li class="sidebar-nav-item ">
				<a href="#" class="sidebar-nav-link active">
					<div>
                    <i class="fas fa-home"></i>
					</div>
					<span>
						HOME
					</span>
				</a>
				</li>
			
			<!-- <li  class="sidebar-nav-item">
				<a href="about.php" class="sidebar-nav-link">
					<div>
                    <i class="fas fa-info"></i>
					</div>
					<span>PARKINSON'S INFORMATION</span>
				</a>
			</li> -->
		</ul>
    </div>
    
	<div class="wrapper">
	<div class="col-lg-12">
			<div class="counter" style="background: var(--main-bg-color);!important font-size:large;">
				<h1>VOICE DATA ANALYSIS</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-warning">
					<p>
					<i class="fab fa-buffer fa-2x"></i>
					</p>
					<h2>TOTAL VOICE SAMPLES </h2>
					<h2><?php echo $emp ?></h2>
				</div>
			</div>
			<div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-success">
					<p>
					<i class="fas fa-user fa-2x"></i>
					</p>
					<h2>TOTAL NO. OF PATIENTS</h2>
					<h2><?php echo $patient ?></h2>
				</div>
			</div>
			<div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-danger">
					<p>
					<i class="fas fa-check-square fa-2x"></i>
					</p>
					<h2>TOTAL FEATURES EXTRACTED</h2>
					<h2><?php echo $features ?></h2>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="counter bg-primary">
				<h3>DATASET DETAILS (FEATURE EXTRACTION & ATTRIBUTE INFORMATION)</h3>
					<ul class="a-list">
						<li class="l-list">name - ASCII subject name and recording number</li>
						<li class="l-list">MDVP:Fo(Hz) - Average vocal fundamental frequency</li>
						<li class="l-list">MDVP:Fhi(Hz) - Maximum vocal fundamental frequency</li>
						<li class="l-list">MDVP:Flo(Hz) - Minimum vocal fundamental frequency</li>
						<li class="l-list">MDVP:Jitter(%),MDVP:Jitter(Abs),MDVP:RAP,MDVP:PPQ,Jitter:DDP - Several measures of variation in fundamental frequency</li>
						<li class="l-list">MDVP:Shimmer,MDVP:Shimmer(dB),Shimmer:APQ3,Shimmer:APQ5,MDVP:APQ,Shimmer:DDA - Several measures of variation in amplitude</li>
						<li class="l-list">NHR,HNR - Two measures of ratio of noise to tonal components in the voice</li>
						<li class="l-list">status - Health status of the subject (one) - Parkinson's, (zero) - healthy</li>
						<li class="l-list">RPDE,D2 - Two nonlinear dynamical complexity measures</li>
						<li class="l-list">DFA - Signal fractal scaling exponent</li>
						<li class="l-list">spread1,spread2,PPE - Three nonlinear measures of fundamental frequency variation</li>
					</ul>
			</div>
		</div>
			
			<?php if($_SESSION['ROLE']==1){ ?>
			 <div class="row">
			<div class="col-6 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							AGGREGATE VALUES OF FEW EXTRACTED FEATURES (32 PATIENTS)
						</h3>
						<i class="fas fa-ellipsis-h"></i>
					</div>
					<div class="card-content">
						<div class="progress-wrapper">
							<p>
							MDVP:Fo(Hz) [Agrregate Value : <?php echo round(($av1))?>] RANGE : [<?php echo round(($av1min))?> - <?php echo round(($av1max))?>]
								<span class="float-right"><?php echo round((($av1-$av1min)/($av1max-$av1min)*100))?>%</span>
							</p>
							<div class="progress">
								<div class="bg-success" style="width: <?php echo round((($av1-$av1min)/($av1max-$av1min)*100))?>%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
							MDVP:Jitter(%) [Agrregate Value : <?php echo  round(($av2),4)?>] RANGE : [<?php echo round(($av2min),4)?> - <?php echo  round(($av2max),4)?>]
								<span class="float-right"><?php echo round((($av2-$av2min)/($av2max-$av2min)*100))?>%</span>
							</p>
							<div class="progress">
								<div class="bg-primary" style="width:<?php echo round((($av2-$av2min)/($av2max-$av2min)*100))?>%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
							MDVP:Shimmer [Agrregate Value : <?php echo round(($av3),4)?>] RANGE : [<?php echo round(($av3min),4)?> - <?php echo round(($av3max),4)?>]
								<span class="float-right"><?php echo round((($av3-$av3min)/($av3max-$av3min)*100))?>%</span>
							</p>
							<div class="progress">
								<div class="bg-warning" style="width:<?php echo round((($av3-$av3min)/($av3max-$av3min)*100))?>%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
								Harmonics to Noise Ratio [Agrregate Value : <?php echo round(($av4))?>] RANGE : [<?php echo ($av4min)?> - <?php echo ($av4max)?>]
								<span class="float-right"><?php echo round((($av4-$av4min)/($av4max-$av4min)*100))?>%</span>
							</p>
							<div class="progress">
								<div class="bg-danger" style="width:<?php echo round((($av4-$av4min)/($av4max-$av4min)*100))?>%"></div>
							</div>
					</div>
				</div>
			</div>
			</div>
			
		
				<div class="col-6 col-m-12 col-sm-12">
				<div class="card" >
					<div class="card-header">
						<h3>
							PARKINSON DISEASE PATIENT DISTRIBUTION
						</h3>
						<i class="fas fa-ellipsis-h"></i>
					</div>
					<div class="card-content" >
						<div class="progress-wrapper">
							<p>
							<i class="fas fa-user-plus fa-2x"></i> PARKINSON POSITIVE PATIENTS : <?php echo ($pp)?>
								<span class="float-right"><?php echo round((($pp/$patient)*100))?>%</span>
							</p>
							<div class="progress">
								<div class="bg-success" style="width: <?php echo round((($pp/$patient)*100))?>%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
							<i class="fas fa-user-minus fa-2x"></i> PARKINSON NEGATIVE PATIENTS : <?php echo ($np)?>
								<span class="float-right"><?php echo round((($np/$patient)*100))?>%</span>
							</p>
							<div class="progress">
								<div class="bg-primary" style="width:<?php echo round((($np/$patient)*100))?>%"></div>
							</div>
						</div>
						
			
			</div>
			</div>
			</div>
			
		
			
			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							AVERAGE VOCAL FREQUENCY DISTRIBUTION CHART
						</h3>
					</div>
					<div class="card-content">
						<canvas id="myChart"></canvas>
						<p style="text-align: center;font-size: xx-small;"> Number of Patients</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							MAXIMUM FREQUENCY DISTRIBUTION CHART
						</h3>
					</div>
					<div class="card-content">
						<canvas id="Chart2"></canvas>
						<p style="text-align: center;font-size: xx-small;"> Number of Patients</p>
					</div>
				</div>
			</div>
		
		<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							MINIMUM FREQUENCY DISTRIBUTION CHART
						</h3>
					</div>
					<div class="card-content">
						<canvas id="Chart3"></canvas>
						<p style="text-align: center;font-size: xx-small;"> Number of Patients</p>

					</div>
				</div>
			</div>
			
			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							PATIENT HNR DISTRIBUTION CHART
						</h3>
					</div>
					<div class="card-content">
						<canvas id="Chart4"></canvas>
						<p style="text-align: center;font-size: xx-small;"> Number of Patients</p>

					</div>
				</div>
			</div>
		
			<!-- SPIRAL & WAVEFORM DATA ANALYSIS	 -->
	<div class="col-lg-12">
			<div class="counter" style="background: var(--main-bg-color);!important font-size:large;">
				<h1>SPIRAL & WAVEFORM DATA ANALYSIS</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-warning">
					<p>
					<i class="fab fa-buffer fa-2x"></i>
					</p>
					<h2>TOTAL SAMPLES </h2>
					<h2>77</h2>
				</div>
			</div>
			<div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-success">
					<p>
					<i class="fas fa-user fa-2x"></i>
					</p>
					<h2>TOTAL NO. OF PATIENTS</h2>
					<h2>65</h2>
				</div>
			</div>
			<div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-danger">
					<p>
					<i class="fas fa-check-square fa-2x"></i>
					</p>
					<h2>TOTAL FEATURES EXTRACTED</h2>
					<h2>30</h2>
				</div>
			</div>
		</div>
		<div class="row">
		<div class="col-lg-6 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>DATASET DETAILS (ATTRIBUTE INFORMATION)</h3>
					<ul class="a-list" style="list-style-type:none;line-height: 219.5%;">
					<!-- <li class="l-list" style="color:#4834d4;">X Coordinate</li>
					<li class="l-list" style="color:#4834d4;">X Coordinate</li> -->
					<br>
						<li class="l-list ">X Coordinate</li>
						<li class="l-list">Y Coordinate</li>
						<li class="l-list">Z Coordinate</li>
						<li class="l-list">Pressure</li>
						<li class="l-list">GripAngle</li>
						<li class="l-list">Timestamp</li>
					<!-- <li class="l-list" style="color:#4834d4;">X Coordinate</li>
					<li class="l-list" style="color:#4834d4;">X Coordinate</li> -->
					</ul>
			</div>
			</div>
		

		<div class="col-lg-6 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>DATASET DETAILS (FEATURE EXTRACTION)</h3>
					<ul class="a-list" style="list-style-type:none;">
						<li class="l-list">Number of Strokes</li>
						<li class="l-list">Stroke Speed</li>
						<li class="l-list">Horizontal and Vertical Velocity</li>
						<li class="l-list">Horizontal and Vertical Acceleration</li>
						<li class="l-list">Horizontal and Vertical Jerk</li>
						<li class="l-list">Number of Changes in Velocity Direction (NCV)</li>
						<li class="l-list">Number of Changes in Acceleration Direction (NCA)</li>
						<li class="l-list">Relative NCV and NCA</li>
						<li class="l-list">In-Air Time</li>
						<li class="l-list">On-Surface Time</li>
					</ul>
			</div>
		</div>
		</div>

		

		<div class="col-lg-12">
			<div class="counter" style="background: var(--main-bg-color);!important font-size:large;">
				<h2>PEN PRESSURE(P)</h2>
			</div>
		</div>

		<div class="row">
		<div class="col-6 col-m-6 col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>
						NORMAL PATIENT
						</h3>
					</div>
					<div class="card-content">
						<canvas id="ChartPenNP"></canvas>
						<p style="text-align: center;font-size: xx-small;"> TimeStamp</p>

					</div>
				</div>
		</div>

		<div class="col-6 col-m-6 col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>
						PARKINSON PATIENT
						</h3>
					</div>
					<div class="card-content">
						<canvas id="ChartPenPP"></canvas>
						<p style="text-align: center;font-size: xx-small;"> TimeStamp</p>

					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="counter" style="background: var(--main-bg-color);!important font-size:large;">
				<h2>SPIRAL SKETCHING(S)</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-m-6 col-sm-6">
				<div class="counter bg-warning">
					<p>
					<i class="fab fa-buffer fa-2x"></i>
					</p>
					<h3>Static Spiral Test </h3>
					<h4>Draw on the given spiral pattern</h4>
					<br>
				</div>
			</div>
			<div class="col-lg-6 col-m-6 col-sm-6">
				<div class="counter bg-success">
					<p>
					<i class="fas fa-user fa-2x"></i>
					</p>
					<h3>Dynamic Spiral Test</h3>
					<h4>Spiral pattern will blink in a certain time, so subjects need to continue on their draw</h4>
				</div>
			</div>
			<!-- <div class="col-lg-4 col-m-4 col-sm-4">
				<div class="counter bg-danger">
					<p>
					<i class="fas fa-check-square fa-2x"></i>
					</p>
					<h3>Circular Motion Test</h3>
					<h4>Subjectd draw circles around the red point</h4>
				</div>
			</div> -->
		</div>


		<div class="row">
		<div class="col-6 col-m-6 col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>
						Static Spiral Test (PARKINSON PATIENT)
						</h3>
					</div>
					<div class="card-content">
						<canvas id="ChartSK_0"></canvas>
						<p style="text-align: center;font-size: xx-small;"> Pen Pressure</p>

					</div>
				</div>
		</div>
				
		<div class="col-6 col-m-6 col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>
						Dynamic Spiral Test (PARKINSON PATIENT)
						</h3>
					</div>
					<div class="card-content">
						<canvas id="ChartSK_1"></canvas>
						<p style="text-align: center;font-size: xx-small;"> Pen Pressure</p>

					</div>
				</div>
		</div>
		</div>
	
	<?php } else { ?>
		
		<div class="row">
			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							COMPANY PROJECT CHART
						</h3>
					</div>
					<div class="card-content">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
		</div>
		
	<?php } ?>
	<!-- end main content -->
	<!-- import script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script>
	const primaryColor = '#4834d4'
	const warningColor = '#f0932b'
	const successColor = '#6ab04c'
	const dangerColor = '#eb4d4b'

	const themeCookieName = 'theme'
	const themeDark = 'dark'
	const themeLight = 'light'

	const body = document.getElementsByTagName('body')[0]

	function setCookie(cname, cvalue, exdays) {
	  var d = new Date()
	  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))
	  var expires = "expires="+d.toUTCString()
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"
	}

	function getCookie(cname) {
	  var name = cname + "="
	  var ca = document.cookie.split(';')
	  for(var i = 0; i < ca.length; i++) {
	    var c = ca[i];
	    while (c.charAt(0) == ' ') {
	      c = c.substring(1)
	    }
	    if (c.indexOf(name) == 0) {
	      return c.substring(name.length, c.length)
	    }
	  }
	  return ""
	}

	loadTheme()

	function loadTheme() {
		var theme = getCookie(themeCookieName)
		body.classList.add(theme === "" ? themeDark : theme)
	}


	function collapseSidebar() {
		body.classList.toggle('sidebar-expand')
	}

	window.onclick = function(event) {
		openCloseDropdown(event)
	}

	function closeAllDropdown() {
		var dropdowns = document.getElementsByClassName('dropdown-expand')
		for (var i = 0; i < dropdowns.length; i++) {
			dropdowns[i].classList.remove('dropdown-expand')
		}
	}

	function openCloseDropdown(event) {
		if (!event.target.matches('.dropdown-toggle')) {
			
			closeAllDropdown()
		} else {
			var toggle = event.target.dataset.toggle
			var content = document.getElementById(toggle)
			if (content.classList.contains('dropdown-expand')) {
				closeAllDropdown()
			} else {
				closeAllDropdown()
				content.classList.add('dropdown-expand')
			}
		}
	}

	var ctx = document.getElementById('myChart')
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24],
		datasets: [{
			fill: false,
			label: 'Parkinson Negative',
			borderColor: successColor,
			data: <?php echo json_encode($data_comp);?>,
			borderWidth: 2,
			lineTension: 0,
		}, {
			fill: false,
			label: 'Parkinson Positive',
			borderColor: dangerColor,
			data: <?php echo json_encode($data_ong);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var lineChart = new Chart(ctx, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,
			

			
		},
		scales : {
			x: {
				title : {
					display : true,
					text : 'Number of Patients',
				}
			},	
			y: {
				title : {
					display : true,
					text : 'MDVP:Fo(Hz)',
				}
			}
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
// SECOND GRAPH
var cty = document.getElementById('Chart2')
	cty.height = 500
	cty.width = 500
	var data = {
		labels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24],
		datasets: [{
			fill: false,
			label: 'Parkinson Negative',
			borderColor: primaryColor,
			data: <?php echo json_encode($data_maf);?>,
			borderWidth: 2,
			lineTension: 0,
		}, {
			fill: false,
			label: 'Parkinson Positive',
			borderColor: warningColor,
			data: <?php echo json_encode($data_mif);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var lineChart = new Chart(cty, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,

			
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
// THIRD GRAPH
var ctz = document.getElementById('Chart3')
	ctz.height = 500
	ctz.width = 500
	var data = {
		labels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24],
		datasets: [{
			fill: false,
			label: 'Parkinson Negative',
			borderColor: '#f162ff',
			data: <?php echo json_encode($data_mfa);?>,
			borderWidth: 2,
			lineTension: 0,
		}, {
			fill: false,
			label: 'Parkinson Positive',
			borderColor: '#ffd79d',
			data: <?php echo json_encode($data_mfi);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var lineChart = new Chart(ctz, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,

			
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
// FOURTH GRAPH
var ctq = document.getElementById('Chart4')
	ctq.height = 200
	ctq.width = 500
	var data = {
		labels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24],
		datasets: [{
			fill: false,
			label: 'Parkinson Negative',
			borderColor: successColor,
			data: <?php echo json_encode($data_hnn);?>,
			borderWidth: 2,
			lineTension: 0,
			
		}, {
			fill: false,
			label: 'Parkinson Positive',
			borderColor: dangerColor,
			data: <?php echo json_encode($data_hnp);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var barChart = new Chart(ctq, {
		type: 'bar',
		data: data,
		options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Bar Chart'
      }
    }
  },
})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});


// PEN PRESSURE (NP)
var ctnp = document.getElementById('ChartPenNP')
	ctnp.height = 500
	ctnp.width = 500
	var data = {
		labels:<?php echo json_encode($data_ppx);?>,
		datasets: [{
			fill: false,
			label: 'Pen Pressure (Normal)',
			borderColor: primaryColor,
			data: <?php echo json_encode($data_ppy);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var lineChart = new Chart(ctnp, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,

			
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});

// PEN PRESSURE (PP)
var ctpp = document.getElementById('ChartPenPP')
	ctpp.height = 500
	ctpp.width = 500
	var data = {
		labels:<?php echo json_encode($data_npx);?>,
		datasets: [{
			fill: false,
			label: 'Pen Pressure (Parkinson)',
			borderColor: warningColor,
			data: <?php echo json_encode($data_npy);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var lineChart = new Chart(ctpp, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,			
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});

// SPIRAL (S)
var ctsst = document.getElementById('ChartSK_0')
	ctsst.height = 500
	ctsst.width = 500
	var data = {
		labels:<?php echo json_encode($data_sy);?>,
		datasets: [{
			fill: false,
			label: 'Static Spiral Test',
			borderColor: warningColor,
			data: <?php echo json_encode($data_sx);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}
	var lineChart = new Chart(ctsst, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,			
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});

// SPIRAL (S1)
var ctdst = document.getElementById('ChartSK_1')
	ctdst.height = 500
	ctdst.width = 500
	var data = {
		labels:<?php echo json_encode($data_syy);?>,
		datasets: [{
			fill: false,
			label: 'Dynamic Spiral Test',
			borderColor: successColor,
			data: <?php echo json_encode($data_sxx);?>,
			borderWidth: 2,
			lineTension: 0,
		}]
	}

	var lineChart = new Chart(ctdst, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,			
		}
	})
	
	window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});

</script>
	<!-- end import script -->
</body>
</html>