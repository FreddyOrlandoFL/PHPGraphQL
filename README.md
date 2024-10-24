# GraphQL API con PHP

Este proyecto implementa una API GraphQL utilizando PHP y la librería [webonyx/graphql-php](https://github.com/webonyx/graphql-php).

<p align="center">
  <img src="https://www.php.net/images/logos/new-php-logo.svg" alt="PHP Logo" width="120" />
  <img src="https://upload.wikimedia.org/wikipedia/commons/1/17/GraphQL_Logo.svg" alt="GraphQL Logo" width="120" />
</p>

## Requisitos

- PHP >= 7.4
- Composer instalado

## Instalación

### Paso 1: Clonar el repositorio

Clona este repositorio en tu máquina local:

```bash
git clone https://github.com/usuario/nombre-del-proyecto.git
cd nombre-del-proyecto

```

### Paso 2: Instalar dependencias
### Este proyecto utiliza la librería graphql-php. Para instalarla, asegúrate de tener Composer instalado y ejecuta el siguiente comando:

```bash
composer require webonyx/graphql-php
```

### Paso 3: Configuración del servidor
### Si utilizas un servidor local, puedes configurarlo para servir el archivo principal de la API. Por ejemplo, si tu punto de entrada es public/index.php, configura el servidor para apuntar a ese archivo.

### Paso 4: Ejecución de la API
### Asegúrate de que el servidor web esté configurado correctamente y funcionando. Ahora puedes acceder a tu API GraphQL en la URL que hayas configurado (por ejemplo, http://localhost/graphql).

### Paso 5: Ejemplo de Query
### Una vez que la API esté en funcionamiento, puedes hacer una query de prueba a través de tu cliente GraphQL preferido (como GraphiQL):

```bash
    {
    hello
    }
```
### Estructura del Proyecto
```bash
    src/ - Contiene las clases y resolvers de GraphQL.
    public/ - Contiene el punto de entrada de la API (por ejemplo, index.php).
    composer.json - Archivo de configuración para Composer.
```


### Ejemplo de uso
### En tu punto de entrada (public/index.php), puedes definir un esquema básico de GraphQL de la siguiente manera:
```bash
    <?php
        require 'vendor/autoload.php';

        use GraphQL\Type\Definition\ObjectType;
        use GraphQL\Type\Definition\Type;
        use GraphQL\Schema;
        use GraphQL\GraphQL;

        $schema = new Schema([
            'query' => new ObjectType([
                'name' => 'RootQueryType',
                'fields' => [
                    'hello' => [
                        'type' => Type::string(),
                        'resolve' => function() {
                            return 'Hola Mundo';
                        }
                    ]
                ]
            ])
        ]);

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'];

        $result = GraphQL::executeQuery($schema, $query);
        $output = $result->toArray();

        header('Content-Type: application/json');
        echo json_encode($output);
```