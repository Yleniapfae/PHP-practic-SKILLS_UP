<?php
required "../required/config.php";
//Aqui definimos las variables para saber cuales vamos a utilizar
$name = $email = $phone = $street = $city = $state = $zip = $newles = $newlestter = $text =""

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "<br><strong>Metido post enviado</strong>
    print_r ($_POST)
    if (!empty($_POST["name"]) || !empty($_POST["email"]) || !empty($_POST["phone"])) {
        echo "<br><strong>name post hay datos</strong><br>";
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $zip = $_POST["zip"];
        $newles = $_POST["newles"];
        $newlestter = $_POST["newlestter"];
        $text = $_POST["text"];

        function limpiar_datos ($data){
          $data = trim(data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
        }

        $othert = limpiar_dato($_POST["othert"]);
        echo "<strong>Noticias que quiere recibir: $newletter";

        //nombre, email y nª de telefono
        // TODO: documentacion.
        function validar_name($name){
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            return false;
          } else {
            return true; 
          }
          function validar_email($email){
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
          } else {
            return true;
          }
        }
          function validar_phone($phone){
          if(preg_match('/^[0-9]{10}+$/', $phone)) {
            return false;
            } else {
            return true;
            }
          }
        }
    }
}
?>