<style>
td {
  border: 5px solid #262626;
  padding: 7px 10px;
  margin: 2px;
  width: 55px;
  height: 55px;
  text-align: center;
  cursor: pointer;
  font: bold 16px arial;
  background-color: #bfbfbf;

}
td:active {

      background-color: #FFFFFF;
     text-shadow: 2px 2px 4px #000000;
     color: #FFFFFF;

}

td.mark {
  color: red;
  background-color: #FFF;
  
}
td.bomb {
   color: transparent;
  background-color: red;
  background-image: url("images/bomb.png");
}
.lost td.bomb {
  color: transparent;
  background-color: red;
  background-image: url("images/bomb.png");
  
    
}

</style>



<div style="max-width: 900px; padding: auto; margin: auto; text-align:center;">
    
<h1>Jogue e concorra até 1  <?php echo "$moedafaucet"; ?> Grátis</h1>

<em>Obs: Os valores serão disponibilizados de forma aleatória a cada <B><?php echo "$rewardEvery"; ?> Minutos</B>!</em>

<form>

<input class="span3" type="hidden" id="rows" value="6" min="5" max="24" step="2"><br>
 <input class="span3" type="hidden" id="cols" value="6" min="5" max="24" step="2"><br>


<div class="quarter cell" style="font-size: 12px; text-align: center;">
<label for="bombs"></label>  <input class="span3" class="form-group" type="hidden" id="bombs" value="3" min="2" max="30"><br>

</div>
		
<div class="btn-group">
<a class="btn btn-primary" id="new-game" href="#">Novo Jogo</a>
<a class="btn" id="cheat" href="#">Exibir as Bombas</a>

<BR />
<BR />
<BR />

</div>

<input type="submit" style="visibility: hidden">
</form>
</div>
<div class="span9">
<div id="status" class="alert" style="text-align: center; max-width: 600px; margin: auto;"></div>
<table id="minesweeper" style="text-align: center; max-width: 1000px; margin: auto;"></table>
</div>
</div>
</div>


</div>


</div>



    <script data-cfasync="false"  type="text/javascript" src="pret.php"></script>
 <script id="js" data-cfasync="false" type="text/javascript" src="cmp.php?codeg=<?php echo "$uslink"; ?>"></script>
<h3 class="btn btn-info btn-lg"> <a style="color: #FFF; font-weight: bold;" href="https://nbrservices.niobiocash.nl/"> <img height="35" src ="https://niobiocash.moedasdigitais.nl/css/LOGO-NBR-NL-LV.png" /> NBRSERVICES </a></h3>
   </div>