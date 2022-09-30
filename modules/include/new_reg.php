
<?php
require "../required/config.php"; //Conexión con el fichero config.
//Definir las variables, El name que le tengo en el formulario (index.html)
$name = $email = $phone = $street = $city = $state = $zip = $newles = $newlestter = $text = "";
    function limpiar_dato($data){
        $data = trim($data);    //trim sirve para eliminar espacios en blancos del inicio y del final
        $data = stripcslashes($data);   // Devuelve una cadena con las barras invertidas eliminadas
        $data = htmlspecialchars($data); //Para limpiar caracteres especiales: puntos, almohadillas, etc...
        return $dato; //Devuelve el dato añadido en el formulario
    }
//nombre, email y telefono
        /**
         * la  siguiente función va a validar el nombre
         * @param $name
         * @return Boolean 
         */
    function validar_nombre($name){
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name))/*si no se cumple la expresión regular...*/  {
            $nameErr = "Sólo se permiten letras y espacio en blanco";/*... muestra un error */
            return false; //devuelve falso
        } else{
            return true; //devuelve verdadero
        }
    }//termina la función del nombre validado

        /**
         * la función siguiente va a validar el email
         * @param $email
         * @return Boolean 
         */
    function validar_email($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))/*Valida una dirección de correo electrónico */ {
            return false;
        }else{
            return true;
        }
    }
    //Para documentar la función
        /**
         * la función siguiente va a validar un teléfono
         * @param $phone
         * @return Boolean 
         */
    function validar_telefono($phone){
        if(!preg_match('/^[0-9]{9}+$/', $phone)){
            return false;
        }else{
            return true;
        }
    }

echo "<br>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    echo "<br><strong>Método post enviado</strong><br>";
    //Variables requeridas para envias a BBDD
    if(!empty($_POST["name"]) || !empty($_POST["email"]) || !empty($_POST["phone"])){
       // echo "<br><strong>datos post enviados</strong><br>";
        //Asignar las variables (del formulario)
        $name = limpiar_dato($_POST["name"]);
       // echo "<strong> Nombre:</strong>" . $name . "<br>";
        $email = limpiar_dato($_POST["email"]);
       // echo "<strong> Correo:</strong>" . $email . "<br>";
        $phone = limpiar_dato($_POST["phone"]);
       // echo "<strong> Teléfono:</strong>" . $phone . "<br>";
         if (isset($_POST["street"])){
        $street = limpiar_dato($_POST["street"]);
         } else {
        $street = NULL;
       }
       if (isset($_POST["city"])){
         $city = limpiar_dato($_POST["city"]);
         } else {
        $street = NULL;
       }
       if (isset($_POST["state"])){
        $state = limpiar_dato($_POST["state"]);
         } else {
        $state = NULL;
       }
       if (isset($_POST["zip"])){
        $zip = limpiar_dato($_POST["zip"]);
         } else {
        $zip = NULL;
       }
       if (isset($_POST["newles"])){
        $newles = limpiar_dato($_POST["newles "]);
         } else {
        $newles = NULL;
       }
       if (isset($_POST["newlestter"])){
         $newlestter = limpiar_dato($_POST["newlestter"]);
         } else {
        $newlestter = NULL;
       }
       if (isset($_POST["other"])){
        $other = limpiar_dato($_POST["other"]);
         } else {
        $other = NULL;
       }
        if(validar_nombre($name)){
            echo "Validada";
        }else{
            echo "No validada";
        }
    }
}

        
?>   