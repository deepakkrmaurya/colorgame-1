<?php
// Initialize the session
session_start();
 

require_once "config.php";



$code=$_GET["id"];



if($_SERVER["REQUEST_METHOD"] == "POST"){
    
$sql8 = "SELECT amount,share FROM `gift` WHERE code='$code'";
$result = $conn->query($sql8);
$row8 = mysqli_fetch_array($result);
$amount=$row8[amount];
$share=$row8[share];

if($share==0){
 $new=$amount;  
}else{
  $new=$share;  
}

$phone=trim($_POST["phone"]);

if($amount>0 and $share>0 ){
   $opt9="SELECT COUNT(*) as total9 FROM giftrec  WHERE code='$code' AND phone='$phone' ";
$optres9=$conn->query($opt9);
$sum9= mysqli_fetch_assoc($optres9);

if($sum9['total9']=="" or $sum9['total9']=="0" ){
    
 $sql = "UPDATE users SET  money = money+$new WHERE phone='$phone' "; 
 $conn->query($sql);
  $sql4 = "UPDATE gift SET  amount = ($amount-$new) WHERE code='$code' "; 
 $conn->query($sql4);
  $sql5 = "INSERT INTO giftrec (code,phone,amount ) VALUES ('$code','$phone', $new)";
                
                if ($conn->query($sql5) === TRUE){
                         echo "<script>
     document.addEventListener('DOMContentLoaded', function(event) { 
     
                
          document.getElementById('pop').style.display= '';
});
                
     
                </script>";
                      $err="gift claim successfull";
                }
   
}else{
  $err= "gift already claimed ";
}
 
}else{
    $err="gift completed";
}

}







$query =  "SELECT  * FROM giftrec where code='$code' ORDER BY id DESC ";


// result for method one
$result1 = mysqli_query($conn, $query);

// result for method two 
$result2 = mysqli_query($conn, $query);
$rowcount=mysqli_num_rows($result2);
    

$dataRow = "";

while($row2 = mysqli_fetch_array($result2))
{
  		$dataRow = $dataRow."<div class='row tfwr tf-14 pt-1 pb-1'>
			<div class='col-6 xtl'>$row2[4]</div>
			<div class='col-6 xtr tfss'>$row2[3]</div>
		</div>";
		
}


?>
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="expires" content="1">
<meta name="google" value="notranslate">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<meta name="msapplication-navbutton-color" content="#ffffff">
<meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">
<meta name="description" content="Make money with ">
<link rel="shortcut icon" href="/icons/fevicon.png" type="image/x-icon">
<meta property="og:description" content="Make money with ">
<meta property="url" content="">
<meta property="type" content="website">
<meta property="title" content="">
<meta property="description" content="Make money with ">
<meta property="image" content="/icons/fevicon.png">
<meta itemprop="image" content="/icons/fevicon.png">
<link rel="stylesheet" href="/css1/bootstrap.min.css">
<link rel="stylesheet" href="/css1/light.css">
<link rel="stylesheet" href="/css1/dropzone.css">
<title>Lifafa</title>
<style>
    

</style>
</head>
<body>
<section class="container-fluid">
	<div class="row mcas">
		<div class="col-md-6 col-lg-4 wms-tf-24 xtc main lfmx">
			<div class="row nav-top auto tfcdg lfnav">
					<div class="col-12 xtl"><span class="nav-back"></span></div>
			</div>

			<div class="row airfrm mb-2">
				<div class="col-12">
				    <form action="" id="card" method="POST" >
					<div class="inpbcx rc tfcb">
						<span class="xicon rc">+91</span><input type="tel" class="xbox rcamt" maxlength="10" autocomplete="off" id="mob" name="phone" style="font-size: 34px;height: 63px;">
						
					</div>
					<h1 style="color:red;font-size: 23px;"  ><?php echo $err?></h1>
					</form>
				</div>
			
				<div class="col-12 mt-4 pa-0" ><div class="btn-main act openair" onclick="sub()">Get It Now</div></div>
			</div>
			<div class="row airfrm mb-2" id="pop" style="    margin-top: -200px;
    position: fixed;
    width: 70%;
    margin-left: 10%;
    height: 200px;
    display:none;">
				<div class="col-12">
				    <div id="card" >
					<div class="inpbcx rc tfcb" style="border-bottom: white;">
						<span style="color:#28a745;font-size:70px;    position:fixed;left: 35%;"> ₹<?php echo $new;?></span>
						<span style='position: fixed;left: 30%;padding-top:100px;'>You got ₹<?php echo $new;?> Lucky Rupees</span>
						
					</div>
					
					</div>
				</div>
			
				<div class="col-12 mt-4 pa-0"><div class="btn-main act openair"  onclick="window.location.href='https://jetx.lalabetix.com/'">Visit Jaz20</div></div>
			</div>
			<div class="row mr-0 tf-12 lfrcd"><div class="col-12 tfs-w" id="boxrc">
<?php echo $dataRow;?>

	
	</div></div>


			<div class="row smg"></div>
		</div>
	</div>
</section>
<script >
    function sub() {
      document.getElementById('card').submit();  
     console.log("submit");
}
</script>
</body></html>