</div>     
		<!--FIM Quadro de menu miniatura -->
<!--INICIO menu principal -->
<div id="navcont">
    <ul id="nav">
    
		<?php
		$acesso = new ControleDeAcesso(); 
        $acesso->permitirBotao("<li><a href='Solicitante.php'>Chamado</a></li>",ControleDeAcesso::$Solicitante);
        $acesso->permitirBotao("<li><a href='Operacao.php'>Opera��o</a></li>",ControleDeAcesso::$Executor);
        $acesso->permitirBotao("<li><a href='Relatorio.php'>Relat�rio</a></li>",ControleDeAcesso::$Executor);        
        $acesso->permitirBotao("<li><a href='Administracao.php'>Administra��o</a></li>",ControleDeAcesso::$Executor);

        ?>                        
    </ul>
</div>    
<!--FIM Menu principal -->

<!--INICIO Corpo principal do site -->
        <div id="content_main">