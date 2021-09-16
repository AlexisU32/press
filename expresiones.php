<?php

    $string = "Cualquier datos que llegue en un string";

    if (preg_match('/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/', $string)) {
        // Lo que hace esta función es que solo permite letras en minusculas y mayusculas de la A-Z, tambien la Ñ y las bocales con tilde
        // Si llega un string con números y caracteres especiales este los rechaza y no se cumple la condición
    }else{
        
        // Si se encuentra algún caracter especial la condición la rechaza 

    }


    if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $string)) {
        // Este se usa para validar correos electronicos
    }

    if (preg_match('/^[a-zA-Z ]+$/', $string)) {
        // Este se usa para validar el password
    }


    // Se recomienda que no se cierre la etiqueta de php 