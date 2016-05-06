# ds-municipios-catastro-es

Dataset que incluye un listado de municipios y provincias de España según el Catastro. Incluye:
 
* **Códigos INE** (Instituto Nacional de Estadística) 
* **Códigos MHAP** (Ministerio de Hacienda y Administraciones Públicas).
 


## Municipios 


- Fuente: [Servicio Web `ConsultaMunicipioCodigos` del Catastro](http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejeroCodigos.asmx?op=ConsultaMunicipioCodigos)
- Tipo: XML 
- Datos procesados: [/data/municipios_catastro.csv](data/municipios_catastro.csv) 

Proporciona un listado de los municipios de España, salvo aquellos que se encuentran en Alava, Vizcaya, Guipuzcoa y Navarra.

Incluye tanto los códigos INE como los códigos MHAP (Ministerio de Hacienda y Administraciones Públicas). Estos últimos son especialmente útiles para tratar con organismos públicos como la AEAT.



### Formato de los datos


Incluye los siguientes campos:

        mhap_id:  Código MHAP del municipio
        ine_id:   Código INE del municipio
        nombre:   Denominación del municipio según MHAP
        loine_cp: Código INE de la provincia
        loine_cm: Código INE del municipio en relación a la provincia. 
        locat_cd: Código MHAP de la delegación
        locat_cmc: Código MHAP del municipio 
       



Ejemplo en CSV:


| mhap_id | ine_id | nombre                | loine_cp | loine_cm | locat_cd | locat_cmc | 
|---------|--------|-----------------------|----------|----------|----------|-----------| 
| 02001   | 02001  | ABENGIBRE             | 2        | 1        | 2        | 1         | 
| 02002   | 02002  | ALATOZ                | 2        | 2        | 2        | 2         | 
| 02900   | 02003  | ALBACETE              | 2        | 900      | 2        | 3         | 
| 02004   | 02004  | ALBATANA              | 2        | 4        | 2        | 4         | 
| 02005   | 02005  | ALBOREA               | 2        | 5        | 2        | 5         | 
| 02006   | 02006  | ALCADOZO              | 2        | 6        | 2        | 6         | 
| 02007   | 02007  | "ALCALA DEL JUCAR"    | 2        | 7        | 2        | 7         | 
| 02008   | 02008  | ALCARAZ               | 2        | 8        | 2        | 8         | 
| 02009   | 02009  | ALMANSA               | 2        | 9        | 2        | 9         | 
| 02010   | 02010  | ALPERA                | 2        | 10       | 2        | 10        | 
| 02011   | 02011  | AYNA                  | 2        | 11       | 2        | 11        | 
| 02012   | 02012  | BALAZOTE              | 2        | 12       | 2        | 12        | 
| 02013   | 02013  | "BALSA DE VES"        | 2        | 13       | 2        | 13        | 
| 02015   | 02015  | BARRAX                | 2        | 15       | 2        | 15        | 
| 02016   | 02016  | BIENSERVIDA           | 2        | 16       | 2        | 16        | 



## Provincias 


- Fuente: [Servicio Web `ConsultaProvincia` del Catastro](http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejeroCodigos.asmx/ConsultaProvincia)
- Tipo: XML 
- Datos procesados: [/data/provincias_catastro.csv](data/provincias_catastro.csv) 

Proporciona un listado de las provincias de España, salvo las de Alava, Vizcaya, Guipuzcoa y Navarra.



### Formato de los datos


Incluye los siguientes campos:

        ine_id:   Código INE de la provincia
        nombre:   Denominación del municipio según el INE
        
      

Ejemplo en CSV:


| ine_id | nombre     | 
|--------|------------| 
| 15     | "A CORUÑA" | 
| 03     | ALACANT    | 
| 02     | ALBACETE   | 
| 04     | ALMERIA    | 
| 33     | ASTURIAS   | 
| 05     | AVILA      | 
| 06     | BADAJOZ    | 
| 08     | BARCELONA  | 
| 09     | BURGOS     | 
| 10     | CACERES    | 