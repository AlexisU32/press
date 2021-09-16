<?php

header("Access-Control-Allow_Origin: *");
header('content-type: aplication/json');

// Obtener el method de consulta
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Validar que exista o no este vacio el apikey
    if (empty($data->api_key)) {
        // Array de respuesta
        $response = array(
            "estado" => "error",
            "mensaje" => "El token está vacío ",
            "campos_fallidos" => ""
        );
    
        http_response_code(401);
        echo json_encode($response); 
        exit();
    }

// Validar que el Token sea válido ---------------------------------------------

    //$moduloApikey = new ModuloApiKey("3000");

    /*
    if ($moduloApikey->searchApiKey("")) {
        $id_cliente = "3000";
    }else{
        exit();
    }
    */

    // Se crea una instancia del modelo Demograficos.php
    //$demograficos = new Demograficos($id_cliente);

    // Validación para los cuatro campos necesario para crear un paciente 
    
    $dato_respuesta = array('bandera' => 0, 'alerta' => array());

// Tipo documentos --------------------------------------------------------
    if (empty($data->tipo_documento)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El tipo de documento está vacío';
    }elseif (!preg_match("/^[a-zA-Z]*$/", $data->tipo_documento)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El tipo de documento no es válido';
    }elseif (!(strlen($data->tipo_documento) > 0 && strlen($data->tipo_documento) <= 4)) // Validar la longitud de los caracteres
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El tipo de documento no debe exceder los 4 caracteres';
    }elseif (false) // Se valida en BD si existe el tipo de identificación
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El tipo de documento no es válido';
    }
// Id del paciente --------------------------------------------------------
    if (empty($data->id_paciente)) {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El número de documento está vacío';

    }elseif (!(strlen($data->id_paciente) > 0 && strlen($data->id_paciente) <= 20)) // Validar la longitud de id_paciente
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El número de identificación del paciente no puede exceder los 20 caracteres';

    }elseif ($data->tipo_documento == "CC" && !is_numeric($data->id_paciente)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El número de identificación del paciente no puede exceder los 20 caracteres';

    }elseif ($data->tipo_documento == "TI" && !is_numeric($data->id_paciente)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El tipo de documento no coincide con el número de la tarje de identidad ';

    }elseif ($data->tipo_documento == "CE" && !preg_match("/^[a-zA-Z0-9]*$/", $data->tipo_documento)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El tipo de documento no coincide con el número de identificación ';

    }

// Primer nombre --------------------------------------------------------
    if (empty($data->primer_nombre)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El primer nombre está vacío';

    }elseif (!(strlen($data->primer_nombre) > 0 && strlen($data->primer_nombre) <= 50)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El nombre no puede exceder los 50 caracteres';    

    }elseif (!preg_match("/^[a-zA-Z]+$/", $data->primer_nombre)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El primer nombre del paciente no cumple parámetros';

    }

// Primer apellido --------------------------------------------------------
    if (empty($data->primer_apellido)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El primer apellido está vacío';
    }elseif (!(strlen($data->primer_nombre) > 0 && strlen($data->primer_nombre) <= 50)) 
    {
        $dato_respuesta['bandera'] = 1;
        $dato_respuesta['alerta'][] = 'El primer apellido no puede exceder los 50 caracteres'; 
    }

// Validar bandera --------------------------------------------------------
    
    if ($dato_respuesta['bandera'] == 1) {
         // Array de respuesta
         $response = array(
            "estado" => "error",
            "mensaje" => 'Los datos no son validos',
            "campos_fallidos" => $dato_respuesta['alerta']
        );

        http_response_code(401);
        echo json_encode($response); 
        exit();


    }

    //$exist_de_identifi = $demograficos->searchTipo_de_identifi($data->tipo_documento);



/*
    $arr = array("id_cliente" => '123456789');
    $dat = $demograficos->verificarUser($arr);

    $dats = $demograficos->verificarAllUser();

    var_dump($dats);
    var_dump($dat);

*/
    
}else{
    // Array de respuesta
    $response = array(
        "estado" => "error",
        "mensaje" => "El método de envio no es valido ",
        "campos_fallidos" => ""
    );

    http_response_code(401);
    echo json_encode($response); 
    exit();
}