<?php 

$qtd_abas = 0;
require_once("../inc/header.php");
require_once("../classes/DB.php");

include("../functions/functions.database.php");//temporario 
include("../functions/functions.forms.php");

$id_dado = $_GET['id_dado'];

if(empty($id_dado)) {
  $msg_erro = "O dado não foi encontrado.";   
} else {
  $qryStr = "SELECT * FROM dados_embrapa WHERE id = {$id_dado}";
  $qry = sql_executa($qryStr);
  $dados = sql_fetch_array($qry);
  if(sizeof($dados) == 0) {
    $msg_erro = "O dado não foi encontrado.";
  }
}
?>

<script language="javascript" src="../js/TAjax.js"></script>
<!-- TR de CONTEUDO -->  
<tr>
  <td width='752' height="300" align="center" valign=top style="padding:20px 10px 0 10px;">
	<!-- DIV DE ESPAÇAMENTO -->  
   <div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>  
		
	<div class='divTitulo' align='left'>
		<span class='titulo'>.: Visualização de dados da Embrapa</span>
		<div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>
		
<?php

//mostra mensagem de erro ou mostra os dados
if($msg_erro){
	echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
			<tr bgcolor='#FFEFEF'>					<td align='center'><span align='center' style='color:red;'>{$msg_erro}</span></td>
			</tr>
		</table>		
	<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
}else{
    echo "<p><a href='javascript://' onclick=\"document.location.href='dados_embrapa.edicao.php?id_dado=".$id_dado."';\">
        <img src='../img/icon_edit.gif' width='16' height='16' border='0'>Editar Dados</a></p>";
?>
   <!-- Abas -->	
	<ul class='listaAbas'>
       <li><a id='a1' class='active'>Dados</a></li>      
   </ul>
   </div>
	<div id="aba1" class='conteudoAba' style='display:block;'>		  	 	
  	  	<table width="100%" class='visualizacao'>
  	  	<tr><td colspan='2'><div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div></td></tr>		  
      <tr class='specalt'>
        <td width="33%"><span>Tipo</span></td>
        <td width="67%"><span><?php echo $dados['nome']; ?></span></td>        
      </tr>    
      <?php
        switch ($id_dado) {
            case 1:
              ?>
              <tr class='specalt'>
                <td width="33%"><span>Nome</span></td>
                <td width="67%"><span><?php echo $dados['dado1']; ?></span></td>        
              </tr>   
              <tr class='specalt'>
                <td width="33%"><span>CPF</span></td>
                <td width="67%"><span><?php echo $dados['dado2']; ?></span></td>        
              </tr> 
              <tr class='specalt'>
                <td width="33%"><span>RG</span></td>
                <td width="67%"><span><?php echo $dados['dado3']; ?></span></td>        
              </tr>  
              <?php
              break;
            case 2:
              ?>
              <tr class='specalt'>
                <td width="33%"><span>Nome</span></td>
                <td width="67%"><span><?php echo $dados['dado1']; ?></span></td>        
              </tr> 
              <tr class='specalt'>
                <td width="33%"><span>CPF</span></td>
                <td width="67%"><span><?php echo $dados['dado2']; ?></span></td>        
              </tr> 
              <?php
              break;
            case 3:
              ?>
              <tr class='specalt'>
                <td width="33%"><span>Nome</span></td>
                <td width="67%"><span><?php echo $dados['dado1']; ?></span></td>        
              </tr>
              <tr class='specalt'>
                <td width="33%"><span>Apólice nº</span></td>
                <td width="67%"><span><?php echo $dados['dado2']; ?></span></td>        
              </tr>  
              <?php
              break;
            default:
              break;
          }  
      ?>    
       <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
       </table>
       </div>
            
    </table>  
  </div></div>
 </div> 
</div>
<?php
}
echo "
  </td>
</tr>
</table>";
 
include_once('../inc/copyright.php');
?>
</div>
