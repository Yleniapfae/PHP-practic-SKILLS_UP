
<?php
require "../required/config.php"; //Conexión con el fichero config.
//Definir las variables, El name que le tengo en el formulario (index.html)
$name = $email = $phone = $street = $city = $state = $zip = $newles = $newlestter = $text = "";
$name_err = $email_err = $phone_err = false;
$checkeado; //nueva varialbe newlestter
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
        } else {
            $name_err = true; //si el nombre es erróneo, lo pasa a verdadero
        }

        if(validar_email($email)){
            echo"<br>El email está validado<br>";
        } else {
            $email_err = true;  //si el email es erróneo, lo pasa a verdadero
        }

        if(validar_phone($phone)){
            echo"<br>El teléfono está validado<br>";
        } else {
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
            $newles = filter_input(
                INPUT_POST, 
                "newles", 
                FILTER_SANITIZE_SPECIAL_CHARS,
                FILTER_REQUIRE_ARRAY
            );
               var_dump($check);
               echo "<br>La longitud del check es: " . count($check) . ". <br>";

               $lengArray = count($check); //count devuelve todos los elementos de la array
   
               switch ($lengArray){
                   case 1:
                       if ($check[0] == "HTML"){
                           $checkeado = bindec ("100");
                       } elseif($check[0] == "CSS"){
                           $checkeado = bindec ("010");
                       } else {
                           $checkeado = bindec ("001");
                       }
                       break;
   
                   case 2:
                       if($check[0] != "HTML"){
                           $checkeado = bindec ("011");
                           } elseif ($check[0] != "CSS"){
                           $checkeado = bindec ("101");
                           } else{
                           $checkeado = bindec ("110");
                           }
                       break;
   
                       case 3:
                           $checkeado = bindec ("110");
                           break;
                   default:
                       $checkeado = bindec ("100");
               } //Cierre del switch
   
               echo "Valor a devolver " . $checkeado . "<br>";
               //== Usa un array y muestra sus valores separados por coma (o lo que se ponga entre las comillas)
               $string=implode(", ", $check);
               echo $string. "<br>";

               
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
            echo "<strong> other:</strong>" . $text . "<br>";
            // echo "<strong> newles:</strong>" . $newles . "<br>";
            echo "<strong> newlestter:</strong>" . $newlestter . "<br>";
            try {
                $sql= "SELECT * from news_reg  WHERE fullname = :fullname OR email= :email OR phone = :phone";
                
                $stmt =$conn-> prepare ($sql);

                $stmt->bindParam(":fullname", $name, PDO:: PARAM_STR);
                $stmt->bindParam(":email", $email, PDO:: PARAM_STR);
                $stmt->bindParam(":phone", $phone, PDO:: PARAM_STR);

                $stmt-> execute();
                $resultado = $stmt-> fetchAll();
                echo "El resultado es " .var_dump($resultado) . "<br>";
                if($resultado){
                    echo "<br>La información ya existe. <br>";
                } else{
                    try {
                        $sql ="INSERT INTO news_reg (fullname, email, phone, address, city, state, zipcode, newsletters, format_news, suggestion) VALUES (:fullname, :email, :phone, :address, :city, :state, :zipcode, :newsletters, :format_news, :suggestion)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(":fullname", $name, PDO:: PARAM_STR);
                        $stmt->bindParam(":email", $email, PDO:: PARAM_STR);
                        $stmt->bindParam(":phone", $phone, PDO:: PARAM_STR);
                        $stmt->bindParam(":address", $street, PDO:: PARAM_STR);
                        $stmt->bindParam(":city", $city, PDO:: PARAM_STR);
                        $stmt->bindParam(":state", $state, PDO:: PARAM_STR);
                        $stmt->bindParam(":zipcode", $zip, PDO:: PARAM_STR);
                        $stmt->bindParam(":newsletters", $checkeado, PDO:: PARAM_STR);
                        $stmt->bindParam(":format_news", $newlestter, PDO:: PARAM_STR);
                        $stmt->bindParam(":suggestion", $text, PDO:: PARAM_STR);

                        $stmt-> execute();
                        echo "Nuevo registro creado con éxito <br>";   
                    } catch(PDOException $e){
                        echo $sql . "<br>" . $e->getMessage();
                    }
                    $conn = null;
                }
            } catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }

        } else {                          /*cerrar el if de validar*/
            if ($nombre_err == true) {
                echo "la validación del nombre está errónea";
            } elseif ($email_err == true) {
                echo "La validación del email está errónea";
            } elseif ($telefono_err == true) {
                echo "La validación del teléfono está errónea";
            }
        }


    } else {         /*Cierra el segundo if*/
        echo "Uno de los datos requeridos no ha sido rellenado";
    }

} else { //Cierre del primer if 
    echo "No se ha recibido el método post";
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