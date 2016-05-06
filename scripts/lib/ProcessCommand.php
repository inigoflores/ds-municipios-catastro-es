<?php

use Sunra\PhpSimple\HtmlDomParser;

use ConsoleKit\Widgets\ProgressBar;
use ConsoleKit\Widgets\Box;

/**
 * Procesa los archivos fuente y graba a disco los datos en CSV
 *
 */
class ProcessCommand extends ConsoleKit\Command
{


    public function execute(array $args, array $options = array())
    {

        $this->processMunicipios();
        $this->processProvincias();

    }


    /**
     * Procesa los archivos fuente de los municipios y genera el CSV
     */
    public function processMunicipios(){

        $destFile = fopen(BASE_PATH . DS . Config::$datapackage['resources']['0']['path'], 'w+');
        $this->writeHeaderToFile($destFile,Config::$datapackage['resources']['0']['schema']['fields']);


        for ($i=1;$i<=52;$i++) {
            if (in_array($i,[1,20,31,48])) { //quitamos provincias del Pais Vasco y Navarra
                continue;
            }

            $sourceFileName=sprintf(ARCHIVE_FOLDER . DS . Config::MUNICIPIOS_SOURCE_FILE,$i);

            $xml=simplexml_load_file($sourceFileName);
            $json = json_encode($xml->municipiero);
            $municipios = json_decode($json);

            if (!is_array($municipios->muni)) { // Para procesar las provincias con un solo municipio (e.j. Ceuta)
                $municipios->muni=[$municipios->muni];
            }

            foreach($municipios->muni as $municipio){
                fputcsv($destFile,[
                    'mhap_id'   => str_pad($municipio->locat->cd,2,'0',STR_PAD_LEFT) . str_pad($municipio->locat->cmc,3,'0',STR_PAD_LEFT),
                    'ine_id'    => str_pad($municipio->loine->cp,2,'0',STR_PAD_LEFT) . str_pad($municipio->loine->cm,3,'0',STR_PAD_LEFT),
                    'nombre'    => $municipio->nm,
                    'locat_cd'  => $municipio->locat->cd,
                    'locat_cmc' => $municipio->locat->cmc,
                    'loine_cp'  => $municipio->loine->cp,
                    'loine_cm'  => $municipio->loine->cm,

                ]);
            }
        }

        fclose($destFile);

    }


    /**
     * Procesa los archivos fuente de los municipios y genera el CSV
     */
    public function processProvincias(){

        $destFile = fopen(BASE_PATH . DS . Config::$datapackage['resources']['1']['path'], 'w+');
        $this->writeHeaderToFile($destFile,Config::$datapackage['resources']['1']['schema']['fields']);

        $xml=simplexml_load_file(ARCHIVE_FOLDER . DS . Config::PROVINCIAS_SOURCE_FILE);

        foreach ($xml->provinciero->prov as $provincia) {
            fputcsv($destFile,[
                'ine_id' => str_pad($provincia->cpine,2,'0',STR_PAD_LEFT),
                'nombre' => $provincia->np,
            ]);
        }

        fclose($destFile);

    }




    /*
     * Graba el el cabecero con el nombre de las columnas a disco
     *
     * @param resource $file identificador del archivo
     *
     */
    private function writeHeaderToFile($file,$columns)
    {
        fputcsv($file, array_map(function($var){ return $var['name']; }, $columns));
        return;
    }

}