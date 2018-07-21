     <h4><a class="btn btn-success btn-lg" href="nbrwin.php">[NBRWIN Vencedores dos Sorteiros] </a></h4>
                        
 <?php

                    $link = new PDO('mysql:host=' . $hostDB . ';dbname=' . $database, $userDB, $passwordDB);

                    $query = 'SELECT SUM(payout_amount) / 100000000 FROM `payouts`;';

                    $result = $link->query($query);
                    $dato = $result->fetchColumn();

                    $query2 = 'SELECT COUNT(*) FROM `payouts`;';

                    $result2 = $link->query($query2);
                    $dato2 = $result2->fetchColumn();

                    ?>

                   <h3>
                 Enviados: <?php echo $dato; ?> [NBRs]  em <?php echo $dato2; ?> pagamentos. </h3>
                    <h4>
                 <br/>
                 
     
  <?php
  ///PUBLICIDADE ADS
  echo "$ads";
  ?>
                        
                    
  