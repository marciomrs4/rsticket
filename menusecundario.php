  </div>
<!--FIM Corpo principal do site -->    

<!--INICIO menu secund�rio da direita -->
    <div id="nav_main">
    <div class="titulo_menu_direita">Menu</div>    
        <ul>
        <?php
		$controleacesso = new ControleDeAcesso();

		$botaobusca = ("<li><a href='Busca.php'><img src='./css/images/search.png'> Pesquisar</a></li>");
		$controleacesso->permitirBotao($botaobusca, array(ControleDeAcesso::$Solicitante,ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));
		
		$botaosol = ("<li><a href='Solicitante.php'><img src='./css/images/chamado.png'> Chamado</a></li>");
		$controleacesso->permitirBotao($botaosol, array(ControleDeAcesso::$Solicitante));
		
		$botaoOperacao = ("<li><a href='Operacao.php'><img src='./css/images/chamado.png'> Chamado</a></li>");
		$controleacesso->permitirBotao($botaoOperacao, array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));
		
		
		$botaoprojeto = ("<li><a href='Projetos.php'><img src='./css/images/projeto.png'> Projetos</a></li>");					
		$controleacesso->permitirBotao($botaoprojeto, array(ControleDeAcesso::$TecnicoADM));
		
		$botaocklist = ("<li><a href='ExecutarCheckList.php'><img src='./css/images/ck.png'> CheckList</a></li>");
		$controleacesso->permitirBotao($botaocklist, array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));						
		?>
		</ul>
    </div>
<!--FIM menu secund�rio da direita -->    
    
</div>
<!-- FIM Do quadro da pagina INTEIRA -->
