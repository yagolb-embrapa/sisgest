<?php
	$qtd_abas = 0;
	require_once("../functions/functions.database.php");//temporario 
	require_once("../functions/functions.forms.php");
	session_start();
	$cor = true;
			
    $pagina = isset($_GET['pag']) ? $_GET['pag'] : 'a';
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'estagiario';
	$offset = 10; //resultados por pagina.		
	if (!$_GET["pagina"]) $pagina = 1; else $pagina = $_GET["pagina"];
	$qryStr = "SELECT id_supervisor FROM users WHERE id = '".$_SESSION["USERID"]."'";
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
//*************************** OLHAR ISSO ***************************//
$qryStr = "SELECT es.id, es.nome, ct.id_categoria, ct.id_status, ct.vigencia_inicio, ct.vigencia_fim, ct.id_supervisor, ct.numero_projeto, ct.remuneracao, ct.numero_contrato
			FROM estagiarios AS es INNER JOIN contratos AS ct ON es.id = ct.id_estagiario 
			ORDER BY ct.id_status ASC, ct.vigencia_inicio DESC 
			LIMIT ".$offset." OFFSET ".(($offset*$pagina)-$offset)."";
$qry = sql_executa($qryStr);
if($qry) {
	$qtd = sql_num_rows($qry);
	if($qtd>0) { ?>
		<table width="100%" border="0" cellpadding="1" cellspacing="1" class="lista_registros2">
			<tr>
	  			<th width="20%" align="left"><strong>Nome do aluno</strong></th>
	  			<th width="20%" align="left"><strong>Supervisor</strong></th>
	  			<th width="10%" align="center"><strong>Categoria</strong></th>
	  			<th width="15%" align="center"><strong>Cód. projeto</strong></th>
	  			<th width="15%" align="center"><strong>Vigência</strong></th>
	  			<th width="10%" align="center"><strong>Remuneração</strong></th>
	  			<th width="10%" align="center"><strong>Status</strong></th>
			</tr>		
<?php 
		while ($row = sql_fetch_array($qry)) {	
			$cor = !$cor;
			if($cor) {
				?><tr class="lista_registros0"><?php
			} else {
				?><tr class="lista_registros1"><?php
			}
			?>
	  			<td width="20%" align="left"><?php echo "<a href='../estagiario/estagiario.visualizacao.php?id=".$row['id']."&contrato=".$row['numero_contrato']."'>".$row['nome']."</a>"; ?></td>
	  			<?php
	  				$qryStrSup = "SELECT nome FROM supervisores WHERE id = '".$row["id_supervisor"]."'";
					$qrySup = sql_executa($qryStrSup);
					$rowSup = sql_fetch_array($qrySup); 
	  			?>
	  			<td width="20%" align="left"><?php echo $rowSup['nome']; ?></td>
	  			<?php
					$qryStrCat = "SELECT descricao FROM categorias WHERE id_categoria = '".$row["id_categoria"]."'";
					$qryCat = sql_executa($qryStrCat);
					$rowCat = sql_fetch_array($qryCat); 
				?>
	  			<td width="10%" align="center"><?php echo $rowCat['descricao']; ?></td>
	  			<td width="15%" align="center"><?php echo $row['numero_projeto']; ?></td>
	  			<?php
					$dataInicio = new DateTime($row["vigencia_inicio"]);
					$dataFim = new DateTime($row["vigencia_fim"]);
					$dataInicio = $dataInicio->format('d/m/Y');
					$dataFim = $dataFim->format('d/m/Y'); 
				?>
	  			<td width="15%" align="center"><?php echo $dataInicio; ?> - <?php echo $dataFim; ?></td>
	  			<td width="10%" align="center"><?php echo number_format($row['remuneracao'], 0, ',', '.'); ?></td>
	  			<?php 
					$qryStrStatus = "SELECT descricao FROM status_estagiario WHERE id_status = '".$row["id_status"]."'";
					$qryStatus = sql_executa($qryStrStatus);
					$rowStatus = sql_fetch_array($qryStatus); 
					$printStatus = $rowStatus['descricao'];
					if($row['id_status'] != 8 && $row['id_status'] != 9) {
						$flagLink = 0;
						switch ($row['id_status']) {
  							case 1:
  								if($_SESSION['USERNIVEL'] == 'g' || $_SESSION['USERNIVEL'] == 'a') {
									$flagLink = 1;
  								}
    							break;
  							case 2:
  								if($_SESSION['USERNIVEL'] == 'f' || $_SESSION['USERNIVEL'] == 'a') {
									$flagLink = 1;
  								}
    							break;
  							case 3:
  								if($_SESSION['USERNIVEL'] == 'd' || $_SESSION['USERNIVEL'] == 'a') {
									$flagLink = 1;
  								}
  								break;
  							case 4:
  								if($_SESSION['USERNIVEL'] == 'p' || $_SESSION['USERNIVEL'] == 'a') {
									$flagLink = 1;
  								}
  								break;
  							case 5:
    							if($_SESSION['USERNIVEL'] == 't' || $_SESSION['USERNIVEL'] == 'a') {
									$flagLink = 1;
  								}
    							break;
  							default:
    							$flagLink = 0;
    							break;
						}
						if($flagLink) {
							$printStatus = "<a href='./acompanhamento.analise.php?tipo=".$row['id_status']."&estagiario=".$row['id']."&contrato=".$row['numero_contrato']."'>".$rowStatus['descricao']."</a>";
						}
					}
				?>
	  			<td width="10%" align="center"><?php echo $printStatus; ?></td>
			</tr>
		<?php } ?>
		</table>
		<?php
		$qryStr = "SELECT es.nome FROM estagiarios AS es INNER JOIN contratos AS ct ON es.id = ct.id_estagiario ";
		$qry = sql_executa($qryStr);
		$qtdAlunos = sql_num_rows($qry);
		echo "<table width=\"500\" border=\"0\" cellpadding=\"5\" cellspacing=\"5\" class=\"listaEstagiarios\">
<tr><td align=\"left\" style=\"padding-left:20px;\">";
		if($pagina-1>0) {
			echo "<a href=\"javascript://\" onclick=\"ajax.loadDiv('divManip','acompanhamento.lista.php?pagina=".($pagina-1)."');\"><img border=\"0\" align=\"middle\" src=\"../img/anterior.gif\" width=\"28\" height=\"40\" />Anterior</a>";
		}
		
		echo "</td>
<td align=\"right\" style=\"padding-right:20px;\">";
		if($qtdAlunos > ($pagina * $offset)) {
			echo "<a href=\"javascript://\" onclick=\"ajax.loadDiv('divManip','acompanhamento.lista.php?pagina=".($pagina+1)."');\">Proxima<img align=\"middle\" src=\"../img/proximo.gif\" width=\"28\" height=\"40\" border=\"0\"/></a>";
		}	
		
		echo "</td>
</tr>
</table>	";
	} else {
		//Nenhum estagiario
		echo "<table width='700px' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
				<tr bgcolor='#F5FAFA'>
					<td align='center'><span align='center' style='color:black;'>Você não possui alunos cadastrados.</span></td>
				</tr>
			</table>";
	}
} else {
	//Erro ao fazer consulta ao BDD
	echo "<table width='700px' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
				<tr bgcolor='#F5FAFA'>
					<td align='center'><span align='center' style='color:black;'>Ocorreu um erro ao tentar acessar a base de dados.</span></td>
				</tr>
			</table>";
}	
?>
