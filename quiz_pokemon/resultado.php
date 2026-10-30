<?php
    $gabarito = [
        "op1" => [
            "correta" => "c",
            "resposta" => "Ember",
            "alternativas" => [
                "a" => "Metal Claw",
                "b" => "Flamethrower",
                "c" => "Ember",
                "d" => "Scratch",
                "e" => "Tackle"
            ]
        ],
        "op2" => [
            "correta" => "a",
            "resposta" => "Snivy",
            "alternativas" => [
                "a" => "Snivy",
                "b" => "Ekans",
                "c" => "Bulbasaur",
                "d" => "Treecko",
                "e" => "Bellsprout"
            ]
        ],
        "op3" => [
            "correta" => "b",
            "resposta" => "Nidoran ♀",
            "alternativas" => [
                "a" => "Nidoran ♂",
                "b" => "Nidoran ♀",
                "c" => "Nidorino",
                "d" => "NIdorina",
                "e" => "Nidorana"
            ]
        ],
        "op4" => [
            "correta" => "d",
            "resposta" => "S.S Anne",
            "alternativas" => [
                "a" => "s.s.anne",
                "b" => "S.S anne",
                "c" => "SS Ane",
                "d" => "S.S Anne",
                "e" => "S.S Anna"
            ]
        ],
        "op5" => [
            "correta" => "b",
            "resposta" => "Totodile, Cyndaquill, Chikorita",
            "alternativas" => [
                "a" => "Squirtle, Charmander, Bulbasaur",
                "b" => "Totodile, Cyndaquill, Chikorita",
                "c" => "Mudkip, Trecko, Torchic",
                "d" => "Oshawott, Tepig, Snivy",
                "e" => "Ash, Misty, Brock"
            ]
        ],
        "op6" => [
            "correta" => "e",
            "resposta" => "10",
            "alternativas" => [
                "a" => "5",
                "b" => "13",
                "c" => "14",
                "d" => "8",
                "e" => "10"
            ]
        ],
        "op7" => [
            "correta" => "d",
            "resposta" => "Equipe Rocket",
            "alternativas" => [
                "a" => "Equipe Instinto",
                "b" => "Nenhuma",
                "c" => "Equipe do Giovanni",
                "d" => "Equipe Rocket",
                "e" => "Equipe Anti-Pokémon"
            ]
        ],
        "op8" => [
            "correta" => "e",
            "resposta" => "8",
            "alternativas" => [
                "a" => "5",
                "b" => "1",
                "c" => "6",
                "d" => "7",
                "e" => "8"
            ]
        ],
        "op9" => [
            "correta" => "c",
            "resposta" => "Normal",
            "alternativas" => [
                "a" => "Veneno",
                "b" => "Adaptável",
                "c" => "Normal",
                "d" => "Lutador",
                "e" => "Inseto"
            ]
        ],
        "op10" => [
            "correta" => "a",
            "resposta" => "Sim",
            "alternativas" => [
                "a" => "Sim",
                "b" => "Não"
            ]
        ]
    ];

    $acertos = 0;
    $total = count($gabarito);
    $resultados = [];

    foreach($gabarito as $questao => $correta){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Erro: Você precisa responder todas as questões.");
        }

        $respostaUsuario = $_POST[$questao];

        //Não costumo fazer comentários, mas esse é meio importante, porque verifica se as respostas são válidas.
        if (!in_array($respostaUsuario, ["a", "b", "c", "d", "e"], true)) {
            die("Erro: Resposta inválida!");
        }

        $acertou = ($respostaUsuario === $correta["correta"]);
        if($acertou) {
            $acertos++;
        }

        $resultados[] = [
            "questao" => $questao,
            "acertou" => $acertou,
            "respostaUsuario" => $respostaUsuario,
            "textoUsuario" => $correta["alternativas"][$respostaUsuario],
            "respostaCorreta" => $correta["resposta"],
            "letraCorreta" => strtoupper($correta["correta"])
        ];
    }

    $porcent = ($acertos/$total)*100;

    if ($acertos <= 2) {
    $classificacao = "Iniciante";
    $mensagem = "Parece que sua jornada Pokémon está apenas começando!";
    }
    elseif ($acertos <= 4) {
        $classificacao = "Aprendiz";
        $mensagem = "Você conhece alguns Pokémon, mas ainda precisa treinar!";
    }
    elseif ($acertos <= 6) {
        $classificacao = "Treinador";
        $mensagem = "Boa! Você está no caminho certo!";
    }
    elseif ($acertos <= 8) {
        $classificacao = "Especialista";
        $mensagem = "Muito bom! Você conhece bastante sobre Pokémon!";
    }
    else {
        $classificacao = "Mestre Pokémon";
        $mensagem = "Impressionante! Você é um verdadeiro mestre Pokémon!";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, initial-scal=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Resultados</title>
</head>
<body>
    <div id=menu>
        <h1>OS RESULTADOS</h1>
        <br>

        <h2>Acertos: <?php echo number_format($acertos);?> de <?php echo number_format($total);?> questões</h2>
        <h2>Porcentagem de acertos: <?php echo number_format($porcent);?>&percnt;</h2>
        <br>
        <div class="analise">
            <h4>Análise final: <?= htmlspecialchars($classificacao); ?></h2>
            <p>
                <?= htmlspecialchars($mensagem); ?>
            </p>
        </div>
        
        <br><hr>

        <h2>Correção</h2>
        <?php foreach($resultados as $resultado) { ?>
            <div class="resultado_questao">
                <h3>QUESTÃO <?= (int) substr($resultado["questao"], 2); ?></h3>

                <?php if($resultado["acertou"]){?>
                    <p class="acerto">Você acertou! Muito bem!</p>
                

                <?php }else {?>
                    <p class="erro">Você errou, mas não se preocupe!</p>
                    
                    <p>Alternativa marcada: <strong><?= strtoupper(htmlspecialchars($resultado["respostaUsuario"])); ?> -  <?= htmlspecialchars($resultado["textoUsuario"]);?></strong></p>
                    <p>Alternativa correta: <strong><?= htmlspecialchars($resultado["letraCorreta"]); ?> - <?= htmlspecialchars($resultado["respostaCorreta"]);?><?php?> </strong></p>
                <?php }?>
            </div>
            <br>
        <?php }?>
        <a href="index.html" id="voltar">Voltar</a>
    </div>
</body>
</html>
