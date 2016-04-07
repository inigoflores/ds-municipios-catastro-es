<?

$consulta_provinciero_endpoint = "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/ConsultaProvincia";

// CLI Options
$shortopts = "p";  // pretty_print
$shortopts .= "u"; // unescaped_unicode

$longopts  = array(
    "pretty_print",
    "unescaped_unicode",
);

$options = getopt($shortopts,$longopts);

// CLI Options
$jsonOptions = 0;

if (array_key_exists('pretty_print',$options) || array_key_exists('p',$options)) {
    $jsonOptions|=JSON_PRETTY_PRINT;
}

if (array_key_exists('unescaped_unicode',$options) || array_key_exists('u',$options)) {
    $jsonOptions|=JSON_UNESCAPED_UNICODE;
}


$xml=simplexml_load_file($consulta_provinciero_endpoint);


foreach ($xml->provinciero->prov as $provincia) {
    $provincias[] = $provincia;
}

echo json_encode($provincias, $jsonOptions);


