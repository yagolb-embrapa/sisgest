<?php	
	$qtd_abas = 0;
	require_once("../functions/functions.database.php");//temporario 
	require_once("../functions/functions.forms.php");
	require_once("../sessions.php");

	$cor = true;
			
	//if (!$_GET["pag"]) $pagina = 'a'; else $pagina = $_GET["pag"];
	//$offset = 10; //resultados por pagina.		
	
	//selecao de supervisores
    $qryStr = "SELECT * FROM dados_embrapa ORDER BY id ASC;";	
?>
<style>
.limiter{
	color:#000077;
}
.limiter:hover{
	color:#0000FF;
}

</style>
<?php

$qry = sql_executa($qryStr);
if(sql_num_rows($qry)>0){
	//Imprime uma linha com cada supervisor daquela letra
	while ($row = sql_fetch_array($qry)){
		$cor = !$cor;
	
		echo "
		<div class='lista_registros";echo ($cor)?"1":"0"; echo "'>	
	  	<table width='100%' height='36' border='0' cellpadding='0' cellspacing='0' class='lista_registros_content'>
        <tr>
          <td height='18%'>";          
          	echo $row['nome'];
		echo "</td>
			 <td width='17%' rowspan='2' align='center' valign='middle'>
				<a href='javascript://' onclick=\"document.location.href='dados_embrapa.visualizacao.php?id_dado=".$row['id']."'\">
				<img src='../img/icone_lupa.png' width='16' height='16' />Visualizar Dados</a> </td>		  						
          <td width='15%' rowspan='2' align='center' valign='middle'>
         	<a href='javascript://' onclick=\"document.location.href='dados_embrapa.edicao.php?id_dado=".$row['id']."';\">         	
         	<img src='../img/icon_edit.gif' width='16' height='16' border='0'>Editar Dados</a></td>          
          <td width='17%' rowspan='2' align='center' valign='middle'>";
         	
        echo "</tr>
      </table>
	</div>";	
		
	}
}else{
	//Nao encontrou nenhum supervisor com aquela letra
	echo "<table width='700px' style='border:0px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
				<tr bgcolor='#F5FAFA'>
					<td align='center'><span align='center' style='color:black;'>Nenhum dado da Embrapa cadastrado.</span></td>
				</tr>
			</table>";
}	
	
?>
