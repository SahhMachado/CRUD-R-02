<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Lista de pessoas";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $cnst = isset($_POST["cnst"]) ? $_POST["cnst"] : "1"; 
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
</head>
<body>
<?php include "menu.php"; ?>
    <form method="post">
    <fieldset>
       <legend>Procurar por:</legend>
       <input type="radio" id="1" name="cnst" value="1" <?php if($cnst == 1) echo "checked" ?>>Id<br>
        <input type="radio" id="2" name="cnst" value="2" <?php if($cnst == 2) echo "checked" ?>>Nome<br>
        <input type="radio" id="3" name="cnst" value="3" <?php if($cnst == 3) echo "checked" ?>>Idade<br>
    </fieldset>
    <fieldset>
        <legend>Procurar Pessoa</legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr>
            <td><b>Id</b></td>
            <td><b>Nome</b></td>
            <td><b>Hora de entrada</b></td>
            <td><b>Hora de saída</b></td>
            <td><b>Idade</b></td>
        </tr>
        <?php
            $pdo = Conexao::getInstance(); 
            if($cnst == 1) {
                $consulta = $pdo->query("SELECT * FROM pessoa 
                                        WHERE id LIKE '$procurar%' 
                                        ORDER BY id");
    
            }else if($cnst == 2) {
                $consulta = $pdo->query("SELECT * FROM pessoa 
                                        WHERE nome LIKE '$procurar%' 
                                        ORDER BY nome");  

            }else {
                $consulta = $pdo->query("SELECT * FROM pessoa 
                                        WHERE idade <= '$procurar%' 
                                        ORDER BY idade");
            }
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
        ?>
	    <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['horaEntrada'];?></td>
            <td><?php echo $linha['horaSaida'];?></td>
            <td><?php echo $linha['idade'];?></td>
	    </tr>
            <?php } ?>       
        </table>
    </fieldset>
    </form>
</body>
</html>