<?php
date_default_timezone_set('America/Recife');

//DADOS DAEMON NIOBIOCASH
$serversimplewallet = ""; //Ex: http://SERVERDAEMON.COM
$portsimplewallet = ""; // Ex: 8020

$faucetTitle = 'Nióbio Cash Faucet';
$moedafaucet = 'Nióbio Cash [NBR]';

require "includes/conexao.php";



// Faucet address for donations
// Replace by your wallet address
$faucetAddress = 'NEBPKaown9uK2T4PvyWXVpAHdotb7NZx7XszLKFswfh2RAqSKxEfx6y99Hib3PihJVEU4tR1ZQEtLLiCfeR5zubTUpzGjpU';

// Reward time in minutes - Intervalo em minutos para o envio das moedas 
$rewardEvery = '5';
$randmax = rand(1,100); 

if($randmax>80){
$valmax = "1";
}else{
$valmax = "0.5";
}
$valmmin = "0.0001";



//EXIBIR DIA e HORA SORTEIOS NBRWIN
$diasorteio = "11/08/2018";
$horasorteiostart = "21:00";
$horasorteioend = "22:00";

//CONFIGURAR DIA E HORA DO SORTEIO NBRWIN
$dataagoraagoraserver = date("dmY:H");
$datapaga = "11082018:21";

if($dataagoraagoraserver=="$datapaga"){
$valmmin = "3";
$valmax = "5";
$rewardEvery = '25';
}else{

// echo "NO - $dataagoraagoraserver -  $datapaga";
}
   

// Max reward and min reward as decimals Ex: Min = 10.0 & Max = 20.0
$minReward = $valmin; //Remember that the minimum -  valor mínimo para o envio
$maxReward = $valmax;

// Transaction fee is set to 0.01 BCN for every request.

$faucetSubtitle = "A cada <b>$rewardEvery Minutos </b> você pode obter Nióbio Cash grátis";
$logo = 'https://niobiocash.moedasdigitais.nl/css/NBR-FAUCET-LV.png';

// Database connection
// Replace by your database credentials
$userDB = DBUSER2;
$database = DBNAME2;
$passwordDB = DBPASS2;
$hostDB = DBHOST2;



// Recaptcha INVISIBLE Key. You can get yours here: https://www.google.com/recaptcha/
// Replace by your keys
$keys = array('site_key' => '6LfJEyQUAAAAAJTeU3g0mZu4le1uEvE9KNqiIZbV');






