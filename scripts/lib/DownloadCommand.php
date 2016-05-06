<?php
/**
 * Si no existen, descarga los archivos fuente y los graba a disco
 *
 */
class DownloadCommand extends ConsoleKit\Command
{


    public function execute(array $args, array $options = array())
    {
        // Municipios

        for ($i=1;$i<=52;$i++) {
            if (in_array($i,[1,20,31,48])) { //quitamos provincias del Pais Vasco y Navarra
                continue;
            }

            $url=sprintf(Config::MUNICIPIOS_ENDPOINT_URL,$i);
            $file=sprintf(Config::MUNICIPIOS_SOURCE_FILE,$i);

            if (!file_exists(ARCHIVE_FOLDER . DS . $file) || isset($options['force']) || isset($options['f'])){
                file_put_contents(ARCHIVE_FOLDER . DS . $file, fopen($url, 'r'));
            }

        }


        //Provincias

        if (!file_exists(ARCHIVE_FOLDER . DS . Config::PROVINCIAS_SOURCE_FILE) || isset($options['force']) || isset($options['f'])){
            file_put_contents(ARCHIVE_FOLDER . DS . Config::PROVINCIAS_SOURCE_FILE, fopen(Config::PROVINCIAS_ENDPOINT_URL, 'r'));
        }


    }

}