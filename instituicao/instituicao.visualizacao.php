<?php 

$qtd_abas = 0;
require_once("../inc/header.php");

include("../functions/functions.database.php");//temporario 
include("../functions/functions.forms.php");

function dia_extenso($d){
	switch($d){
		case 2:
			return "Segunda-Feira";			
			break;	
		case 3:
			return "Terça-Feira";
			break;
		case 4:
			return "Quarta-Feira";
			break;
		case 5:
			return "Quinta-Feira";
			break;
		case 6:
			return "Sexta-Feira";
			break;
		default:
			return "<i>Indefinido</i>";
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
		<span class='titulo'>.: Visualização de Estagiário</span>
		<div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>
		
<?php
$id = $_GET['id'];

if(empty($id))
	$msg_erro = "A instituição não foi encontrada.";		
else{		
	$query_estag = "SELECT * FROM instituicoes_ensino WHERE id = {$id}";
	$result_estag = sql_executa($query_estag);	
	if(sql_num_rows($result_estag)==0)
		$msg_erro = "A instituição não foi encontrada.";			
	else
		$campo = sql_fetch_array($result_estag);
}

//mostra mensagem de erro ou mostra os dados
if($msg_erro){
	echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
			<tr bgcolor='#FFEFEF'>					<td align='center'><span align='center' style='color:red;'>{$msg_erro}</span></td>
			</tr>
		</table>		
	<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
}else{
    echo "<p><a href='javascript://' onclick=\"document.location.href='instituicao.edicao.php?id=".$id."';\">
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
        <td width="33%"><span>Razão Social</span></td>
        <td width="67%"><span><?php echo (empty($campo['razao_social']))?" <i>Não preenchido</i> ":$campo['razao_social']; ?></span></td>        
      </tr>
       <tr class='specalt'>
        <td ><span>CNPJ</span></td>
        <td><span><?php echo (empty($campo['cnpj']))?" <i>Não preenchido</i> ":$campo['cnpj']; ?></span></td>
       </tr>              
       <tr class='specalt'>
        <td><span>Endereço</span></td>
        <td><span><?php echo (empty($campo['endereco']))?" <i>Não preenchido</i> ":$campo['endereco']; ?></span></td>
      </tr>
        <tr class='specalt'>
        <td ><span>Complemento</span></td>
        <td><span><?php echo (empty($campo['complemento']))?" <i>Não preenchido</i> ":$campo['complemento']; ?></span></td>
       </tr>
        <tr class='specalt'>
        <td ><span>CEP</span></td>
        <td><span><?php echo (empty($campo['cep']))?" <i>Não preenchido</i> ":$campo['cep']; ?></span></td>
       </tr>
        <tr class='specalt'>
        <td ><span>Bairro</span></td>
        <td><span><?php echo (empty($campo['bairro']))?" <i>Não preenchido</i> ":$campo['bairro']; ?></span></td>
       </tr>       
       <tr  class='specalt'>
        <td><span>UF</span></td>
        <td><span><?php echo (empty($campo['uf']))?" <i>Não preenchido</i> ":$campo['uf']; ?></span></td></tr>
       <tr  class='specalt'>
        <td><span>Município</span></td>
        <td><span><?php 
	   		$q_mun = "SELECT nome FROM municipios WHERE id = {$campo['id_municipio']}";
        		$r_mun = sql_executa($q_mun);
        		$c_mun = sql_fetch_array($r_mun);     
   	      echo (empty($c_mun['nome']))?" <i>Não preenchido</i> ":$c_mun['nome']; ?></span></td>	    
       </tr>

        <tr class='specalt'>
        <td ><span>Data convênio</span></td>
        <td><span><?php echo (empty($campo['data_convenio']))?" <i>Não preenchido</i> ":formata($campo['data_convenio'],'redata'); ?></span></td>
       </tr>       

         <tr class='specalt'>
        <td ><span>Número SAIC</span></td>
        <td><span><?php echo (empty($campo['numero_saic']))?" <i>Não preenchido</i> ":$campo['numero_saic']; ?></span></td>
       </tr>       
 
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
