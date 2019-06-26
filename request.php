<?php
ini_set('max_execution_time', 60);
require_once 'classes/jsonRPCClient.php';
require_once 'config.php';

$gpw = trim($_POST['gpw']);
$gpw2 = trim($_POST['gpk']);

if($gpw==""){
    
      header('Location: ./?msg=paymentID');
                exit();
}          
            
$link = new PDO('mysql:host=' . $hostDB . ';dbname=' . $database, $userDB, $passwordDB);

function randomize($min, $max)
{
    $range = $max - $min;
    $num = $min + $range * mt_rand(0, 32767) / 32767;
    return round($num, 4);
}



        //Checking address and payment ID characters
        $wallet = $str = trim(preg_replace('/[^a-zA-Z0-9]/', '', $_POST['wallet']));
        $paymentidPost = $str = trim(preg_replace('/[^a-zA-Z0-9]/', '', $_POST['paymentid']));
  
   
        //Getting user IP
         $direccionIP = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');


        if (empty($wallet) OR (strlen($wallet) < 95)) {
            header('Location: ./?msg=wallet');
            exit();
        }

        if (empty($paymentidPost)) {
            $paymentID = '';
        header('Location: ./?msg=paymentID');
                exit();
        } else {
            if ((strlen($paymentidPost) > 64) OR (strlen($paymentidPost) < 64)) {
            
                header('Location: ./?msg=paymentID');
                exit();
            } else {
                $paymentID = $paymentidPost;
            }
        }

        $queryCheck = "SELECT `id` FROM `payouts` WHERE `timestamp` > NOW() - INTERVAL $rewardEvery MINUTE AND ( `ip_address` = '$direccionIP' OR `payout_address` = '$wallet')";
        $resultCheck = $link->query($queryCheck);
        $count = 0;
        foreach ($resultCheck->fetchAll(PDO::FETCH_ASSOC) as $cou) {
            $count++;
        }

        if ($count) {
            header('Location: ./?msg=notYet');
            exit();
        }

        $niobiocash = new jsonRPCClient("$serversimplewallet:$portsimplewallet/json_rpc");
        $balance = $niobiocash->getbalance();
        $balanceDisponible = $balance['available_balance'];
        $transactionFee = 1000; //NBR TAXA/FEE 0.00001
        $dividirEntre = 100000000;

        $hasta = number_format(round($balanceDisponible / $dividirEntre, 12), 2, '.', '');
    
  
        if ($hasta > $maxReward) {
            $hasta = $maxReward;
        }
    $minR = $minReward + 0.00001;
    

        if ($hasta < ((float) $minR)) {
            header('Location: ./?msg=dry');
            exit();
        }

     
       $aleatorio = randomize($minR, $hasta);
      

        $cantidadEnviar = ($aleatorio * $dividirEntre) - $transactionFee;


        $destination = array('amount' => $cantidadEnviar, 'address' => $wallet);
        $date = new DateTime();
        $timestampUnix = $date->getTimestamp() + 5;
        $peticion = array(
            'destinations' => $destination,
            'payment_id' => $paymentID,
            'fee' => $transactionFee,
            'mixin' => 0,
            'unlock_time' => 0
        );

        $transferencia = $niobiocash->transfer($peticion);

        if ($transferencia == 'Bad address') {
            header('Location: ./?msg=wallet');
            exit();
        }

        if (array_key_exists('tx_hash', $transferencia)) {
            $query = "INSERT INTO `payouts` (`payout_amount`,`ip_address`,`payout_address`,`payment_id`,`timestamp`) VALUES ('$cantidadEnviar','$direccionIP','$wallet','$paymentID',NOW());";

            if ($link->exec($query)) {
                header('Location: ./?msg=success&txid=' . $transferencia['tx_hash'] . '&amount=' . $aleatorio);
            } else {
                header('Location: ./?msg=erro_banco');
            }

            exit();
        }else{
            
            header('Location: ./?msg=erro_banco');
            exit();
        }
exit();
