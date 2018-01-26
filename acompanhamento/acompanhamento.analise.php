<?php 	
$qtd_abas = 0;
require_once("../inc/header.php");
include("../functions/functions.database.php");//temporario 
include("../functions/functions.forms.php");
session_start();
$_SESSION['tipo_temp'] = $_GET['tipo'];
$_SESSION['estagiario_temp'] = $_GET['estagiario'];
$_SESSION['contrato_temp'] = $_GET['contrato'];
switch ($_SESSION['tipo_temp']) {
  case 1:
    $mensagem = "do SGP";
    break;
  case 2:
    $mensagem = "SOF";
    break;
  case 3:
    $mensagem = "da Chefia de Administração";
    break;
  case 4:
    $mensagem = "da Chefia de Pesquisa e Desenvolvimento";
    break;
  case 5:
    $mensagem = "da Chefia de Transferência de Tecnologia";
    break;
  default:
    $mensagem = "";
    break;
}
?>  
<tr>
  <td width=752 height="300" align="center" valign=top style="padding:20px 10px 0 10px;">
  <div align="center" style="width:700px;margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>
  <div align='left' class='divTitulo'>
		<span class='titulo'>.: Análise <?php echo $mensagem; ?></span>
		<div align="center" style="width:700px;margin: 0 0 25px 0; padding: 2px 2px 2px 2px;"></div>
	</div>
  <div align="center" id="divManip" style="margin: 0 0 25px 0; padding: 2px 2px 2px 2px;">
  </div>
  <div align="center" id="divListUsr">
  </div>
  </td>
</tr>
<tr><td>
<?php include("../inc/copyright.php"); ?>
</td></tr>
</table>

</div>
<script language="javascript">
	var ajax = new TAjax();
	ajax.loadDiv('divManip','acompanhamento.analise.resposta.php');
</script>
</body>
</html>

