<?php
require_once "vendor/autoload.php";

$year = date("y");

$shortopts = "p";  // pretty_print
$shortopts .= "u"; // unescaped_unicode
$shortopts .= "y:"; // year

$longopts  = array(
    "pretty_print",
    "unescaped_unicode",
    "year:",
);

$options = getopt($shortopts,$longopts);
//var_dump($options);die();

// CLI Options
$jsonOptions = 0;

if (array_key_exists('pretty_print',$options) || array_key_exists('p',$options)) {
    $jsonOptions|=JSON_PRETTY_PRINT;
}

if (array_key_exists('unescaped_unicode',$options) || array_key_exists('u',$options)) {
    $jsonOptions|=JSON_UNESCAPED_UNICODE;
}

if (array_key_exists('year',$options)) {
    $year=$options['year'] % 2000;
}

if (array_key_exists('y',$options)) {
    $year=$options['y'] % 2000;
}

//Comprobamos si existe el documento en el INE
$url = "http://www.ine.es/daco/daco42/codmun/codmun{$year}/{$year}codmun.xlsx";

if(get_http_response_code($url) != "200"){
    die("Error: No existe {$url}");
}

// Descargamos datos a un documento temporal
$temp = tmpfile();
fwrite($temp, file_get_contents($url));

$metaDatas = stream_get_meta_data($temp);
$tmpFilename = $metaDatas['uri'];

// Procesamos documento xlsx local
$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
$excelReader->setLoadAllSheets();

$excelObj = $excelReader->load($tmpFilename);

$output=$excelObj->getActiveSheet()->toArray(null, true,true,true);
unset($output[1]);
unset($output[2]);

$municipios=array_map(function($row){
    return [
        'CPRO' => str_pad($row['A'],2,"0",STR_PAD_LEFT),
        'CMUN' => str_pad($row['B'],3,"0",STR_PAD_LEFT),
        'NOMBRE' => $row['D'],
    ];
},array_values($output));

//var_dump($municipios);die();
echo json_encode($municipios,$jsonOptions);

// Eliminamos el archivo
fclose($temp);


function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}