<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

#  Proyecto FullStack PHP
Este proyecto implementa tres servicios RESTful en PHP utilizando el framework Laravel, con el objetivo de gestionar clientes y cumplir con ciertos requisitos funcionales y de seguridad.

## Requisitos del Proyecto

###  Registro de Usuario:
Se registra un usuario para poder gestionar consultas y creacion de clientes por medio de tokens con los campos.
Se realizan validaciones para asegurar que el registro cumple con los requisitos.
Tener en cuenta que al migrar a la base de datos se inserta en la tabla **users** un registro con datos de un usuario de prueba.

###  Registro de Customers:
Se registra la información de un cliente, asociando la **commune y region**.
Se realizan validaciones para asegurar que el registro cumple con los requisitos.
Tener en cuenta que al migrar a la base de datos se insertan en las tablas **commune y region** registros con datos de un region como **provincias y commune** como **locaclidades** de **ARG**.

###  Consulta de Customers por dni o email:
Se consultan los clientes activos por dni o email.
Se retornan ( name, last_name, address (o null si no tiene), description region y description commune ).
Se aplican validaciones pertinentes.

###  Eliminación lógica del Customer:
Se elimina lógicamente un cliente activo e inactivo, cambiando su estado a (trash).
Se valida la existencia del cliente y su estado.
Retorna un mensaje indicando si se realizó la eliminación correctamente.

###  Respuestas de Servicios:
Cada servicio retorna, además de la información solicitada, un campo success indicando si se ejecutó correctamente (true) o sino (false).

### Autenticación y Token:
Se implemento un servicio de **autenticación personalizado** para poder generar un token con **SHA1** al iniciar sesión.
El token contiene información encriptada como email, fecha, hora y un número aleatorio entre 200 y 500, se utiliza en otros servicios y se valida su vigencia.
Tener en cuenta que en el archivo **.env.example** incluye una variable **PERSONAL_ACCESS_TOKEN_LIFETIME** que permite modificar el tiempo de caducidad del token en segundos.

### Logs de Entrada y Salida:
Se manejan logs de entrada y salida de información.
Se indica la IP de origen de la información.
Se puede configurar en el archivo **.env** si se deben guardar o no los logs de salida.

###  Entorno de Producción:
Existe un parámetro **APP_DEBUG** en el archivo **.env.**
Si está en false, se desactivan los logs de salida y solo se guardan los de entrada.
Tener en cuenta que esto esta armado como middleware con el nombre de **LogRequest y LogResponse** donde utilizan el modelo **RequestResponseLog** de la tabla **request_response_logs**.

##  Instrucciones de Uso:

### Instalación:
Clona el repositorio desde GitHub.

Antes de continuar tener en cuenta que este proyecto está desarrollado en Laravel 9, por lo que se recomienda tener **"php": "^8.0"**  y tambien contar con la ultima version de **Composer** en tu S.O.

Abre una terminal en la raíz del proyecto y ejecuta el siguiente comando para instalar las dependencias:
```bash
$ composer install 
```

Configura el archivo **.env** con la información de tu base de datos y ajusta los demás parámetros según tu entorno utilizando como ejemplo el **.env.example**.

### Migraciones y Semillas:
Ejecuta: 

```bash
$ php artisan migrate 
```
para crear las tablas en la base de datos y a la vez se insertan registros en las tablas **users, regions y **communes**.

### Inicio del Servidor:
Ejecuta el siguiente comando para iniciar el servidor local.

```bash
$ php artisan serve
```

### Registra un Nuevo Usuario:

Para poder realizar consultas con token para acceder a los endpoint con seguridad debe crear primero un usuario enviando por body (name, email, password). 
- **(metodo: post, path: /api/register-user)**
Tener en cuenta que se encuentra un registro de usuario de prueba en la tabla users para loguearse **email: usuario@usuario.com, password: pass1234**.


###  Autenticación:
Utiliza el servicio de autenticación para obtener un token enviando por body (email y password). 
- **(metodo: post, path: /api/login)**
Esto retornara un token para luego utilizarlo en las rutas con seguridad.

### Consumo de Servicios:
Utiliza los siguientes servicios implementados proporcionando el token de autenticación en las cabeceras de las peticiones.
Tener en cuenta que si utilizo el **.env.example** como ejemplo. La variable **PERSONAL_ACCESS_TOKEN_LIFETIME** tiene 60 segundos de tiempo para que luego caduque el token.
- **(metodo: post:, path: /api/logout)**

- **(metodo: get:, path: /api/customer-info)** body (dni o email).

- **(metodo: post:, path: /api/register-customer)** body (dni, email, name, last_name, address (puede ser opcional), id_com, id_reg, status (es opcional, por defecto en DB es A)).

- **(metodo: delete:, path: /api/delete-customer) body (dni).**

## Notas Adicionales

- **Uso de Postman:** He utilizado Postman para probar los servicios RESTful implementados. En la carpeta raíz del proyecto, encontrarás un archivo exportado con los endpoints utilizados durante el desarrollo. Puedes [importar este archivo en Postman](tests/Proyecto%20Entrevista.postman_collection.json) para tener acceso rápido a las rutas implementadas.

- Archivo Postman: [tests/Proyecto Entrevista.postman_collection.json](tests/Proyecto%20Entrevista.postman_collection.json)

## Estructura Técnica del Proyecto

Este proyecto sigue una estructura organizada y utiliza varias técnicas y patrones para garantizar su mantenibilidad y escalabilidad. A continuación, se describen algunos aspectos técnicos clave:

### API y Controlador

La lógica de la aplicación se organiza a través de una API RESTful implementada en Laravel. Los controladores son responsables de manejar las solicitudes HTTP y gestionar la lógica de negocio correspondiente. En particular, se hace un uso extensivo de form requests personalizados para validar y formatear las solicitudes de manera coherente. Además, se definen reglas específicas en estos form requests para garantizar la integridad de los datos.

### Interfaces y Repositorios

La capa de acceso a datos se abstrae utilizando interfaces y repositorios. Cada entidad principal del sistema (por ejemplo, User, Customer) tiene su propia interfaz y su implementación de repositorio correspondiente. Estas interfaces permiten un desacoplamiento eficiente entre la lógica de negocio y el almacenamiento de datos.

En algunos casos, se utilizan form requests personalizados incluso en la capa de repositorio e interfas para controlar la validación de las solicitudes de manera más específica. Además, en determinados escenarios, se implementan respuestas personalizadas para ajustar el formato de las respuestas de la API según los requisitos.

### Middleware

El manejo de tokens de autenticación y el registro de logs de entrada y salida se realizan mediante middleware personalizados. Estos middleware permiten extender las funcionalidades del sistema de manera modular y centralizada. El middleware de autenticación asegura la validez y vigencia de los tokens antes de procesar las solicitudes, mientras que el middleware de logs registra la información relevante sobre las peticiones y respuestas.

Esta estructura técnica busca promover la reutilización del código, la legibilidad y la escalabilidad del proyecto, siguiendo las mejores prácticas de desarrollo en Laravel.

### Por otro lado

Tambien tengo mucha experiencia con VUE 3 en el lado del frontend, por lo cual con un día o dos mas, podria realizar el proyecto para que consuma las api del backend con las validaciones y manejo de errores. Con un entorno familiar para que se pueda utilizar.

Y tambien e realizado proyectos con NODEJS y TypeScript en el backend.

¡Gracias por hacerme participar en la prueba de entrevista!

- [Mi Linkedin](https://linkedin.com/in/gaston-secanell-126bb4260).
- [Mi email personal](mailto:gastonsecanell@gmail.com).