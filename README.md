# Para el correcto funcionamiento del proyecto:
1. Instalar servidor NodeJS, Apache y MySql.
2. Montar un servidor Apache con los archivos del comprimido “ProyectoCardiet.rar”.
3. Importar el archivo “fwpedrosa.sql” en el servidor MySql.
4. Dentro de la carpeta “cardiet/javascript/Chat", ejecutar el comando en consola : “npm install”.
5. Dentro de esta misma carpeta, ejecutar el comando en consola: “npm start”.
6. Para poder utilizar todas las funciones correctamente, el dominio a utilizar deberá ser: “http://www.  cardiet  .es/”. En caso de usar otro diferente, se deberá modificar la línea 129 de “cardiet/aplicacion/vistas/plantilla/main”, y modificar el dominio por el deseado. En “cardiet/javascript/Chat/src/index.js”, realizar el mismo proceso en la línea 5, y en “cardiet/javascript/Chat/public/index.html”, en la línea 62.
Con todo esto, la aplicación web funcionará correctamente.
