<?php
ini_set('max_execution_time', 20);
require_once 'classes/jsonRPCClient.php';
require_once 'config.php';
?>
<?php
include("top.php");
?>

<div class='container' style='background-color: #fff;'>


<?php echo "$ads"; ?>


            <?php
            $niobiocash = new jsonRPCClient("$serversimplewallet:$portsimplewallet/json_rpc");
            $balance = $niobiocash->getbalance();
			             
            $balanceDisponible = $balance['available_balance'];
            $lockedBalance = $balance['locked_amount'];
            $dividirEntre = 100000000;
     
            $totalBCN = ($balanceDisponible + $lockedBalance) / $dividirEntre;
            $balanceDisponibleFaucet = number_format(round($balanceDisponible / $dividirEntre, 12), 12, '.', '');
    
            ?>

       
          
                <div class='alert alert-info radius'>
              
                    <?php

                    $link = new PDO('mysql:host=' . $hostDB . ';dbname=' . $database, $userDB, $passwordDB);

                    $query = 'SELECT SUM(payout_amount) / 100000000 FROM `payouts`;';

                    $result = $link->query($query);
                    $dato = $result->fetchColumn();

                    $query2 = 'SELECT COUNT(*) FROM `payouts`;';

                    $result2 = $link->query($query2);
                    $dato2 = $result2->fetchColumn();

                    ?>

                    Realizados: <?php echo $dato; ?> <?php echo $moedafaucet; ?> de <?php echo $dato2; ?> pagamentos.
                </div>
            <div class='table-responsive' style='max-width: 900px;'>
                    <h2><b>Últimos vencedores de Sorteios no <?php echo $faucetTitle; ?> !</b></h2>
                    <table class='table table-bordered table-condensed'>
                        <thead>
                        <tr>
                            <th>Data/hora</th>
                           <th>Valor</th>
  <th>Id Pagamento</th>
  <th>Carteira</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

$maxpay = 1*$dividirEntre;
$queryCheck = "SELECT * FROM `payouts` WHERE (`payout_amount` > '$maxpay' AND `payout_address` != '') ORDER BY timestamp DESC LIMIT 100";
        $resultCheck = $link->query($queryCheck);
$totalmoeda = 0;
        $count = 0;
        foreach ($resultCheck->fetchAll(PDO::FETCH_ASSOC) as $cou) {
        $couID =  $cou['payout_address'];
        $couV =  $cou['payout_amount'];
         $couP =  $cou['payment_id'];
        $time1 =  $cou['timestamp']; 
        
        $date = date_create($time1);
        
$time = date_format($date, 'd-m-Y');
        
        $couID = substr($couID, 0, -80);
         $couP = substr($couP, 0, -50);
        $couV =  round($couV / $dividirEntre, 8);
        
          echo '<tr>';
                                    echo '<th>' . $time  . '</th>';
                                   echo '<th>' . $couV. '</th>';
                                
                                 echo '<th>' . $couP. ' ...</th>';
                                echo '<th>' . $couID . ' ...</th>';
                                echo '</tr>';
        
     
            $count++;
        }

 ?>
                        </tbody>
                        
                
                    </table>




                </div>
                                                
<?php echo "$ads"; ?>

          
          <?php
          include("out.php");
          ?>
