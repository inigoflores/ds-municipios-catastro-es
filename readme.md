# Datos sobre Regiones Administrativas de España

Colección de scripts muy básicos que permiten descargar información sobre las regiones administrativas españolas y obtenerlos en format JSON.
 
De momento incluye

* Provincias (Catastro)
* Provincias (INE)
* Municipios (Catastro)
* Municipios (INE)

La idea es ir añadiendo más poco a poco.


## Requisitos

PHP 5.4+


## Provincias (Catastro)

Proporciona un listado de todas las provincias de España, salvo las de Alava, Vizcaya, Guipuzcoa y Navarra.

Utiliza el Servicio [ConsultaProvincia](http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx?op=ConsultaProvincia)  ofrecido por el  del Catastro.


### Formato de los datos

Se trata de un array de objetos, que incluyen las siguientes propiedades:

        "cpine": CÓDIGO INE DE LA PROVINCIA                 
        "np": NOMBRE DE LA PROVINCIA

Ejemplo:

	[
		{
			"cpine": "15",
			"np": "A CORU\u00d1A"
		},
		{
			"cpine": "03",
			"np": "ALACANT"
		},
		{
			"cpine": "02",
			"np": "ALBACETE"
		},
		

### Modo de uso

Para descargar los datos, ejecutar lo siguiente en un shell:

    $ php catastro_retrieve_provincias.php > catastro_provincias.json



## Provincias (INE)

Proporciona un listado de todas las provincias de España.

Saca los datos de [Relación de provincias con sus códigos](http://www.ine.es/daco/daco42/codmun/cod_provincia.htm), en la web del INE.


### Formato de los datos

Se trata de un array de objetos, que incluyen las siguientes propiedades:

        "codigo": CÓDIGO INE DE LA PROVINCIA                 
        "npombre": NOMBRE DE LA PROVINCIA

Ejemplo:

    [
        {
            "codigo": "02",
            "nombre": "Albacete"
        },
        {
            "codigo": "03",
            "nombre": "Alicante\/Alacant"
        },
        {
            "codigo": "04",
            "nombre": "Almer\u00eda"
        },
        {
            "codigo": "01",
            "nombre": "Araba\/\u00c1lava"
        },
		

### Modo de uso

Para descargar los datos, ejecutar lo siguiente en un shell:

    $ php ine_retrieve_provincias.php > ine_provincias.json
    
    
## Municipios (Catastro)

Proporciona un listado de todos los municipios de España, salvo aquellos que se encuentran en Alava, Vizcaya, Guipuzcoa y Navarra.

Incluye tanto los códigos INE como los códigos MHAP. Estos últimos son especialmente útiles para tratar con organismos públicos como la AEAT.

Utiliza el Servicio [ConsultaMunicipioCodigos](http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejeroCodigos.asmx/ConsultaMunicipioCodigos) ofrecido por el  del Catastro.



### Formato de los datos

Se trata de un array de objetos.

Ejemplo:

    [
        {
            "nm": "A BA\u00d1A",  // DENOMINACIÓN DEL MUNICIPIO SEGÚN M. DE HACIENDA Y ADMINISTRACIONES PÚBLICAS    
            "locat": {            // CÓDIGOS DEL MUNICIPIO SEGÚN MHAP
                "cd": "15",       // CÓDIGO DE LA DELEGACIÓN MHAP
                "cmc": "7"        // CÓDIGO DEL MUNICIPIO  
            },
            "loine": {            // CÓDIGOS DEL MUNICIPIO SEGÚN INE
                "cp": "15",       // CÓDIGO DE LA PROVINCIA
                "cm": "7"         // CÓDIGO DEL MUNICIPIO    
            }
        },
        {
            "nm": "A CAPELA",
            "locat": {
                "cd": "15",
                "cmc": "18"
            },
            "loine": {
                "cp": "15",
                "cm": "18"
            }
        },
        {
            "nm": "A CORU\u00d1A",
            "locat": {
                "cd": "15",
                "cmc": "900"
            },
            "loine": {
                "cp": "15",
                "cm": "30"
            }
        },


### Modo de uso

Para descargar los datos, ejecutar lo siguiente en un shell:

    $ php catastro_retrieve_municipios.php > catastro_municipios.json



## Municipios (INE)

Proporciona un listado de todos los municipios de España.

No incluye los codigos MHAP, necesarios para trabajar con organismos públicos como la AEAT.

Saca los datos de un Excel encontrado en [Relación de municipios y códigos por provincias](http://www.ine.es/daco/daco42/codmun/codmun16/16codmunmapa.htm), en la web del INE.
    

### Formato de los datos

Se trata de un array de objetos.

Ejemplo:


    [
        {
            "CPRO": "01",                       // CÓDIGO DE LA PROVINCIA
            "CMUN": "001",                      // CÓDIGO DEL MUNICIPIO
            "NOMBRE": "Alegr\u00eda-Dulantzi"   // DENOMINACIÓN DEL MUNICIPIO 
        },
        {
            "CPRO": "01",
            "CMUN": "002",
            "NOMBRE": "Amurrio"
        },
        {
            "CPRO": "01",
            "CMUN": "049",
            "NOMBRE": "A\u00f1ana"
        },
        {
            "CPRO": "01",
            "CMUN": "003",
            "NOMBRE": "Aramaio"
        },



### Modo de uso

Para descargar los datos, ejecutar lo siguiente en un shell:

    $ php ine_retrieve_municipios.php > ine_municipios.json

Este script se puede invocar con la opción `-y=[year]` o `--year=[year]`, generando el listado de municipios para el año especificado. Ej.:
 
     $ php ine_retrieve_municipios.php --year=2014 > ine_municipios_2014.json

     
## Opciones

Por defecto, estos scripts producen una versión JSON minificada y con codificación Unicode para los caracteres especiales. 

Para modificar el comportamiento, se pueden usar las siguientes opciones:
 
    --pretty_print, -p 			Formatea la salida, añadiendo indentación y CR/LF al final de las lineas. 
    --unescaped_unicode, -u 	Codifica caracteres Unicode multibyte literalmente (por defecto es escapado como \uXXXX).


## Datos pre descargados

La carpeta `data` incluye algunos archivos .json ya descargados.


