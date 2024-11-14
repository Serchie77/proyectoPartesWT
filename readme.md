<h1><center> WORKTRACK · Partes y Horas de Trabajos de Proyectos </center> </h1>

### PRIMER PROYECTO SOBRE PARTES DE TRABAJO PARA UNA EMPRESA. FUNCIONAL PARA ROL DE ADMINISTRADOR Y ROL DE USUARIO.
### REALIZADO EN LOS SIGUIENTES LENGUAJES:
* HTML
* CSS
* JAVASCRIPT
* PHP
* BOOTSTRAP
- NO SE USA NINGÚN FRAMEWORK.

## Esquema o estructura del proyecto:
```
proyectoPartesWT/
│
├── assets/
│   ├── css/
│   │   └── (estilos Bootstrap y Fontawesome)
│   ├── img/
│   │   └── (imágenes)
│   └── js/
│       └── (scripts JavaScript Bootstrap)
│  
├── bd/
│   └── partes2024.sql
│
├── config/
│   └── conexion.php
│
├── models/
│   ├── clientes/
│   │   └── clientes.php (y todos los archivos para realizar el CRUD)
│   ├── usuarios/
│   │   └── usuarios.php (y todos los archivos para realizar el CRUD)
│   ├── proyectos/
│   │   └── proyectos.php (y todos los archivos para realizar el CRUD)
│   ├── partes/
│   │   └── partes.php (y todos los archivos para realizar el CRUD)
│   ├── horas/
│   │   └── horas.php (y todos los archivos para realizar el CRUD)
│   │ 
│   ├── headerAdmin.php
│   │
│   ├── headerUser.php
│   │
│   └── footer.php
│
├── index.php
├── sesion.php
├── cierreSesion.php
├── adminHome.php
├── userHome.php
├── consultaDatos.php
└── estilos.css
```

### Explicación de la estructura:

### ***index.php:***
- La página de ***inicio de sesión*** donde los usuarios ingresarán sus credenciales y si no la tienen pueden enviar un mail a la empresa para añadirlo a la base de datos.

![](https://github.com/Serchie77/proyectoPartesWT/blob/main/imgWebApp/INICIO-ACCESO.png)

### ***sesion.php:***
-  Página donde comprueba las credenciales de los roles para distribuirlos a los usuarios como ***administrador*** o usuario ***trabajador***.

### ***adminHome.php:***
- En esta página se incluye todo lo que puede realizar el administrador, realizar **CRUD** con todos los ***usuarios, clientes, proyectos, etc***.

![](https://github.com/Serchie77/proyectoPartesWT/blob/main/imgWebApp/admin.png)


### ***userHome.php:***
- En esta página se incluye todo lo que puede realizar el usuario trabajador, realizar **CRUD** con sus ***partes y horas***.

![](https://github.com/Serchie77/proyectoPartesWT/blob/main/imgWebApp/usuario.png)

### ***cierreSesion.php:***
- Con esta página se inhabilita la sesión mediante un enlace en las páginas ***adminHome.php*** y ***userHome.php*** para volver a la página inicial.

**assets/:**
- Aquí se encuentran todos los archivos estáticos, como ***hojas de estilo (CSS)***, ***imágenes usadas en el proyecto*** y scripts ***JavaScript***.

**config/:**
- Esta carpeta contiene el archivo conexion.php para la **conexión a la base de datos**.

**models/:**
- Esta carpeta contiene los archivos específicos para realizar los CRUD de todas las secciones como **clientes**, **proyectos**, **usuarios**, **partes**, **horas** e ***inicio*** como resumen.

![](https://github.com/Serchie77/proyectoPartesWT/blob/main/imgWebApp/admin-clientes-nuevo.png)
![](https://github.com/Serchie77/proyectoPartesWT/blob/main/imgWebApp/admin-partesAgregar.png)
![](https://github.com/Serchie77/proyectoPartesWT/blob/main/imgWebApp/admin-horasEdicion.png)

**bd/:**
- Esta carpeta contiene el archivo copia de **sql de la base de datos**.



## ACCESO COMO ADMIN
- De momento, único usuario
```
Usuario: sergioadmin

Contraseña: sergioadmin123
```

## ACCESO COMO USUARIOS (Estos son algunos usuarios de prueba)
- Los usuarios son trabajadores de la empresa

```
Usuario: pepevema
Contraeña: pevema123
```

```
Usuario: manupegil
Contraeña: manuelpg123
```

```
Usuario: robertogama
Contraeña: rogama123
```

### PROYECTO PENDIENTE DE MEJORAS FUTURAS...
