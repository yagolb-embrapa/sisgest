<?php
	$qtd_abas = 0;
	require_once("../functions/functions.database.php");//temporario 
	require_once("../functions/functions.forms.php");
	require_once("../sessions.php");
	session_start();
	$cor = true;
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
$qryStr = "SELECT es.id, es.nome, ct.id_categoria, ct.id_status, ct.vigencia_inicio, ct.vigencia_fim, ct.id_supervisor, ct.numero_projeto, ct.remuneracao, ct.numero_contrato
			FROM estagiarios AS es INNER JOIN contratos AS ct ON es.id = ct.id_estagiario
			WHERE es.id = ".$_SESSION['estagiario_temp']." AND ct.numero_contrato = ".$_SESSION['contrato_temp']."";
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
	  				$idcategoria = $row['id_categoria'];
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
			</tr>
		<?php 
		} 
		switch ($_SESSION['tipo_temp']) {
  			case 1:
  				if($idcategoria == 3) {
					$mensagemDef = "Deferir! Enviar para o SOF.";
    				$mensagemIndef = "Pendêcia! Retornar para o Supervisor.";
    				$_SESSION['is_estagiario_temp'] = 1;
  				} else {
					$mensagemDef = "Aprovar!";
    				$mensagemIndef = "Pendência! Retornar para o Supervisor.";
    				$_SESSION['is_estagiario_temp'] = 0;
  				}
    			break;
  			case 2:
    			$mensagemDef = "Deferir! Enviar para a Chefia";
    			$mensagemIndef = "Pendência! Retornar para o SGP e Supervisor";
    			break;
  			case 3:
  			case 4:
  			case 5:
    			$mensagemDef = "Aprovar!";
    			$mensagemIndef = "Reprovar!";
    			break;
  			default:
    			$mensagem = "";
    			break;
		}

		?>
		</table>
		<br />
		<br />
		<span class="titulo">Qual a resposta da análise?</span>
		<form id="frmAnalise" name="frmAnalise" method="post" action="acompanhamento.analise.incluir.php">
			<table width="50%" class=''>
				<tr><td colspan='2'><div align="center" style="margin: 0 0 10px 0; padding: 2px 2px 2px 2px;"></div></td></tr>	
				<tr class=''>
        			<td width="25%" align="right"><span><input type="radio" name="respAnalise" value="1" checked="checked"></span></td>
        			<td width="75%"><?php echo $mensagemDef; ?></td>        
      			</tr>
      			<tr class=''>
        			<td width="25%" align="right"><span><input type="radio" name="respAnalise" value="0"></span></td>
        			<td width="75%"><?php echo $mensagemIndef; ?></td>        
      			</tr>
			</table>
			<br />
			<input type="submit" name="submit" value="Enviar"/>    
		</form>
		<?php
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
