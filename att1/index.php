<!DOCTYPE html>
<html>
<head>
	<title>SisCadPF</title>

        <!-- Bootstrap URL - CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="css/theme.css" rel="stylesheet">
        <!-- Ajax Script -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include_once ("controle.php");

    if( !empty($_POST['form_submit']) ) {
        rotas($_POST);
    }
?>

<body role="document">
    <form class="form" method="post">
        <input TYPE="hidden" NAME="form_submit" VALUE="OK">
            <br><br>
            <button type="submit" name="acao" value="cadastar/0" class="btn btn-primary btn-block">
                <b>Cadastar nova pessoa física</b>
            </button>
    </form>
    <div class="container theme-showcase" role="main">
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>CPF</th>
                        <th>NOME</th>
                        <th>ENDEREÇO</th>
                        <th>TELEFONE</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php loadTabela(); ?>
                </tbody>
            </table>
        </div>
</body>
</html>