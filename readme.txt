proyecto/
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


Explicación de la estructura:

· assets/: Aquí se encuentran todos los archivos estáticos, como hojas de estilo (CSS), imágenes y scripts JavaScript.
· config/: Esta carpeta contiene el archivo conexion.php para la conexión a la base de datos.
· models/: Esta carpeta contiene los archivos específicos para realizar los CRUD de todas las secciones como clientes, proyectos, usuarios, partes, horas e inicio como resumen.
· bd/: Esta carpeta contiene el archivo sql de la base de datos.
· index.php: La página de inicio de sesión donde los usuarios ingresarán sus credenciales.
· sesion.php: Página donde comprueba las credenciales de los roles para distribuirlos a los usuarios como administrador o usuario trabajador.
· adminHome.php: En esta página se incluye todo lo que puede realizar el administrador, realizar CRUD con todos los usuarios, clientes, proyectos, etc.
· userHome.php: En esta página se incluye todo lo que puede realizar el usuario trabajador, realizar CRUD con sus partes y horas.
· cierreSesion.php: Con esta página se inhabilita la sesión mediante un enlace en las páginas adminHome.php y userHome.php.


::::::::::::::::::::::::::::::::::::::::::::::::

* * ACCESO COMO ADMIN * *
sergioadmin
sergioadmin123

::::::::::::::::::::::::::::::::::::::::::::::::

* * ACCESO COMO USUARIOS * * Estos son algunos usuarios de prueba
Usuario1:::
pepevema
pevema123
--
Usuario2:::
manupegil
manuelpg123
--
Usuario3:::
robertogama
rogama123

