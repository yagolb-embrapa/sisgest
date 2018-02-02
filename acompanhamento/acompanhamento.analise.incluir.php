<?php
	include("../functions/functions.database.php");
	require_once("../sessions.php");
	$is_estagiario = $_SESSION['is_estagiario_temp'];
	$tipo_analise = $_SESSION['tipo_temp'];
	$id_estagiario = $_SESSION['estagiario_temp'];
	$n_contrato = $_SESSION['contrato_temp'];
	$resposta = $_POST['respAnalise'];
	$nivel_user = $_SESSION['USERNIVEL'];
	$erro = 0;
	$novo_status = 0;
	$n_email = 0;
	switch ($tipo_analise) {
		// Analise SGP
		case '1':
			if($nivel_user == 'g' || $nivel_user == 'a') {
				if($resposta) {
					if($is_estagiario) {
						$novo_status = 2;
						$n_email = 2;
					} else {
						$novo_status = 8;
						$n_email = 8;
					}
				} else {
					$novo_status = 6;
					$n_email = 7;
				}
			} else {
				$erro = 1;
			}
			break;
		// Analise SOF
		case '2':
			if($nivel_user == 'f' || $nivel_user == 'a') {
				if($resposta) {
					$query = "SELECT id_chefia_associada FROM contratos 
					WHERE id_estagiario = '".$id_estagiario."' AND numero_contrato = '".$n_contrato."'";
					$result = sql_executa($query);
					$row = sql_fetch_array($result);
					$novo_status = $row['id_chefia_associada'];
					$n_email = 	4;
				} else {
					$novo_status = 7;
					$n_email = 3;
				}
			} else {
				$erro = 1;
			}
			break;
		// Analise CHADM
		case '3':
			if($nivel_user == 'd' || $nivel_user == 'a') {
				if($resposta) {
					$novo_status = 8;
					$n_email = 5;
				} else {
					$novo_status = 9;
					$n_email = 6;
				}
			} else {
				$erro = 1;
			}
			break;
		// Analise CHPD
		case '4':
			if($nivel_user == 'p' || $nivel_user == 'a') {
				if($resposta) {
					$novo_status = 8;
					$n_email = 5;
				} else {
					$novo_status = 9;
					$n_email = 6;
				}
			} else {
				$erro = 1;
			}
			break;
		// Analise CHTT
		case '5':
			if($nivel_user == 't' || $nivel_user == 'a') {
				if($resposta) {
					$novo_status = 8;
					$n_email = 5;
				} else {
					$novo_status = 9;
					$n_email = 6;
				}
			} else {
				$erro = 1;
			}
			break;
		default:
			break;
	}

	$query = "UPDATE contratos SET id_status = '".$novo_status."' 
	WHERE id_estagiario = '".$id_estagiario."' AND numero_contrato = '".$n_contrato."'";
	$result = sql_executa($query);
	if($result) {
		$query = "SELECT id FROM setores WHERE setor = 'SGP'";
		$result = sql_executa($query);
		$row = sql_fetch_array($result);
		$id_email_sgp = $row['id'];

		$query = "SELECT email FROM emails WHERE id_setor = '".$id_email_sgp."'";
		$result = sql_executa($query);
		$row = sql_fetch_array($result);
		$email_sgp = $row['email'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
  		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  		$headers .= 'From: Sisgest <'.$email_sgp.'>'."\r\n";

		$query = "SELECT numero_projeto, id_supervisor FROM contratos
		WHERE id_estagiario = '".$id_estagiario."' AND numero_contrato = '".$n_contrato."'";
		$result = sql_executa($query);
		$row = sql_fetch_array($result);
		$cod_projeto = $row['numero_projeto'];
		$id_supervisor = $row['id_supervisor'];

		$query = "SELECT nome, email FROM supervisores WHERE id = '".$id_supervisor."'";
		$result = sql_executa($query);
		$row = sql_fetch_array($result);
		$nome_supervisor = $row['nome'];
		$email_supervisor = $row['email'];

		$query = "SELECT nome FROM estagiarios WHERE id = '".$id_estagiario."'";
		$result = sql_executa($query);
		$row = sql_fetch_array($result);
		$nome_estagiario = $row['nome'];

		$query = "SELECT assunto, corpo FROM emails_corpo WHERE numero = '".$n_email."'";
		$result = sql_executa($query);
		$row = sql_fetch_array($result);
		$assunto = $row['assunto'];
		$assunto = '=?UTF-8?B?'.base64_encode($assunto).'?=';

		switch ($n_email) {
			case 2:
				$corpo = sprintf($row['corpo'], $nome_supervisor, $cod_projeto);

				$query = "SELECT id FROM setores WHERE setor = 'SOF'";
				$result = sql_executa($query);
				$rowSof = sql_fetch_array($result);
				$id_email_sof = $rowSof['id'];

				$query = "SELECT email FROM emails WHERE id_setor = '".$id_email_sof."'";
				$result = sql_executa($query);
				$rowSof2 = sql_fetch_array($result);
				$email_sof = $rowSof2['email'];
				$to = $email_sof;
				$to = "stan.oliveira@gmail.com";
				break;
			case 3:
				$corpo = sprintf($row['corpo'], $nome_supervisor, $cod_projeto, $nome_estagiario);
				$to = $email_supervisor;
				break;
			case 4:
				$corpo = sprintf($row['corpo'], $nome_supervisor, $cod_projeto);

				$query = "SELECT id_chefia_associada FROM contratos WHERE 
				id_estagiario = '".$id_estagiario."' AND numero_contrato = '".$n_contrato."'";
				$result = sql_executa($query);
				$rowIdChefia = sql_fetch_array($result);
				
				$query = "SELECT sigla FROM chefias WHERE id_chefia = '".$rowIdChegia['id_chefia_associada']."'";
				$result = sql_executa($query);
				$rowNomeChefia = sql_fetch_array($result);
				$nome_chefia = $rowNomeChefia['sigla'];

				$query = "SELECT id FROM setores WHERE setor = '".$nome_chefia."'";
				$result = sql_executa($query);
				$rowChefia = sql_fetch_array($result);
				$id_email_chefia = $rowChefia['id'];

				$query = "SELECT email FROM emails WHERE id_setor = '".$id_email_chefia."'";
				$result = sql_executa($query);
				$rowCh = sql_fetch_array($result);
				$email_chefia = $rowCh['email'];
				$to = $email_chefia;
				$to = "stan.oliveira@gmail.com";
				break;
			case 5:
			case 6:
			case 7:
				$corpo = sprintf($row['corpo'], $nome_supervisor, $nome_estagiario, $cod_projeto);
				$to = $email_supervisor;
				break;
			case 8:
				$corpo = sprintf($row['corpo'], $nome_supervisor, $nome_estagiario);
				$to = $email_supervisor;
				break;
			default:
				break;
		}

		$corpo = str_replace("\\n","<br>",$corpo);
		if(mail($to, $assunto, $corpo, $headers)) {
			if($n_email == 6 || $n_email == 5) {
				$to = $email_sgp;
				if(mail($to, $assunto, $corpo, $headers)) {
					unset($_POST, $_SESSION['is_estagiario_temp'], $_SESSION['tipo_temp'], $_SESSION['estagiario_temp'], $_SESSION['contrato_temp']);
					echo "<script>alert('Análise respondida com sucesso!');</script>";
					echo "<script> location.replace('./acompanhamento.gerenciamento.php'); </script>";
				} else {
					unset($_POST, $_SESSION['is_estagiario_temp'], $_SESSION['tipo_temp'], $_SESSION['estagiario_temp'], $_SESSION['contrato_temp']);
					echo "<script>alert('Aconteceu um erro no envio do email.');</script>";
					echo "<script> location.replace('./acompanhamento.gerenciamento.php'); </script>";
				}
			} else {
				unset($_POST, $_SESSION['is_estagiario_temp'], $_SESSION['tipo_temp'], $_SESSION['estagiario_temp'], $_SESSION['contrato_temp']);
				echo "<script>alert('Análise respondida com sucesso!');</script>";
				echo "<script> location.replace('./acompanhamento.gerenciamento.php'); </script>";
			}
		} else {
			unset($_POST, $_SESSION['is_estagiario_temp'], $_SESSION['tipo_temp'], $_SESSION['estagiario_temp'], $_SESSION['contrato_temp']);
			echo "<script>alert('Aconteceu um erro no envio do email.');</script>";
			echo "<script> location.replace('./acompanhamento.gerenciamento.php'); </script>";
		}
		// Email $n_email
	} else {
		$erro = 1;
	}
?>
