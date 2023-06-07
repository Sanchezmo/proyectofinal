Manual de despliegue.

1 Copiar todos los archivos a la carpeta de su servidor. VAR/WWW/HTML
2 Crear la base de datos para la aplicación, deberá ejecutar el script sql de la carpeta bd en su base de datos.
3 Modificar configuracion.php , este archivo contiene las variables esenciales para el funcionamiento de funciones:
    -Aceso a la base de datos y su contraseña
    -Dominio del servidor para el servicio de comprobaciones de nuevos usuarios.
    -Cuenta de correo para el servicio de mailer y su contraseña
    -tipo de servidor de correo.
4 Deberá instalar las dependencias de PHPMailer através de Composer. el archivo composer.json ya está configurado
    -ejecute en el terminal de la carpeta donde está el archivo json el siguente comando: composer install 
    -si no tiene composer instalado puede descargarlo de la página oficial de Composer o através de la consola con 
    el comando: sudo apt-get install composer.

Muchas gracias si tiene alguna duda puede contactar al correo: psmoran87@gmail.com
