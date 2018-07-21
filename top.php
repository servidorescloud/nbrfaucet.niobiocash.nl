<?php
date_default_timezone_set('America/Recife');
session_start();
//$expire_stamp = date('H:i:s', strtotime("5 min"));
$now_stamp    = date("Y/F/J, H:i:s");

$expiry = 300;//session expiry required after 5 mins
    if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {
        session_unset();
        session_destroy();
    }
$_SESSION['LAST'] = time();

$tempoexperia = $expiry/60;


$uslink = $_SESSION["uslink"];

if($uslink==""){
$uslink = rand(1000,100000);

$uslink =  md5($uslink);
$_SESSION["uslink"] = "$uslink";

}

$dataagora = date("d/m/Y : H:i:s");

$dataagora2= date("d:m:Y");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title><?php echo $faucetTitle; ?></title>
    <meta http-equiv="refresh" content="300">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='shortcut icon' href='images/favicon.ico'>
    <link rel='icon' type='image/icon' href='images/favicon.ico'>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <link rel='stylesheet' href='css/style.css'>
    
    
     <script>var isAdBlockActive = true;</script>
    <script src='js/advertisement.js'></script>
    <script>
        if (isAdBlockActive) {
            window.location = 'adblocker.php'
        }
    </script>
    
<script type="text/javascript" src="https://code.jquery.com/jquery-git2.min.js"></script>
 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2036400419784635",
    enable_page_level_ads: true
  });
</script>


<style>
    .nbrbomb {
    font-weight: bold;
    color: red; 
    
}
.nbrfreecell {
    font-weight: bold;
    color: green; 
    
}
    .gmn{
        font-size: 25px;
        max-width: 350px;
        font-weight: bold;
    }
    
</style>
</head>

<body>

    
<div class='container'>
<?php include("menu.php"); ?>
<a href="index.php"><img style="width:50%; margin: auto; " class="img-responsive" src="<?php echo "$logo"; ?>" /></a>
    <h1>FAUCET - <?php echo "$moedafaucet"; ?></h1>
    
<?php 
//PUBLICIDADE - ADS

echo "$ads"; 

?>
<?php

echo "
<h5 style='font-size: 16px; font-weight: bold;'>[NBRFAUCET: Próximo Sorteio de NBRs Grátis ira ocorrer no dia $diasorteio das $horasorteiostart até $horasorteioend hrs horário de Brasília]  </h5> 
";




?>


<small>Obs: Sorteios realizado de forma aletória para quem Jogar, Ganhar e Solicitar o valor no FAUCET exatamente neste horário! <br /> Data e Hora atual do FAUCETNBR: <b><?php echo "$dataagora"; ?> </b></small>
<br />
