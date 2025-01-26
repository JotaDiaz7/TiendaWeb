<?php

//Ahora vamos a atrapar a todas las imágenes que se hayan subido
$imgs = $_FILES;

if (!empty($imgs)) {
    //Recorremos las imágenes
    foreach ($imgs as $img) {
        //Ahora vamos a comprobar el tipo del archivo subido
        $name = $img['tmp_name'];
        if (!empty($name)) {
            $dataFile = GetImageSize($name);

            // Validar si $dataFile es válido
            if ($dataFile === false) {
                echo json_encode("formatoImg");
                exit;
            }

            //Comprobamos que sea una imagen en formato png, jpg, jpeg o gif
            $formatos = ["png", "jpg", "jpeg", "gif"];
            $formatoFile = $dataFile["mime"];

            $error = true;

            foreach ($formatos as $formato) {
                if ($formatoFile != "image/" . $formato) { //Si es diferente a alguno de los formatos de nuestro array
                    $error = false;
                }
            }

            if ($error) {
                echo json_encode("formatoImg");
                exit;
            }

            //Comprobamos que el tamaño de la imagen no exceda de los 200kBytes
            $size = $img['size'];
            $maxSize = 200 * 1024; //Lo convertimos en bytes

            if ($size > $maxSize) {
                echo json_encode("sizeImg");
                exit;
            }
        }
    }
}

//Capturamos el nombre de las imágenes
$img1 = isset($_FILES['img1']) && $_FILES['img1']['error'] == 4 ? ($_POST["img1"] ?? null) : ($_FILES['img1']['name'] ?? null);
$img2 = isset($_FILES['img2']) && $_FILES['img2']['error'] == 4 ? ($_POST["img2"] ?? null) : ($_FILES['img2']['name'] ?? null);
$img3 = isset($_FILES['img3']) && $_FILES['img3']['error'] == 4 ? ($_POST["img3"] ?? null) : ($_FILES['img3']['name'] ?? null);
$img4 = isset($_FILES['img4']) && $_FILES['img4']['error'] == 4 ? ($_POST["img4"] ?? null) : ($_FILES['img4']['name'] ?? null);
