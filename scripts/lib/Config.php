<?php

class Config
{

    const MUNICIPIOS_ENDPOINT_URL = "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejeroCodigos.asmx/ConsultaMunicipioCodigos?CodigoProvincia=%d&CodigoMunicipio=&CodigoMunicipioIne=";
    const PROVINCIAS_ENDPOINT_URL = "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejeroCodigos.asmx/ConsultaProvincia";

    const DATA_FOLDER = "data";
    const ARCHIVE_FOLDER = "archive";

    const PROVINCIAS_SOURCE_FILE = "provincias.xml";
    const MUNICIPIOS_SOURCE_FILE = "municipios_%d.xml";


    static $datapackage = [
        "name" => "ds-municipios-catastro-es",
        "title" => "Listado de Municipios según el Catastro de España",
        "descriptions" => "Listado de municipios según el Catastro. No incluye País Vasco y Navarra",
        "licenses" => [
            [
                "type" => "odc-pddl",
                "url" => "http://opendatacommons.org/licenses/pddl/"
            ]
        ],
        "author" => [
            "name" => "Iñigo Flores"
        ],
        "keywords" => [ "Municipios", "Catastro"],

        "sources" => [
             [
                "name" => "Callejero de la Sede Electrónica del Catastro",
                "web" => "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejeroCodigos.asmx"
             ]
        ],
        "resources" =>[
            array(
                'name' => 'municipios_catastro',
                'title' => 'Municipios de España según el Catastro',
                'description' => 'Relacion de municipios de España por provincia, según el Catastro. No incluye País Vasco y Navarra',
                'format' => 'csv',
                'path' => 'data/municipios_catastro.csv',
                'schema' =>
                    array (
                        'fields' =>
                            array (
                                array (
                                    'name' => 'mhap_id',
                                    'type' => 'number',
                                    'description' => 'Código MHAP del municipio',
                                    'pattern' => '[0-9]{5}',
                                ),
                                array (
                                    'name' => 'ine_id',
                                    'type' => 'number',
                                    'description' => 'Código INE del municipio',
                                    'pattern' => '[0-9]{5}',
                                ),
                                array (
                                    'name' => 'nombre',
                                    'type' => 'string',
                                    'description' => 'Denominación del municipio según MHAP',
                                ),
                                array (
                                    'name' => 'locat_cd',
                                    'type' => 'number',
                                    'description' => 'Código MHAP de la delegación',
                                    'pattern' => '[0-9]{2}',
                                ),
                                array (
                                    'name' => 'locat_cmc',
                                    'type' => 'number',
                                    'description' => 'Código MHAP del municipio en relación a la delegaciónprovincia. locat_cd concatenado con locat_cmc resulta en mhap_id',
                                    'pattern' => '[0-9]{3}',
                                ),
                                array (
                                    'name' => 'loine_cp',
                                    'type' => 'number',
                                    'description' => 'Código INE de la provincia',
                                    'pattern' => '[0-9]{2}',
                                ),
                                array (
                                    'name' => 'loine_cm',
                                    'type' => 'number',
                                    'description' => 'Código INE del municipio en relación a la provincia. loine_cp concatenado con loine_cm resulta en ine_id',
                                    'pattern' => '[0-9]{3}',
                                ),


                            ),
                    ),
                ),

            array (
                'name' => 'provincias_catastro',
                'title' => 'Provincias de España según el Catastro',
                'description' => 'Relacion de provincias de España, según el Catastro. No incluye País Vasco y Navarra',
                'format' => 'csv',
                'path' => 'data/provincias_catastro.csv',
                'schema' =>
                    array (
                        'fields' =>
                            array (
                                array (
                                    'name' => 'ine_id',
                                    'type' => 'number',
                                    'description' => 'Código INE de la provincia',
                                    'pattern' => '[0-9]{2}',
                                ),
                                array (
                                    'name' => 'nombre',
                                    'type' => 'string',
                                    'description' => 'Denominación de la provincia según el INE',
                                ),
                            ),
                    ),
            ),
      ]
    ];


}