<?php

require __DIR__."/vendor/autoload.php";

$metodo = $_SERVER['REQUEST_METHOD'];
$caminho = $_SERVER['PATH_INFO'] ?? '/';

#use Php/Primeiroprojeto\Router

$r = new Php\Primeiroprojeto\Router($metodo, $caminho);

#ROTAS

$r->get('/olamundo', function (){
    return "Olá mundo!";
} );

$r->get('/olapessoa/{nome}', function($params){ 
    return 'Olá'.$params[1]; 
} );

#ROTAS

$r->get('/exer1/formulario', function(){
    include("exer1.html");
});

$r->post('/exer1/resposta', function(){
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $soma = $valor1 + $valor2;
    return "A soma é: {$soma}";
});

#ROTAS

# Exercício 1

$r->get('/exercicio1/verificarnumero', function(){
    include("exercicio1.html");
});

$r->post('/exercicio1/verificarnumero', function(){
    $numero = $_POST["numero"];
    if ($numero > 0) {
        echo "Valor positivo";
    } elseif ($numero < 0) {
        echo "Valor negativo";
    } else {
        echo "Igual a zero";
    }
});

# Exercício 2

$r->get('/exercicio2/imprimirvalor', function(){
    include("exercicio2.html");
});

$r->post('/exercicio2/imprimirvalor', function(){
    $numeros = $_POST["numeros"];
    $menor = min($numeros);
    $posicao = array_search($menor, $numeros) + 1;
    return "Menor valor: $menor, posição: $posicao";
});

# Exercício 3

$r->get('/exercicio3/calcularsoma', function(){
    include("exercicio3.html");
});

$r->post('/exercicio3/calcularsoma', function(){
    $valor1 = $_POST["valor1"];
    $valor2 = $_POST["valor2"];
    $soma = $valor1 + $valor2;
    if ($valor1 == $valor2) {
        return "O triplo da soma é: " . ($soma * 3);
    } else {
        return "A soma é: $soma";
    }
});

#ROTAS

$resultado = $r->handler();

if(!$resultado){
    http_response_code(404);
    echo "Página não encontrada!";
    die();
}

echo $resultado($r->getParams());
