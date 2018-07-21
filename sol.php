<?php
session_start();
ini_set('max_execution_time', 120);
require_once 'classes/jsonRPCClient.php';
require_once 'config.php';
include("top.php");
$gpw = $_GET['gpw'];
$uslinkf = $_SESSION["uslink"];

$PAYIDFAUCET = bin2hex(openssl_random_pseudo_bytes(32));


if($gpw==""){
    echo "ERRO!";
    exit;
}

if($gpw!=$uslinkf){
    echo "ERRO! SESSION EXPIRED";
    exit;
}

?>

  <div id='login-form' style="margin: auto;">
   
            <br/>

            <?php

if($uslinkf!=""){

 
            $niobiocash = new jsonRPCClient("$serversimplewallet:$portsimplewallet/json_rpc");
            $balance = $niobiocash->getbalance();
 
            $balanceDisponible = $balance['available_balance'];
            $lockedBalance = $balance['locked_amount'];
            $dividirEntre = 100000000;
     
            $totalBCN = ($balanceDisponible + $lockedBalance) / $dividirEntre;
            //Available Balance
            $balanceDisponibleFaucet = number_format(round($balanceDisponible / $dividirEntre, 12), 12, '.', '');
        

}elseif($gpw==""){

echo "<H3>Sessão Expirada </H3> - 1";

exit;

}elseif($gpw!="$uslinkf"){
echo "<H3>Sessão Expirada</H3> - 2 ";

exit;
}

$randk = rand(32, 64);

$gpw = bin2hex(openssl_random_pseudo_bytes($randk));

$gpk = bin2hex(openssl_random_pseudo_bytes($randk));


            ?>

            
           <h4> Não tem carteira/Wallet ? <a target="_blank" href="https://moedasdigitais.nl/wc/nbr">Clique aqui!</a></h4>
    <script src="https://www.google.com/recaptcha/api.js"></script>
<script>
       function onSubmit(token) {
         document.getElementById("enviar-us").submit();
       }
     </script>
       
            <form action='request.php' id='enviar-us' method='POST'>

            
            
                <?php if (isset($_GET['msg'])) {
                    $mensaje = $_GET['msg'];

                    if ($mensaje == 'captcha') {
                        ?>
                        <div id='alert' class='alert alert-error radius'>
                            Captcha inválido, digite o correto.
                        </div>
                    <?php } else if ($mensaje == 'wallet') { ?>

                        <div id='alert' class='alert alert-error radius'>
                            Digite o endereço NBR correto.
                        </div>
                    <?php } else if ($mensaje == 'success') { ?>

                        <div class='alert alert-success radius'>
                            Você ganhou <?php echo $_GET['amount']; ?> NBRs.<br/><br/>
                            Receberá <?php echo $_GET['amount'] - 0.0001; ?> NBRs. (fee de 0.0001)<br/>
                            <a target='_blank'
                               href='http://nbrexplorer.niobiocash.nl/?hash=<?php echo $_GET['txid']; ?>#blockchain_transaction'>Confira na Blockchain.</a>
                        </div>
                    <?php } else if ($mensaje == 'paymentID') { ?>

                        <div id='alert' class='alert alert-error radius'>
                            Verifique o seu ID de pagamento. <br>Deve ser composto por 64 caracteres sem caracteres especiais.
                        </div>
                    <?php } else if ($mensaje == 'notYet') { ?>

                        <div id='alert' class='alert alert-warning radius'>
                            Os nióbios são emitidos uma vez a cada <?php echo "$rewardEvery"; ?> horas. Venha mais tarde.
                        </div>
                    <?php } else if ($mensaje == 'dry') { ?>

                        <div id='alert' class='alert alert-warning radius'>
                            Não há niobios agora. Não foi dessa vez. Tente novamente.
                        </div>
                    <?php } elseif ('erro_banco' == $mensaje) { ?>
                        <div id='alert' class='alert alert-warning radius'>
                            Erro do banco de dados, contate o administrador.
                        </div>
                    <?php }?>

                <?php } ?>
           
     
                    <?php

                    $link = new PDO('mysql:host=' . $hostDB . ';dbname=' . $database, $userDB, $passwordDB);

                    $query = 'SELECT SUM(payout_amount) / 100000000 FROM `payouts`;';

                    $result = $link->query($query);
                    $dato = $result->fetchColumn();

                    $query2 = 'SELECT COUNT(*) FROM `payouts`;';

                    $result2 = $link->query($query2);
                    $dato2 = $result2->fetchColumn();

                    ?>

               

                <?php if ($balanceDisponibleFaucet < 0.01) { ?>
                    <div class='alert alert-warning radius'>
                        A carteira está vazia ou o saldo é menor do que o ganho. <br> Venha mais tarde, &ndash; podemos receber mais doações.
                    </div>
                <?php } elseif (!$link) {
                    die('Erro na conexao com o banco de dados' . mysql_error());
                } else { ?>

                    <input type='text' name='wallet' required placeholder='Endereço da carteira NBR'>

                    <input type='hidden' name='gpw' value='<?php echo "$gpw"; ?>'>
  
  

                    <input type='text' name='paymentid'  value='<?php echo "$PAYIDFAUCET"; ?>' placeholder='ID do pagamento / PAYID (OBRIGATÓRIO)'>
                    <br/>
                  
                    <br/>
                
 <center>
<button class="g-recaptcha" data-sitekey="<?php echo $keys['site_key']; ?>"  data-callback="onSubmit" style="border: 1px solid #666; padding: 2px; margin:2px;"><p class="btn btn-primary btn-block btn-lg">Solicitar NBR!</p></button>

                 </center>
                    <br>
                  
                <?php } ?>
                <br>
           
             
            
            </form>

                </div>
                  
  

 <?php
                
                
         include("out.php");       
                
                ?>
            
