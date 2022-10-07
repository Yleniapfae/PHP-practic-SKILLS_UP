
<?php
require "../required/config.php"; //Conexión con el fichero config.
//Definir las variables, El name que le tengo en el formulario (index.html)
$name = $email = $phone = $street = $city = $state = $zip = $newles = $newlestter = $text = "";
$name_err = $email_err = $phone_err = false;
    function limpiar_dato($data){
        $data = trim($data);    //trim sirve para eliminar espacios en blancos del inicio y del final
        $data = stripcslashes($data);   // Devuelve una cadena con las barras invertidas eliminadas
        $data = htmlspecialchars($data); //Para limpiar caracteres especiales: puntos, almohadillas, etc...
        return $data; //Devuelve el dato añadido en el formulario
    }
        //nombre, email y telefono
        /**
         * la  siguiente función va a validar el nombre
         * @param $name
         * @return Boolean 
         */
    function validar_name($name){
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name))/*si no se cumple la expresión regular...*/  {
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
    function validar_phone($phone){
        if(!preg_match('/^[0-9]{9}+$/', $phone)){
            return false;
        }else{
            return true;
        }
    }

//echo "<br>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    echo "<br><strong>Método post enviado</strong><br>";
    //Variables requeridas para envias a BBDD
    if(!empty($_POST["name"]) || !empty($_POST["email"]) || !empty($_POST["phone"])){
        //Asignar las variables (del formulario)
        $name = limpiar_dato($_POST["name"]);
        echo "<strong> Nombre:</strong>" . $name . "<br>";
        $email = limpiar_dato($_POST["email"]);
        echo "<strong> Correo:</strong>" . $email . "<br>";
        $phone = limpiar_dato($_POST["phone"]);
        echo "<strong> Teléfono:</strong>" . $phone . "<br>";

        if(validar_name($name)){
            echo"<br>El nombre está validado<br>";
        }else{
            $name_err = true; //si el nombre es erróneo, lo pasa a verdadero
        }

        if(validar_email($email)){
            echo"<br>El email está validado<br>";
        }else{
            $email_err = true;  //si el email es erróneo, lo pasa a verdadero
        }

        if(validar_phone($phone)){
            echo"<br>El teléfono está validado<br>";
        }else{
            $phone_err = true;   //si el teléfono es erróneo, lo pasa a verdadero
        }

        if( validar_name($name) && validar_email($email) && validar_phone($phone)){

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
            // if (isset($_POST["newles"])){
            //     $newles = limpiar_dato($_POST["newles "]);
            // } else {
            //     $newles = NULL;
            // }
            if (isset($_POST["newlestter"])){
                $newlestter = limpiar_dato($_POST["newlestter"]);
            } else {
                $newlestter = NULL;
            }
            if (isset($_POST["text"])){
                $other = limpiar_dato($_POST["text"]);
             } else {
            $other = NULL;
            }
            //============BORRAME //terminar otro dia 

            echo "<strong> Nombre:</strong>" . $name . "<br>";
            echo "<strong> email:</strong>" .  $email . "<br>";
            echo "<strong> Telefono:</strong>".$phone . "<br>";
            echo "<strong> Addres:</strong>" . $street . "<br>";
            echo "<strong> City:</strong>" . $city . "<br>";
            echo "<strong> state:</strong>" . $state. "<br>";
            echo "<strong> zip:</strong>" . $zip . "<br>";
            echo "<strong> other:</strong>" . $other . "<br>";
            // echo "<strong> newles:</strong>" . $newles . "<br>";
            echo "<strong> newlestter:</strong>" . $newlestter . "<br>";
            
           


        }else{
            if ($name_err == true){
                echo "la validación del nombre está errónea";
            }elseif($email_err == true){
                echo "La validación del email está errónea";
            }elseif($phone_err == true);
                echo "La validación del teléfono está errónea";
        }
    } else{   
        echo "Uno de los datos requeridos no ha sido rellenado";
    }
}else{
    echo "No hemos recibido método post";
}   

/* Si (llega datos) Entonces
    tratamos datos
        Si si hay información Entonces
        Si no llegan variables?**
                limpiar la información. check!!
                validar la informacion.
                Si datos necesarios Entonces 
                    asegurar de que están bien escrito.
                    Si los datos llegan lo limpia
                SiNo
                    mandamos dato tal cual.
                Fin Si
                Mostrar que todos los datos son correctos para enviar a BBDD.
        SiNo
            enviar datos necesarios
        Fin Si
SiNo
    avisar no han llegado.
Fin Si */
        
?>   