<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <title>Teste 02</title>

    </head>
    <body>
        <nav class="menu">
            <span class="titulo"><a href="/">Teste 02</a></span>
            <ul class="menu">
                <li><a href="/cliente">Cliente</a></li>
                <li><a href="/contrato">Contrato</a></li>
        </nav>
        <span id="mensagem"><?php echo $erro; ?></span>
        <div id="conteudo">
            <?php include($viewPath); ?>
        </div>
    </div>

    <footer>
        Desenvolvido por Felippe Roberto Bayestorff Duarte ©
    </footer>
</html>