<?php

//Vamos a comprobar que al menos se haya subido una foto
if (
    $_FILES['img1']['error'] == 4
    && $_FILES['img2']['error'] == 4
    && $_FILES['img3']['error'] == 4
    && $_FILES['img4']['error'] == 4
    && (isset($_POST["img1"]) && empty($_POST["img1"]))
    && (isset($_POST["img2"]) && empty($_POST["img2"]))
    && (isset($_POST["img3"]) && empty($_POST["img3"]))
    && (isset($_POST["img4"]) && empty($_POST["img4"]))
) {
    echo json_encode("emptyImg");
    exit;
}

//Ahora vamos a atrapar a todas las imágenes que se hayan subido
$imgs = $_FILES;

if (!empty($imgs)) {
    //Recorremos las imágenes
    foreach ($imgs as $img) {
        //Ahora vamos a comprobar el tipo del archivo subido
        $name = $img['tmp_name'];
        if (!empty($name)) {
            $dataFile = GetImageSize($name);

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
                echo json_encode("formatoImg " . $formatoFile);
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
$img1 = $_FILES['img1']['error'] == 4 ? $_POST["img1"] : $_FILES['img1']['name'];
$img2 = $_FILES['img2']['error'] == 4 ? $_POST["img2"] : $_FILES['img2']['name'];
$img3 = $_FILES['img3']['error'] == 4 ? $_POST["img3"] : $_FILES['img3']['name'];
$img4 = $_FILES['img4']['error'] == 4 ? $_POST["img4"] : $_FILES['img4']['name'];
