<?php 
    require_once("./classes/DB.php");

    include("./functions/functions.database.php");//temporario 

    $query = "SELECT id FROM setores WHERE setor = 'SGP'";
    $result = sql_executa($query);
    $row = sql_fetch_array($result);
    $id_email_sgp = $row['id'];

    $query = "SELECT email FROM emails WHERE id_setor = '".$id_email_sgp."'";
    $result = sql_executa($query);
    $row = sql_fetch_array($result);
    $email_sgp = $row['email'];

    $headers2  = 'MIME-Version: 1.0' . "\r\n";
    $headers2 .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers2 .= 'From: Sisgest <'.$email_sgp.'>'."\r\n";

    $query = "SELECT assunto, corpo FROM emails_corpo WHERE numero = '1'";
    $result = sql_executa($query);
    $row = sql_fetch_array($result);
    $assunto = $row['assunto'];
    $corpoAntes = $row['corpo'];

    $query = "SELECT nome, email FROM supervisores WHERE id = '11'";
    $result = sql_executa($query);
    $row = sql_fetch_array($result);
    $nome_supervisor = $row['nome'];
    $email_supervisor = $row['email'];

    $corpo = sprintf($corpoAntes, $nome_supervisor);
    $corpo = str_replace("\\n","<br>",$corpo);
    
    $to = $email_supervisor;

    $assunto = '=?UTF-8?B?'.base64_encode($assunto).'?=';

	if(mail($to, $assunto, $corpo, $headers2)) {
		echo "enviado";
	} else{
		echo "nao enviado";
	}
?>