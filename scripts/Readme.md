# Script

Procesa los archivos fuente de municipios y provincials alojados en `../archive`.

Si no los encuentra, los descarga.


## Modo de Uso

    $ php script.php [COMMAND] [OPTIONS]

Si se invoca sin subcomandos o argumentos, executa:

  1. download all
  2. process all  
  3. update


### Opciones

    COMMANDS
    
        download                Descarga los archivos fuente, pero no los procesa.                                                                                    

            OPTIONS
            
                --force, -f     Fuerza la descarga de los archivos fuente, aunque existan                         
                        
                        
        process                 Procesa los archivos fuente, pero no los descarga.
                                                             
                                                            
        convert-to-json         Convierte todos los archivos .csv almacenados en /data a .json.

           
        update                  Actualiza el archivo datapackage.json                                                
                        
        
       


## Requisitos

* PHP 5.4+
* csvkit 1.0.0

### csvkit

Para poder generar los archivos en `.json`, hay que tener instalado [csvkit](https://csvkit.readthedocs.org/en/540/index.html). Para este script se ha usado la version 1.0.0.

 
Se instala mediante:

    $ sudo pip install csvkit


 
Así mismo, `pip` tiene que estar instalado. En Ubuntu esto se hace mediante:

    $ sudo apt-get install python-pip python-dev build-essential 
    $ sudo pip install --upgrade pip 
    $ sudo pip install --upgrade virtualenv 