  </div>
<!--FIM Corpo principal do site -->    

<!--INICIO menu secundário da direita -->
    <div id="nav_main">
    <div class="titulo_menu_direita">Menu</div>    
        <ul>
        <?php
		$controleacesso = new ControleDeAcesso();
		 
		$botaosol = ("<li><a href='Solicitante.php'><img src='./css/images/chamado.png'> Chamado</a></li>");
		$controleacesso->permitirBotao($botaosol, ControleDeAcesso::$Solicitante);
		
		$botaoOperacao = ("<li><a href='Operacao.php'><img src='./css/images/chamado.png'> Chamado</a></li>");
		$controleacesso->permitirBotao($botaoOperacao, ControleDeAcesso::$Executor);
		
		$botaoprojeto = ("<li><a href='Projetos.php'><img src='./css/images/projeto.png'> Projetos</a></li>");					
		$controleacesso->permitirBotao($botaoprojeto, ControleDeAcesso::$Executor);
		
		$botaocklist = ("<li><a href='ExecutarCheckList.php'><img src='./css/images/ck.png'> CheckList</a></li>");
		$controleacesso->permitirBotao($botaocklist, ControleDeAcesso::$Executor);						
		?>
		</ul>
    </div>
<!--FIM menu secundário da direita -->    
    
</div>
<!-- FIM Do quadro da pagina INTEIRA -->
