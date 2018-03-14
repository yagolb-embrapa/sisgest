<?php 

$qtd_abas = 1;
require_once("../inc/header.php");
require_once("../classes/DB.php");

include("../functions/functions.database.php");//temporario 
include("../functions/functions.forms.php");


?>

<!-- TR de CONTEUDO -->  
<tr>
  <td width='750px' height="300" align="center" valign=top style="padding:20px 10px 0 10px;">
	<!-- DIV DE ESPAÇAMENTO -->  
   <div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>  
		
	<div align='left' class='divTitulo'>
		<span class='titulo'>.: Edição de dados da Embrapa</span>
		<div align="center" style="width:700px;margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>
		
		<?php

$id_dado = $_GET['id_dado'];
$qryStr = "SELECT * FROM dados_embrapa WHERE id = '".$id_dado."'";
$qry = sql_executa($qryStr);
$result = sql_fetch_array($qry);
$nome = $result['nome'];
$dado1 = $result['dado1'];
$dado2 = $result['dado2'];
$dado3 = $result['dado3'];
			
//Se clicou
$submit = $_POST['submit'];
unset($string_erros);
if($submit){
	extract($_POST);// 1 - Pega tb todos os valores do formulario	
	
	//colocar aqui os campos que podem ser vazios no formulario
	$excecoes_vazio = array();	
		
	//Verificar campos vazios
	while($vaz = each($_POST)){
		//coloca os campos obrigatorios que estao vazios no vetor		
		if(empty($vaz['value']) && !in_array($vaz['key'],$excecoes_vazio)){						
			$erros[] = $vaz['key'];			
		}
	}

	// 3 - Mostra mensagem de erro ou cria query de insercao 
	if(count($erros)>0){
		//essa string é usada pelo javascript no final da pagina para marcar os campos com o asterisco vermelho 
		$string_erros = implode("|",$erros);			
		//mostra mensagem de erro
		if(count($erros)==1)
			if($erros[0] == "setor" && !empty($email0))
				$msg_erro = "Erro inesperado.";
			else				
				$msg_erro = "Um campo não foi preenchido corretamente e foi marcado com um asterisco vermelho. Por favor, verifique-o e tente novamente.";
		else
            $msg_erro = "Alguns campos não foram preenchidos corretamente e foram marcados com um asterisco vermelho. Por favor, verifique-os e tente novamente.";
								
		echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
				<tr bgcolor='#FFEFEF'>
					<td align='center'><span align='center' style='color:red;'>{$msg_erro}</span></td>
				</tr>
			</table>		
			<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
		
		
    //Coloca um sinal vermelho ao lado dos campos não-preenchidos ou preenchidos de forma incorreta
	}else{	
        $qryStr = "UPDATE dados_embrapa SET dado1 = '".$dado1."', dado2 = '".$dado2."'";
        if($id_dado == 1) {
            $qryStr .= ", dado3 = '".$dado3."'";
        }
        $qryStr .= " WHERE id = '".$id_dado."'";
        $qry = sql_executa($qryStr);

		//mensagem de sucesso		
		if($qry){
			echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>						
				<tr bgcolor='#EFFFF4'>
					<td align='center'><span align='center' style='color:#296F3E;'>".$nome." editado com sucesso!</span></td>
				</tr>
			</table>		
			<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
						
		} else {
            echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>                     
                <tr bgcolor='#EFFFF4'>
                    <td align='center'><span align='center' style='color:#296F3E;'>Não foi possível editar os dados. Tente novamente!</span></td>
                </tr>
            </table>        
            <div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
        }
	}
}else{
	if($id_setor){
		//Recuperando emails do setor
		$q_recupera = "SELECT * FROM emails WHERE id_setor = {$id_setor}";
		$emails = DB::fetch_all($q_recupera);

        $qtdeEmails = sizeof($emails);
		
		if($qtdeEmails < 1)
			echo "Email não encontrado";		
	}
}
?>
   <!-- Abas -->	
	<ul class='listaAbas'>
       <li><a href="" id='a1' class='active'>Dados</a></li>              
   </ul>
   </div>
   
	<form id="frmUsr" name="frmUsr" method="post">
	
	<!-- ============ Conteudo da Primeira ABA ============ --> 	
	<div id="aba1" class='conteudoAba' style='display:block;'>
		<div id="erro"></div>  	 	
  	  	<table width="100%" class='formulario'>
  	  	<tr><td colspan='2'><div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div></td></tr>  
        <tr class='specalt'>
            <td width="33%"><span>Tipo</span></td>
            <td width="67%"><span><?php echo $nome; ?></span></td>        
        </tr> 	  		  
        <?php
        switch ($id_dado) {
        	case 1:
        		?>
        		<tr class='specalt'>
                	<td width='25%'><span>Nome</span></td>
                    <td width='75%'>
                    	<input name='dado1' id='dado1' type='text' size='40' maxlength='50' <?php echo "value='".$dado1."'"; ?>>
                    		<span id='sdado1' class='sErro'>&nbsp;*</span>
                    </td>
                </tr>
                <tr class='specalt'>
                	<td width='25%'><span>CPF</span></td>
                    <td width='75%'>
                    	<input name='dado2' id='dado2' type='text' size='20' maxlength='14' onKeyPress="mascara(this, mcpf);" <?php echo "value='".$dado2."'"; ?>>
                    		<span id='sdado2' class='sErro'>&nbsp;*</span>
                    </td>
                </tr>
                <tr class='specalt'>
                	<td width='25%'><span>RG</span></td>
                    <td width='75%'>
                    	<input name='dado3' id='dado3' type='text' size='20' maxlength='50' <?php echo "value='".$dado3."'"; ?>>
                    		<span id='sdado3' class='sErro'>&nbsp;*</span>
                    </td>
                </tr>
        		<?php
        		break;
        	case 2:
        		?>
        		<tr class='specalt'>
                	<td width='25%'><span>Nome</span></td>
                    <td width='75%'>
                    	<input name='dado1' id='dado1' type='text' size='40' maxlength='50' <?php echo "value='".$dado1."'"; ?>>
                    		<span id='sdado1' class='sErro'>&nbsp;*</span>
                    </td>
                </tr>
                <tr class='specalt'>
                	<td width='25%'><span>CPF</span></td>
                    <td width='75%'>
                    	<input name='dado2' id='dado2' type='text' size='20' maxlength='14' onKeyPress="mascara(this, mcpf);" <?php echo "value='".$dado2."'"; ?>>
                    		<span id='sdado2' class='sErro'>&nbsp;*</span>
                    </td>
                </tr>
        		<?php
        		break;
        	case 3:
        		?>
        		<tr class='specalt'>
                	<td width='25%'><span>Nome</span></td>
                    <td width='75%'>
                    	<input name='dado1' id='dado1' type='text' size='40' maxlength='50' <?php echo "value='".$dado1."'"; ?>>
                    		<span id='sdado1' class='sErro'>&nbsp;*</span>
                    </td>
                </tr>
                <tr class='specalt'>
                	<td width='25%'><span>Apólice nº</span></td>
                    <td width='75%'>
                    	<input name='dado2' id='dado2' type='text' size='20' maxlength='50' <?php echo "value='".$dado2."'"; ?>>
                    		<span id='sdado2' class='sErro'>&nbsp;*</span>
                    </td>
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
  <table>
   <tr align='center'><td colspan='2' >
    <input type="submit" name="submit" value="Salvar"/>    
   </td></tr>
  </table> 
  </td></tr>
  </table>
  </div> 
 </div>

	
 </div>	
</form>  
</div>
  </td>
</tr>
</table>
<script language="javascript">
	mostraErros('<?php echo $string_erros; ?>');	
</script>
<?php 
include_once('../inc/copyright.php');
?>
</div>
