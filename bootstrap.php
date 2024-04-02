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

# Exercício 4

$r->get('/exercicio4/exibirtabuada', function(){
    include("exercicio4.html");
});

$r->post('/exercicio4/exibirtabuada', function(){
    $numero = $_POST["numero"];
    $tabuada = "";
    for ($i = 0; $i <= 10; $i++) {
        $tabuada .= "$numero X $i = " . ($numero * $i) . "\n";
    }
    return $tabuada;
});

# Exercício 5

$r->get('/exercicio5/calcularfatorial', function(){
    include("exercicio5.html");
});

$r->post('/exercicio5/calcularfatorial', function(){
    $numero = $_POST["numero"];
    $fatorial = 1;
    for ($i = $numero; $i >= 1; $i--) {
        $fatorial *= $i;
    }
    return "O fatorial de $numero é $fatorial";
});

# Exercício 6

$r->get('/exercicio6/imprimirvalorcrescente', function(){
    include("exercicio6.html");
});

$r->post('/exercicio6/imprimirvalorcrescente', function(){
    $a = $_POST["a"];
    $b = $_POST["b"];
    if ($a < $b) {
        return "$a $b";
    } elseif ($a > $b) {
        return "$b $a";
    } else {
        return "Números iguais: $a";
    }
});

# Exercício 7

$r->get('/exercicio7/convertermetrosemcentimentros', function(){
    include("exercicio7.html");
});

$r->post('/exercicio7/convertermetrosemcentimentros', function(){
    $metros = $_POST["metros"];
    $centimetros = $metros * 100;
    return "O valor em centímetros é: $centimetros";
});

# Exercício 8

$r->get('/exercicio8/quantidadedelatasdetintaevalor', function(){
    include("exercicio8.html");
});

$r->post('/exercicio8/quantidadedelatasdetintaevalor', function(){
    $area = $_POST["area"];
    $litros_tinta = ceil($area / 3);
    $latas = ceil($litros_tinta / 18);
    $preco_total = $latas * 80;
    return "Quantidade de latas de tinta necessárias: $latas. Preço total: R$ $preco_total";
});

# Exercício 9

$r->get('/exercicio9/formulariopessoa', function(){
    include("exercicio9.html");
});

$r->post('/exercicio9/formulariopessoa', function(){
    $ano_nascimento = $_POST["ano_nascimento"];
    $ano_atual = date("Y");
    $idade = $ano_atual - $ano_nascimento;
    $dias_vividos = $idade * 365;
    $idade_2025 = 2025 - $ano_nascimento;
    return "Idade: $idade anos. Dias vividos: $dias_vividos dias. Idade em 2025: $idade_2025 anos";
});

# Exercício 10

$r->get('/exercicio10/imcpessoa', function(){
    include("exercicio10.html");
});

$r->post('/exercicio10/imcpessoa', function(){
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];
    $imc = $peso / ($altura * $altura);
    if ($imc < 18.5) {
        $condicao = "Abaixo do peso";
    } elseif ($imc >= 18.5 && $imc < 24.9) {
        $condicao = "Peso normal";
    } elseif ($imc >= 24.9 && $imc < 29.9) {
        $condicao = "Sobrepeso";
    } else {
        $condicao = "Obesidade";
    }
    echo "<h2>Seu IMC é: $imc</h2>";
    echo "<p>Sua condição é: $condicao</p>";
});

#ROTAS

$resultado = $r->handler();

if(!$resultado){
    http_response_code(404);
    echo "Página não encontrada!";
    die();
}

echo $resultado($r->getParams());
