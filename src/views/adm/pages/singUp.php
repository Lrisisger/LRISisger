<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

        <form action="../../../actions/singUpAction.php" method="post">
            <input type="hidden" name="adm" value="1">

            <label>
                Digite seu nome:<br/>
                <input type="text" name="name">
            </label>

            <br/><br/>

            <label>
                Digite o email:<br/>
                <input type="text" name="email">
            </label>

            <br/><br/>

            <label>
                Digite seu CPF:<br/>
                <input type="text" name="cpf">
            </label>

            <br/><br/>

            <label>
                Digite senha:<br/>
                <input type="password" name="pass">
            </label>
            <br/><br/>
            <input type="submit">

        </form>
</body>
</html>