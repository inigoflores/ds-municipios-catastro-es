<?

$consulta_provinciero_endpoint = "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/ConsultaProvincia";

// CLI Options
$options = 0;

if (in_array('--pretty_print',$argv)) {
    $options|=JSON_PRETTY_PRINT;
}

if (in_array('--unescaped_unicode',$argv)) {
    $options|=JSON_UNESCAPED_UNICODE;
}


$xml=simplexml_load_file($consulta_provinciero_endpoint);


foreach ($xml->provinciero->prov as $provincia) {
    $provincias[] = $provincia;
}

echo json_encode($provincias, $options);


