<?php

require_once "vendor/autoload.php";
use Sunra\PhpSimple\HtmlDomParser;


$url = "http://www.ine.es/daco/daco42/codmun/cod_provincia.htm";

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

$html=iconv("ISO-8859-15", "UTF-8", file_get_contents($url));

$dom = HtmlDomParser::str_get_html( $html );

$provincias=[];
foreach($dom->find('table[summary$=quetacion]') as $table) {
    foreach($table->find('tr[!valign]') as $row){
        $provincias[] = [
            'codigo' => trim($row->children(0)->innertext),
            'nombre' => html_entity_decode(trim($row->children(1)->innertext)),
        ];

    };
};

echo json_encode($provincias,$jsonOptions);


