<?php	
	$author=$_POST['edtAuthor'];
	$content=$_POST['areaContent'];
	$email=$_POST['edtMail'];
	$first=$_POST['edtFirst'];
	$second=$_POST['edtSecond'];
	$third=$_POST['edtThird'];
	$check=$_POST['edtCheck'];
	$date=date("Y\-m\-d");
	$resultMsg = "";
	
	if(isset($_POST['smtOddaj']) && $content!=''){

		$checkOK = false;
		if($third >= 10) {
			if($first+$second == $check) {
				$checkOK = true;
			}
		} else {
			if($first-$second == $check) {
				$checkOK = true;
			}
		}
		if($checkOK) {
			
			//SEND MAIL
			include_once('../phpMailer/class.phpmailer.php');
			$mail    = new PHPMailer();
			$subject ='VFR-Charts Support Message';
			$body  = $author."<br />".$email."<br />".$content;
			$body    = eregi_replace("[\]",'',$body);
			$to		 = "askerbinek@gmail.com";
			$mail->FromName = $email;
			$mail->Subject  = $subject;
			$mail->AltBody  = 'Error occured!';
			$mail->Body = $body;
			$mail->AddAddress($to);
			if($mail->Send()) {				
				$resultMsg = 'Thanks! Your message is on it\'s way!';			}
			else{						
				$resultMsg = 'Oops! Error occured while sendinf e-mail!';
			}				
		} else {
			$resultMsg = 'Oops! Security check does not match!';
		}
	}
	
	$firstNo = rand(0,20);
	$secondNo = rand(0,20);
	$thirdNo = rand(0,20);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>VFR Charts</title>
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext,cyrillic-ext' rel='stylesheet' type='text/css'>
	
	<meta name="description" content="VFR Approach and Ground Movement Charts for Public Airports and UL sites in Slovenia">
	<meta name="keywords" content="VFR, chart, map, layout, approach, ground movement, Slovenia, Europe, airport, aerodrome, airfield, airstrip, UL site, aviation, aircraft, airplane, flight, general aviation, pilot, AIRAC, unofficial, AIP, copyleft, visual flight rules, download, pdf, jpg, jpeg, reporting points, contact, fuel, customs, meteo, website, email, runway, direction, TORA, TODA, ASDA, LDA, dimension, frequency, civil, altitude, elevation, departure, arrival, tower, radar, information, manual, traffic pattern, glider, upwind, crosswind, downwind, base leg, final, left, right, turn, instructions, valid, ICAO, IATA, callsign, location, color, ultra light, ultralight, light-sport, LSA, microlight, sport, LJMB, LJLJ, LJCE, LJPZ, LJAJ, LJBL, LJBO, LJCL, LJDI, LJMS, LJNM, LJPO, LJPT, LJSK, LJSG, LJSO, Ajdovscina, Bovec, Lesce, Bled, Celje, Divača, Novo Mesto, Murska Sobota, Ptuj, Postojna, Slovenj Gradec, Slovenske Konjice, Sostanje, Velenje, Ljubljana, maribor, Cerklje ob Krki, Portoroz, Sentvid, Kamnik, Duplica, Verzej, Cerkevenjak, Cagona, Mostje, Lendava, Dobova, Mihalovec, Metlika, Prilozje, Zagorje, Kisovec, Kocevje, Novi Lazi, vzletisce, letalisce, zemljevid, karta, priletne karte">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
	
      #map {
        height: 600px;
        width: 100%;
      }
	  
	  h1, h2, p, td {
		font-family: Open Sans;
		text-align: center;
	  }
	  
	  .section {
		margin: auto;
		width: 800px;
	  }
	  
	  table tr td {
		width: 200px;
	  }
	  
	  .chart_img {
		width: 80px;
	  }
	  
	  .copyleft {
		font-family: Arial;
		display:inline-block;
		transform: rotate(180deg);
	  }
	  
    </style>
    <script>
      // Initialize and add the map
      // Initialize and add the map
function initMap() {
		  const imageLJLJ = {
			url: "APTs/PI120.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJMB = {
			url: "APTs/PI140.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJPZ = {
			url: "APTs/PI150.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJCE = {
			url: "APTs/PM090.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  

		  const imageLJCLPT = {
			url: "APTs/G110.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJAJ = {
			url: "APTs/G080.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJBO = {
			url: "APTs/G070.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJPO = {
			url: "APTs/G020.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJBLSG = {
			url: "APTs/P140.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJSK = {
			url: "APTs/P160.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJSO = {
			url: "APTs/P150.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJMS = {
			url: "APTs/G_MS.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJDI = {
			url: "APTs/P_DI.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageLJNM = {
			url: "APTs/G050.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  
		  const imageU110 = {
			url: "APTs/U110.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageU140 = {
			url: "APTs/U140.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
		  const imageU040 = {
			url: "APTs/U040.png", size: new google.maps.Size(58, 58), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(29, 29),
		  };
  
        // The location of Uluru
        const ljubljana = { lat: 46.224674, lng: 14.455743 };
		const maribor = { lat: 46.479815, lng: 15.686148 };
        const portoroz = { lat: 45.472900, lng: 13.615296 };
		const cerklje = { lat: 45.899924, lng: 15.531198 };
		
		const celje = { lat: 46.245589, lng: 15.222760 };
        const ptuj = { lat: 46.427244, lng: 15.985604 };
        const murska_sobota = { lat: 46.629817, lng: 16.175531 };
		const slovenj_gradec = { lat: 46.471976, lng: 15.116967 };
		const sostanj = { lat: 46.398112, lng: 15.044761 };
		const slovenske_konjice = { lat: 46.310952, lng: 15.491769 };
		const novo_mesto = { lat: 45.801146, lng: 15.103797 };
		const postojna = { lat: 45.753546, lng: 14.195821 };
		const divača = { lat: 45.682250, lng: 14.002938 };
		const ajdovščina = { lat: 45.889406, lng: 13.886348 };
		const bovec = { lat: 46.328826, lng: 13.548811 };
		const bled = { lat: 46.356159, lng: 14.174580 };
		
		const kamnik = { lat: 46.197066, lng: 14.580981 };
		const sentvid = { lat: 45.943940, lng: 14.850698 };
		const metlika = { lat: 45.588863, lng: 15.259699 };
		const verzej = { lat: 46.573229, lng: 16.191969 }; 
		
		const geoss = { lat: 46.120236, lng: 14.815425 };
			
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: geoss,
        });
		const markerLJLJ = new google.maps.Marker({ position: ljubljana, map: map, icon: imageLJLJ, });
		const markerLJMB = new google.maps.Marker({ position: maribor, map: map, icon: imageLJMB, });
		const markerLJPZ = new google.maps.Marker({ position: portoroz, map: map, icon: imageLJPZ, });
		const markerLJCE = new google.maps.Marker({ position: cerklje, map: map, icon: imageLJCE, });
		
        const markerLJCL = new google.maps.Marker({ position: celje, map: map, icon: imageLJCLPT, });
        const markerLJPT = new google.maps.Marker({ position: ptuj, map: map, icon: imageLJCLPT, });
        const markerLJMS = new google.maps.Marker({ position: murska_sobota, map: map, icon: imageLJMS, });
		const markerLJSG = new google.maps.Marker({ position: slovenj_gradec, map: map, icon: imageLJBLSG, });
		const markerLJSO = new google.maps.Marker({ position: sostanj, map: map, icon: imageLJSO, });
		const markerLJSK = new google.maps.Marker({ position: slovenske_konjice, map: map, icon: imageLJSK, });
		const markerLJPO = new google.maps.Marker({ position: postojna, map: map, icon: imageLJPO, });
		const markerLJAJ = new google.maps.Marker({ position: ajdovščina, map: map, icon: imageLJAJ, });
		const markerLJDI = new google.maps.Marker({ position: divača, map: map, icon: imageLJDI, });
		const markerLJBL = new google.maps.Marker({ position: bled, map: map, icon: imageLJBLSG, });
		const markerLJBO = new google.maps.Marker({ position: bovec, map: map, icon: imageLJBO, });
		const markerLJNM = new google.maps.Marker({ position: novo_mesto, map: map, icon: imageLJNM, });
		
		const marker_KAM = new google.maps.Marker({ position: kamnik, map: map, icon: imageU110, });
		const marker_MET = new google.maps.Marker({ position: metlika, map: map, icon: imageU040, });
		const marker_SEN = new google.maps.Marker({ position: sentvid, map: map, icon: imageU140, });
		const marker_VER = new google.maps.Marker({ position: verzej, map: map, icon: imageU040, });
				
		const infoLJLJ = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJLJ - Ljubljana</h2><p>International Civil Aiport</p></div>'});
		const infoLJMB = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJMB - Maribor</h2><p>International Civil Aiport</p></div>'});
		const infoLJPZ = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJPZ - Portorož</h2><p>International Civil Aiport</p></div>'});
		const infoLJCE = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJCE - Cerklje ob Krki</h2><p>Military/Civil Aiport</p></div>'});		
		const infoLJAJ = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJAJ - Ajdovščina</h2></div>'});
		const infoLJBL = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJBL - Bled</h2></div>'});
		const infoLJBO = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJBO - Bovec</h2></div>'});
		const infoLJCL = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJCL - Celje</h2></div>'});
		const infoLJDI = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJDI - Divača</h2></div>'});
		const infoLJNM = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJNM - Novo Mesto</h2></div>'});
		const infoLJMS = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJMS - Murska Sobota</h2></div>'});
		const infoLJPO = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJPO - Postojna</h2></div>'});
		const infoLJPT = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJPT - Ptuj</h2></div>'});
		const infoLJSG = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJSG - Slovenj Gradec</h2></div>'});
		const infoLJSK = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJSK - Slovenske Konjice</h2></div>'});
		const infoLJSO = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">LJSO - Šoštanj</h2></div>'});
		const info_KAM = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">Kamnik</h2></div>'});
		const info_MET = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">Metlika</h2></div>'});
		const info_SEN = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">Šentvid pri Stični</h2></div>'});
		const info_VER = new google.maps.InfoWindow({content: '<div id="content"><h2 id="firstHeading" class="firstHeading">Veržej</h2></div>'});
		
		markerLJLJ.addListener("click", () => { infoLJLJ.open(map, markerLJLJ); });
		markerLJMB.addListener("click", () => { infoLJMB.open(map, markerLJMB); });
		markerLJPZ.addListener("click", () => { infoLJPZ.open(map, markerLJPZ); });
		markerLJCE.addListener("click", () => { infoLJCE.open(map, markerLJCE); });
		markerLJAJ.addListener("click", () => { infoLJAJ.open(map, markerLJAJ); });
		markerLJBL.addListener("click", () => { infoLJBL.open(map, markerLJBL); });
		markerLJBO.addListener("click", () => { infoLJBO.open(map, markerLJBO); });
		markerLJCL.addListener("click", () => { infoLJCL.open(map, markerLJCL); });
		markerLJDI.addListener("click", () => { infoLJDI.open(map, markerLJDI); });
		markerLJNM.addListener("click", () => { infoLJNM.open(map, markerLJNM); });
		markerLJMS.addListener("click", () => { infoLJMS.open(map, markerLJMS); });
		markerLJPO.addListener("click", () => { infoLJPO.open(map, markerLJPO); });
		markerLJPT.addListener("click", () => { infoLJPT.open(map, markerLJPT); });
		markerLJSG.addListener("click", () => { infoLJSG.open(map, markerLJSG); });
		markerLJSK.addListener("click", () => { infoLJSK.open(map, markerLJSK); });
		markerLJSO.addListener("click", () => { infoLJSO.open(map, markerLJSO); });
		marker_KAM.addListener("click", () => { info_KAM.open(map, marker_KAM); });
		marker_MET.addListener("click", () => { info_MET.open(map, marker_MET); });
		marker_SEN.addListener("click", () => { info_SEN.open(map, marker_SEN); });
		marker_VER.addListener("click", () => { info_VER.open(map, marker_VER); });
      }
    </script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-7PCZ5KTEJC"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-7PCZ5KTEJC');
	</script>

  </head>
  <body>
    <h1>VFR Charts - Slovenia</h1>
    <!--The div element for the map -->
    <div id="map"></div>
	
	<div class="section">
	
		<h2>International airports</h2>
		
		<table class="tbtApts">
			<tr>
				<td>LJLJ *</td>
				<td>LJMB *</td>
				<td>LJPZ *</td>
				<td>LJCE *</td>
			</tr>
			<tr>
				<td>Ljubljana</td>
				<td>Maribor</td>
				<td>Portorož</td>
				<td>Cerklje ob Krki</td>
			</tr>		
		</table>
		<p>* Check <a href="https://www.sloveniacontrol.si/acrobat/aip/Operations/history-en-GB.html">AIP Slovenia</a> for latest charts.</p>
		<br />

	</div>
		
	<div class="section">
	
		<h2>Regional airports</h2>
				
		<table class="tbtApts">
			<tr>
				<td>LJAJ</td>
				<td>LJBL</td>
				<td>LJBO</td>
				<td>LJCL</td>
			</tr>
			<tr>
				<td>Ajdovščina</td>
				<td>Bled</td>
				<td>Bovec</td>
				<td>Celje</td>
			</tr>
			<tr>
				<td><a href="image/LJAJ-AC.jpg"><img src="image/thumbnail/LJAJ-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJAJ-GMC.jpg"><img src="image/thumbnail/LJAJ-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJBL-AC.jpg"><img src="image/thumbnail/LJBL-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJBL-GMC.jpg"><img src="image/thumbnail/LJBL-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJBO-AC.jpg"><img src="image/thumbnail/LJBO-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJBO-GMC.jpg"><img src="image/thumbnail/LJBO-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJCL-AC.jpg"><img src="image/thumbnail/LJCL-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJCL-GMC.jpg"><img src="image/thumbnail/LJCL-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
			</tr>
			<tr>
				<td><a href="pdf/LJAJ.pdf">Download PDF</a></td>
				<td><a href="pdf/LJBL.pdf">Download PDF</a></td>
				<td><a href="pdf/LJBO.pdf">Download PDF</a></td>
				<td><a href="pdf/LJCL.pdf">Download PDF</a></td>
			</tr>		
		</table>
		<br />
		<br />
		<br />
		<table class="tbtApts">
			<tr>
				<td>LJDI</td>
				<td>LJMS</td>
				<td>LJNM</td>
				<td>LJPO</td>
			</tr>
			<tr>
				<td>Divača</td>
				<td>Murska Sobota</td>
				<td>Novo Mesto</td>
				<td>Postojna</td>
			</tr>
			<tr>
				<td><a href="image/LJDI-AC.jpg"><img src="image/thumbnail/LJDI-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJDI-GMC.jpg"><img src="image/thumbnail/LJDI-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJMS-AC.jpg"><img src="image/thumbnail/LJMS-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJMS-GMC.jpg"><img src="image/thumbnail/LJMS-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<!--td><i>Novo Mesto is currently in the process of updating Official Airport Manual. Charts will be available as soon as new information is confirmed.</i></td-->
				<td><a href="image/LJNM-AC.jpg"><img src="image/thumbnail/LJNM-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJNM-GMC.jpg"><img src="image/thumbnail/LJNM-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJPO-AC.jpg"><img src="image/thumbnail/LJPO-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJPO-GMC.jpg"><img src="image/thumbnail/LJPO-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
			</tr>
			<tr>
				<td><a href="pdf/LJDI.pdf">Download PDF</a></td>
				<td><a href="pdf/LJMS.pdf">Download PDF</a></td>
				<td><a href="pdf/LJNM.pdf">Download PDF</a></td>
				<td><a href="pdf/LJPO.pdf">Download PDF</a></td>
			</tr>		
		</table>
		<br />
		<br />
		<br />
		<table class="tbtApts">
			<tr>
				<td>LJPT</td>
				<td>LJSG</td>
				<td>LJSK</td>
				<td>LJSO</td>
			</tr>
			<tr>
				<td>Ptuj</td>
				<td>Slovenj Gradec</td>
				<td>Slovenske Konjice</td>
				<td>Šoštanj</td>
			</tr>
			<tr>
				<td><a href="image/LJPT-AC.jpg"><img src="image/thumbnail/LJPT-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJPT-GMC.jpg"><img src="image/thumbnail/LJPT-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJSG-AC.jpg"><img src="image/thumbnail/LJSG-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJSG-GMC.jpg"><img src="image/thumbnail/LJSG-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJSK-AC.jpg"><img src="image/thumbnail/LJSK-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJSK-GMC.jpg"><img src="image/thumbnail/LJSK-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/LJSO-AC.jpg"><img src="image/thumbnail/LJSO-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/LJSO-GMC.jpg"><img src="image/thumbnail/LJSO-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
			</tr>
			<tr>
				<td><a href="pdf/LJPT.pdf">Download PDF</a></td>
				<td><a href="pdf/LJSG.pdf">Download PDF</a></td>
				<td><a href="pdf/LJSK.pdf">Download PDF</a></td>
				<td><a href="pdf/LJSO.pdf">Download PDF</a></td>
			</tr>		
		</table>
		<br />
		<br />

	</div>
	
	<div class="section">
	
		<h2>UL sites</h2>
				
		<table class="tbtApts">
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Kamnik</td>
				<td>Metlika</td>
				<td>Šentvid</td>
				<td>Veržej</td>
			</tr>
			<tr>
				<td><a href="image/_KAM-AC.jpg"><img src="image/thumbnail/_KAM-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/_KAM-GMC.jpg"><img src="image/thumbnail/_KAM-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/_MET-AC.jpg"><img src="image/thumbnail/_MET-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/_MET-GMC.jpg"><img src="image/thumbnail/_MET-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/_SEN-AC.jpg"><img src="image/thumbnail/_SEN-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/_SEN-GMC.jpg"><img src="image/thumbnail/_SEN-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
				<td><a href="image/_VER-AC.jpg"><img src="image/thumbnail/_VER-AC.jpg" alt="AC" class="chart_img" /></a>&nbsp;<a href="image/_VER-GMC.jpg"><img src="image/thumbnail/_VER-GMC.jpg" alt="GMC" class="chart_img" /></a></td>
			</tr>
			<tr>
				<td><a href="pdf/_KAM.pdf">Download PDF</a></td>
				<td><a href="pdf/_MET.pdf">Download PDF</a></td>
				<td><a href="pdf/_SEN.pdf">Download PDF</a></td>
				<td><a href="pdf/_VER.pdf">Download PDF</a></td>
			</tr>		
		</table>
		<br />
		<br />
		<br />
		
	</div>
		
	<div class="section">
		
		<h2>About</h2>
		<p>VFR Approach and Ground Movement Charts were developed by aircraft enthusiasts vountarily and non-profit with a purpose of being a help to pilots when flying to regional airports in Slovenia. They are intended for domestic and foreign pilots that are not familiar with local specifics of each airport.</p>
		<p><b>Although all charts were checked for possible errors by representatives of clubs operating on given airport, these are still unoffical charts and authors do not take any responsibility for incorrect information.</b></p>
		<p>Date of issue is noted in the top section of each chart.</p>
		<p>Printing, copying, sharing of any information from this website or charts themself is encouraged and NOT&nbsp;LIMITED in any way.</p>
		<p>Comments, suggestions etc. can be expressed using contact form below.</p>
		<br />
		<br />
	
	</div>
		
	<div class="section">
		
		<h2>Contact</h2>
	
		<?php if($resultMsg != "") echo "<p style='color: #55AAFF;'>".$resultMsg."&nbsp;</p>"; ?>
		<form method='post' action='index.php'>
			
				<p>Name:&nbsp;<input id='edtAuthor' type='text' name='edtAuthor' /> &nbsp; E-mail:&nbsp;<input id='edtMail' type='text' name='edtMail' /></p>				
				<p><textarea cols='80' rows='5' name='areaContent'>Your message...</textarea></p>
				<p>Security check:&nbsp; 
				<?php 
					echo $firstNo; 
					if($thirdNo >= 10) 
						echo " + ";
					else 
						echo " - ";
					echo $secondNo; 
				?> 
				= <input id='edtCheck' type='text' name='edtCheck' style='width:40px;' /></p>
				<input type="hidden" id="edtFirst" name="edtFirst" value="<?php echo $firstNo ?>">
				<input type="hidden" id="edtSecond" name="edtSecond" value="<?php echo $secondNo ?>">
				<input type="hidden" id="edtThird" name="edtThird" value="<?php echo $thirdNo ?>">
				<p><input type='submit' name='smtOddaj' id='smtOddaj' value='Send' /></p>
			
		</form>
		<br />
		<br />
	
	</div>
		
	<div class="section">
		
		<h2>Disclaimer</h2>
	
		<p>Not for official use. All data for information purposes only. Check latest info in official aerodrome operations manuals and AIP before commencing any flight.</p> 
		<p>Copyleft <span class="copyleft">&copy;</span> 2021.</p>
		<br />
		<br />
	
	</div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key= !!! ENTER KEY HERE !!! &callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>