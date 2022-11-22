<?php
require "./modules/required/config.php";
htmlspecialchars($_SERVER['php_SELF']);
$_SERVER['REQUEST_METHOD'] == null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio PHP 1</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/mostrardatos.css">
</head>
<body>
    <main>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'GET'): ?>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
<button type="submit" name="Holi">Enviar</button>
        </form>
 <?php else : ?>
    <?php
    echo "<div class='wrapper'>";
    $sql = "SELECT * FROM new_reg";
    $stmt = $conn->prepare($sql);
    $stmt -> execute();

    if ($result = $stmt->setFetchMode(PDO::FETCH_ASSOC)) {
        echo "<table>
        
    <table class='Tabla'>
     <thead>
      <tr class='tabla1'>
       <th>Nombre</th>
       <th>Email</th>
       <th> Telefono </th>
       <th>Direccion </th>
       <th>Ciudad</th>
       <th> C.P.</th>
       <th>Noticias</th>
       <th> Formato</th>
       <th> Texto</th>
      </tr>
      </thead>;
      foreach(($rows = $stmt->fetchAll()) as $row) {
          echo'<tr>
          <td>".row["Nombre"]."</td>
          <td>".row["Email"]."</td>
          <td>".row["Telefono"]."</td>
          <td>".row["Direccion"]."</td>
          <td>".row["Ciudad"]."</td>
          <td>".row["C.P."]."</td>
          <td>".row["Noticias"]."</td>
          <td>".row["Formato"]."</td>
          <td>".row["Texto"]."</td>
          </tr>'
      }
      echo '
      
      </table>';
    } else {
        echo '<p> 0 results, no found data.</p><br>';
    }
    $conn = null;
    ?>
    <?php endif ?>
    </main>
</body>
</html>
