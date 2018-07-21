      
</div>
<?php include_once("dadosfaucetg.php"); ?>

      <p style="font-size: 2vh;">
              Doe  <?php echo "$moedafaucet"; ?> 
                 <br />
Carteira do Faucet  <?php echo "$moedafaucet"; ?>

  <br />
<b><?php echo $faucetAddress; ?></b>

</p>




<footer>
 <a href="https://niobiocash.nl">© Copyright <?php echo date("Y"); ?> - NIOBIOCASH.MOEDASDIGITAIS.NL </a>
</footer>
           

    
<script src='//code.jquery.com/jquery-1.11.3.min.js'></script>
<?php if (isset($_GET['msg'])) { ?>
    <script>
        setTimeout(function () {
            $('#alert').fadeOut(3000, function () {
            });
        }, 10000);
    </script>
<?php } ?>
</body>
</html>