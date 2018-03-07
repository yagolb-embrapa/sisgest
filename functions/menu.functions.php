<?php 

/*
	Essa pagina carrega duas funcoes de menu: uma para inclusao nas paginas que estao na raiz do sistema e 
outra para as que nao estao.
	A diferenca principal, repare, é a linkagem para as diversas paginas
	
*/


// exibe menu principal do sistema
function show_menu ( $id,  $permissoes, $funcao )
{	  	
	echo "<div id=\"staticMenu\">
	<table border='0'  width='680px' align='center' class='menu'>
	<tr>";	
	
	if($_SESSION['USERNIVEL'] == 'a' || $_SESSION['USERNIVEL'] == 'g') {
		//Estagiários	
		echo "
		<td align='left' width='1%' >
			<ul id='nav'> 
				<li ><span>&nbsp;Estágio</span>		
					<ul>";
						echo "<li><span onclick=\"top.location.href='../estagiario/estagiario.gerenciamento.php';\">
							Meus estagiários/bolsistas</span></li>";
						echo "<li><span onclick=\"top.location.href='../estagiario/estagiario.inclusao.php';\">
							Solicitação</span></li>";																						
						echo "
					</ul>
				</li> 
			</ul>
		</td>";		

    	//Acompanhamento		
		echo "
		<td align='left' width='13%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='../acompanhamento/acompanhamento.gerenciamento.php';\">
					Acompanhamento</span>
				</li> 
			</ul>
		</td>";

		//Relatórios	
			echo "
			<td align='left' width='7%' >		
				<ul id='nav3'> 
					<li ><span onclick=\"top.location.href='../relatorio/relatorios.lista.php';\">
						Relatórios</span>
					</li> 
				</ul>
			</td>";

		//Termos		
		echo "
		<td align='left' width='1%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='../termo/termo.lista.php';\">
						Termos</span>
				</li> 
			</ul>
		</td>";	  

		//Configurações		
		echo "
		<td align='left' width='11%' >		
			<ul id='nav2'> 
				<li ><span>Configurações</span>		
					<ul>";		
	                	echo "<li><span onclick=\"top.location.href='../emails/emails.gerenciamento.php';\">
    	                	Gerenciar Emails</span></li>";                
						echo "<li><span onclick=\"top.location.href='../bancos/bancos.gerenciamento.php';\">
            	            Gerenciar Bancos</span></li>";
						echo "<li><span onclick=\"top.location.href='../instituicao/instituicao.gerenciamento.php';\">
                    	    Gerenciar Instituições</span></li>";
						echo "<li><span onclick=\"top.location.href='../bolsista/bolsista.gerenciamento.php';\">
                          	Gerenciar Modalidades de Bolsa</span></li>";
						echo "<li><span onclick=\"top.location.href='../origens_recursos/origem.gerenciamento.php';\">
                           	Gerenciar Origens de Recursos</span></li>";
						echo "<li><span onclick=\"top.location.href='../supervisor/supervisor.gerenciamento.php';\">
                           	Gerenciar Supervisores</span></li>";					
						echo "<li><span onclick=\"top.location.href='../usuario/usuario.gerenciamento.php';\">
							Gerenciar Usuários</span></li>";
						echo"
					</ul>
				</li> 
			</ul>
		</td>";		

		//Contas		
		echo "
		<td align='left' width='1%' >		
			<ul id='nav2'> 
				<li ><span>Contas</span>		
					<ul>";					
						echo "<li><span onclick=\"top.location.href='../conta/conta.abertura.php';\">
							Abertura de Contas</span></li>";					
						echo "<li><span onclick=\"top.location.href='../conta/conta.finalizacao.php';\">
							Finalização de Contas</span></li>";	
					echo"
					</ul>
				</li> 
			</ul>
		</td>";

		//Ajuda	
		echo "
		<td align='left' width='1%' >		
			<ul id='nav2'> 
				<li ><span>Ajuda</span>		
					<ul>";										
						echo "<li><a target='_blank' href='../ajuda/ajuda.tutorial.pdf'>
							Tutorial</a></li>";	
						echo"
					</ul>
				</li> 
			</ul>
		</td>";
    
		//Sair	
		echo "<td align='center' width='1%'><ul><li>
			<span onclick=\"top.location.href='../logout.php';\">Sair</span></td>
		</li></ul>";
	} else if($_SESSION['USERNIVEL'] == 'u') {
		//Estagiários	
		echo "
		<td align='left' width='1%' >
			<ul id='nav'> 
				<li ><span>&nbsp;Estágio</span>		
					<ul>";
						echo "<li><span onclick=\"top.location.href='../estagiario/estagiario.gerenciamento.php';\">
							Meus estagiários/bolsistas</span></li>";
						echo "<li><span onclick=\"top.location.href='../estagiario/estagiario.inclusao.php';\">
							Solicitação</span></li>";																						
						echo "
					</ul>
				</li> 
			</ul>
		</td>";	

		//Ajuda	
		echo "
		<td align='left' width='1%' >		
			<ul id='nav2'> 
				<li ><span>Ajuda</span>		
					<ul>";										
						echo "<li><a target='_blank' href='../ajuda/ajuda.tutorial.pdf'>
							Tutorial</a></li>";	
						echo"
					</ul>
				</li> 
			</ul>
		</td>";
    
		//Sair	
		echo "<td align='center' width='1%'><ul><li>
			<span onclick=\"top.location.href='../logout.php';\">Sair</span></td>
		</li></ul>";
	} else {
		//Estagiários	
		echo "
		<td align='left' width='15%' >
			<ul id='nav'> 
				<li ><span>&nbsp;Estágio</span>		
					<ul>";
						echo "<li><span onclick=\"top.location.href='../estagiario/estagiario.gerenciamento.php';\">
							Meus estagiários/bolsistas</span></li>";
						echo "<li><span onclick=\"top.location.href='../estagiario/estagiario.inclusao.php';\">
							Solicitação</span></li>";																						
						echo "
					</ul>
				</li> 
			</ul>
		</td>";	

		//Acompanhamento		
		echo "
		<td align='left' width='25%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='../acompanhamento/acompanhamento.gerenciamento.php';\">
					Acompanhamento</span>
				</li> 
			</ul>
		</td>";

		//Ajuda	
		echo "
		<td align='left' width='15%' >		
			<ul id='nav2'> 
				<li ><span>Ajuda</span>		
					<ul>";										
						echo "<li><a target='_blank' href='../ajuda/ajuda.tutorial.pdf'>
							Tutorial</a></li>";	
						echo"
					</ul>
				</li> 
			</ul>
		</td>";
    
		//Sair	
		echo "<td align='center' width='15%'><ul><li>
			<span onclick=\"top.location.href='../logout.php';\">Sair</span></td>
		</li></ul>";
	}

	echo "</tr>
	</table></div><br>";
}


// exibe menu principal do sistema para paginas na raiz
function show_menu_root ( $id,  $permissoes, $funcao )
{	  	
	echo "<div id=\"staticMenu\">
	<table border='0'  width='680px' align='center' class='menu'>
	<tr>";	
	
	if($_SESSION['USERNIVEL'] == 'a' || $_SESSION['USERNIVEL'] == 'g') {
		//Estagiários	
		echo "
		<td align='left' width='1%' >
			<ul id='nav'> 
				<li ><span>Estágio</span>		
					<ul>";
						echo "<li><span onclick=\"top.location.href='estagiario/estagiario.gerenciamento.php';\">
							Meus estagiários/bolsistas</span></li>";
						echo "<li><span onclick=\"top.location.href='estagiario/estagiario.inclusao.php';\">
							Solicitação</span></li>";																				
						echo "
					</ul>
				</li> 
			</ul>
		</td>";	

    	//Acompanhamento
    	echo "
		<td align='left' width='13%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='acompanhamento/acompanhamento.gerenciamento.php';\">
						Acompanhamento</span>
				</li> 
			</ul>
		</td>";
	
		//Relatórios
    	echo "
		<td align='left' width='7%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='relatorio/relatorios.lista.php';\">
					Relatórios</span>
				</li>  
			</ul>
		</td>";	

		//Termos
		echo "
		<td align='left' width='1%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='termo/termo.lista.php';\">
						Termos</span>
				</li> 
			</ul>
		</td>";	

		//Configurações	
		echo "
		<td align='left' width='11%' >		
			<ul id='nav2'> 
				<li ><span>Configurações</span>		
					<ul>";								
						echo "<li><span onclick=\"top.location.href='emails/emails.gerenciamento.php';\">
                            Gerenciar Emails</span></li>";
						echo "<li><span onclick=\"top.location.href='bancos/bancos.gerenciamento.php';\">
                            Gerenciar Bancos</span></li>";
						echo "<li><span onclick=\"top.location.href='instituicao/instituicao.gerenciamento.php';\">
                            Gerenciar Instituições</span></li>";
					    echo "<li><span onclick=\"top.location.href='bolsista/bolsista.gerenciamento.php';\">
						    Gerenciar Modalidades de Bolsa</span></li>";
						echo "<li><span onclick=\"top.location.href='origens_recursos/origem.gerenciamento.php';\">
                            Gerenciar Origens de Recursos</span></li>";
						echo "<li><span onclick=\"top.location.href='supervisor/supervisor.gerenciamento.php';\">
                            Gerenciar Supervisores</span></li>";
						echo "<li><span onclick=\"top.location.href='usuario/usuario.gerenciamento.php';\">
							Gerenciar Usuários</span></li>";
					echo"
					</ul>
				</li> 
			</ul>
		</td>";			

		//Contas	
		echo "
		<td align='left' width='1%' >		
			<ul id='nav2'> 
				<li ><span>Contas</span>		
					<ul>";								
						echo "<li><span onclick=\"top.location.href='conta/conta.abertura.php';\">
							Abertura de Contas</span></li>";					
						echo "<li><span onclick=\"top.location.href='conta/conta.finalizacao.php';\">
							Finalização de Contas</span></li>";	
					echo"
					</ul>
				</li> 
			</ul>
		</td>";

		//Ajuda	
		echo "
		<td align='left' width='1%' >		
			<ul id='nav2'> 
				<li ><span>Ajuda</span>		
					<ul>";										
						echo "<li><a target='_blank' href='ajuda/ajuda.tutorial.pdf'>
							Tutorial</a></li>";	
						echo"
					</ul>
				</li> 
			</ul>
		</td>";

		//Sair	
		echo "<td align='center' width='1%'><ul><li>
			<span onclick=\"top.location.href='logout.php';\">Sair</span></td>
			</li></ul>";
	} else if($_SESSION['USERNIVEL'] == 'u') {
		//Estagiários	
		echo "
		<td align='left' width='1%' >
			<ul id='nav'> 
				<li ><span>Estágio</span>		
					<ul>";
						echo "<li><span onclick=\"top.location.href='estagiario/estagiario.gerenciamento.php';\">
							Meus estagiários/bolsistas</span></li>";
						echo "<li><span onclick=\"top.location.href='estagiario/estagiario.inclusao.php';\">
							Solicitação</span></li>";																				
						echo "
					</ul>
				</li> 
			</ul>
		</td>";	

		//Ajuda	
		echo "
		<td align='left' width='1%' >		
			<ul id='nav2'> 
				<li ><span>Ajuda</span>		
					<ul>";										
						echo "<li><a target='_blank' href='ajuda/ajuda.tutorial.pdf'>
							Tutorial</a></li>";	
						echo"
					</ul>
				</li> 
			</ul>
		</td>";

		//Sair	
		echo "<td align='center' width='1%'><ul><li>
			<span onclick=\"top.location.href='logout.php';\">Sair</span></td>
			</li></ul>";
	} else {
		//Estagiários	
		echo "
		<td align='left' width='15%' >
			<ul id='nav'> 
				<li ><span>Estágio</span>		
					<ul>";
						echo "<li><span onclick=\"top.location.href='estagiario/estagiario.gerenciamento.php';\">
							Meus estagiários/bolsistas</span></li>";
						echo "<li><span onclick=\"top.location.href='estagiario/estagiario.inclusao.php';\">
							Solicitação</span></li>";																				
						echo "
					</ul>
				</li> 
			</ul>
		</td>";	

		//Acompanhamento
    	echo "
		<td align='left' width='25%' >		
			<ul id='nav3'> 
				<li ><span onclick=\"top.location.href='acompanhamento/acompanhamento.gerenciamento.php';\">
						Acompanhamento</span>
				</li> 
			</ul>
		</td>";

		//Ajuda	
		echo "
		<td align='left' width='15%' >		
			<ul id='nav2'> 
				<li ><span>Ajuda</span>		
					<ul>";										
						echo "<li><a target='_blank' href='ajuda/ajuda.tutorial.pdf'>
							Tutorial</a></li>";	
						echo"
					</ul>
				</li> 
			</ul>
		</td>";

		//Sair	
		echo "<td align='center' width='15%'><ul><li>
			<span onclick=\"top.location.href='logout.php';\">Sair</span></td>
			</li></ul>";
	}
	echo "
	</tr>
	</table></div><br>";
} 
?>
