<?php

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

require('types.php');
require('query.php');
require('mutations.php');


$schema = new Schema([
    'query' => $rootQuery,
    'mutation' => $rootMutation
]);



try{
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    
     // Check if 'query' exists in the input
     if (isset($input['query'])) {
        $query = $input['query'];
        $result = GraphQL::executeQuery($schema, $query);
        $output = $result->toArray();
    } else {
        // Handle missing or invalid query
        throw new \Exception('No query provided.');
    }
}catch(\Exception $e){
    $output = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($output);