<?php 

$qtd_abas = 1;
require_once("../inc/header.php");

include("../functions/functions.database.php");//temporario 
include("../functions/functions.forms.php");


?>

<!-- TR de CONTEUDO -->  
<tr>
  <td width='750px' height="300" align="center" valign=top style="padding:20px 10px 0 10px;">
	<!-- DIV DE ESPAÇAMENTO -->  
   <div align="center" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>  
		
	<div align='left' class='divTitulo'>
		<span class='titulo'>.: Inclusão de Supervisor</span>
		<div align="center" style="width:700px;margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>
		
		<?php

if(isset($_SESSION['dados_temp'])){
	if($_SESSION['dados_temp'] == 1) {
		$cpf = $_SESSION['cpf_superv_temp'];
		$nome = $_SESSION['nome_superv_temp'];
		$login = $_SESSION['login_superv_temp'];
		$nivel = $_SESSION['nivel_superv_temp'];
	}
}
	
//Se clicou
$submit = $_POST['submit'];
unset($string_erros);
if($submit){
	extract($_POST);// 1 - Pega tb todos os valores do formulario
	$municipio = $_POST['municipio'];//pega manualmente pq como esta em outra pagina, nao ta pegando com a linha acima
	
	//colocar aqui os campos que podem ser vazios no formulario
	$excecoes_vazio = array("formacao","cargo");	
		
	//Verificar campos vazios
	while($vaz = each($_POST)){
		//coloca os campos obrigatorios que estao vazios no vetor		
		if(empty($vaz['value']) && !in_array($vaz['key'],$excecoes_vazio)){						
			$erros[] = $vaz['key'];			
		}														
	}

	$q_repetido = "SELECT * FROM supervisores WHERE cpf = '{$cpf}';";
	$r_repetido = sql_executa($q_repetido);
	if(sql_num_rows($r_repetido)>0) $erros[] = "cpf";	
				
	// 3 - Mostra mensagem de erro ou cria query de insercao 
	if(count($erros)>0){
		//essa string é usada pelo javascript no final da pagina para marcar os campos com o asterisco vermelho 
		$string_erros = implode("|",$erros);			
		//mostra mensagem de erro
		if(count($erros)==1)
			if($erros[0] == "cpf" && !empty($cpf))
				$msg_erro = "O supervisor já está cadastrado no sistema.";
			else				
				$msg_erro = "Um campo não foi preenchido corretamente e foi marcado com um asterisco vermelho. Por favor, verifique-o e tente novamente.";
		else
			if(in_array("codigo",$erros) && !empty($codigo))
				$msg_erro = "O supervisor já está cadastrado no sistema.<br>Alguns campos não foram preenchidos corretamente e foram marcados com um asterisco vermelho. Por favor, verifique-os e tente novamente.";
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
		/*$reg = Register::create('estagiarios');
		$reg->nome = $nome;		
		$reg->id = $codigo;
		$reg->cargo = $cargo;
		$reg->formacao = $formacao;		
		$reg->save();*/
		
		$query = "INSERT INTO supervisores (nome,formacao,cargo,cpf)VALUES('{$nome}','{$formacao}','{$cargo}','{$cpf}');";		
		$result = sql_executa($query);

		if($result) {
			if(isset($_SESSION['dados_temp'])) {
				if($_SESSION['dados_temp'] == 1) {
					$query2 = "SELECT * FROM supervisores WHERE cpf = '{$cpf}'";
					$result2 = sql_executa($query2);
					if(sql_num_rows($result2) == 1) { 
						$row = sql_fetch_array($result2);
						$query3 = "INSERT INTO users (nome, login, nivel, id_supervisor) VALUES('$nome', '$login', '$nivel', {$row['id']});";
						$result3 = sql_executa($query3);
						if($result3) {
							echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>		
								<tr bgcolor='#EFFFF4'>
									<td align='center'><span align='center' style='color:#296F3E;'>Funcionário incluído com sucesso como supervisor e usuário!</span></td>
								</tr>
							</table>		
							<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
			
							$_SESSION['dados_temp'] = 0;
							unset($_POST, $nome, $login, $nivel, $cpf, $formacao, $cargo, $_SESSION['dados_temp'], $_SESSION['nome_superv_temp'], $_SESSION['cpf_superv_temp'], $_SESSION['login_superv_temp'], $_SESSION['nivel_superv_temp']);
						}
					}
				} else {
					echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>				
						<tr bgcolor='#EFFFF4'>
							<td align='center'><span align='center' style='color:#296F3E;'>Supervisor incluído com sucesso!</span></td>
						</tr>
					</table>		
					<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
			
					unset($_POST);
					unset($nome, $cpf, $formacao, $cargo);
				}
			} else {
				echo "<table width='100%' style='border:1px solid black;' bgcolor='' cellspacing='0' cellpadding='5' height='50px'>				
					<tr bgcolor='#EFFFF4'>
						<td align='center'><span align='center' style='color:#296F3E;'>Supervisor incluído com sucesso!</span></td>
					</tr>
				</table>		
				<div align='center' style='margin: 0 0 25px 0; padding: 2px 2px 2px 2px;'></div>";
			
				unset($_POST);
				unset($nome, $cpf, $formacao, $cargo);
			}
		}
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
        <td width="25%"><span>Nome (*)</span></td>
        <td width="75%"><input name="nome" id="nome" type="text" size='40' maxlength='50' value="<?php echo $nome; ?>"><span id='snome' class="sErro">&nbsp;*</span></td>        
      </tr>
      <tr class='specalt'>
        <td ><span>CPF (*)</span></td>
        <td><input name="cpf" id="cpf" type="text" size="15" maxlength="14" onKeyPress="mascara(this, mcpf);" value="<?php echo $cpf; ?>"><span id='scpf' class="sErro">&nbsp;*</span></td>
       </tr>
		<tr class='specalt'>
        <td ><span>Formação</span></td>
        <td><input name="formacao" id="formacao" type="text" size="40" maxlength="50" value="<?php echo $formacao; ?>"><span id='sformacao' class="sErro">&nbsp;*</span></td>
       </tr>      
       <tr class='specalt'>
        <td ><span>Cargo</span></td>
        <td><input name="cargo" id="cargo" type="text" size='40' maxlength="50" value="<?php echo $cargo; ?>"><span id='scargo' class="sErro">&nbsp;*</span></td>
       </tr>
       <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
       </table>
       </div>  
            
    </table> 
  <tabela width="800px" bgcolor="#FFFFFF"><tr align='center'><td>
  <table class="tabelaBotao">
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
