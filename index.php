<?
include 'templates/header.php';
require 'server/db/db.php';
require 'servidor/create_user.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="creator" content="Kauan Cybis, Daniel Craveiro">
    <!--ses esses dois transar eu mando eles toma no cu-->
    <!--mn ses vcs termina eu bato nos dois namoral-->
    <title>Bagmon ShowUp - Beta</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
       /*
       SE PA ESSE BAGULHO DA FONTE NEM FUNCIONA POREM TO DEIXANDO PRA NAO CAUSAR PROBLEMA
       */
       @font-face {
            font-family: 'FontAwesome';
            src: url('/theme/fonts/fontawesome-webfont.eot?v=4.0.3');
            src: url('/theme/fonts/fontawesome-webfont.eot?#iefix&v=4.0.3') format('embedded-opentype'), url('/theme/fonts/fontawesome-webfont.woff?v=4.0.3') format('woff'), url('/theme/fonts/fontawesome-webfont.ttf?v=4.0.3') format('truetype'), url('/theme/fonts/fontawesome-webfont.svg?v=4.0.3#fontawesomeregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: Verdana, Helvetica, sans-serif;
        }

        .nav {
            /*position: fixed;*/
            top: 0;
            width: 100%;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Alinha verticalmente no centro */
            padding: 10px;
            font-family: Verdana, Helvetica, sans-serif;
        }

        .nav h1 {
            font-size: 16px;
            margin-right: 20px; /* Espaçamento entre o h1 e os botões */
            font-family: Verdana, Helvetica, sans-serif;
        }

        nav {
            display: flex;
            align-items: center; /* Alinha verticalmente no centro */
        }

        nav button, nav a {
            margin: 0 0px; /* Espaçamento entre os botões */
        }

        button {
            background-color: rgba(180, 180, 180, 0.219); /* Cor do fundo do botão */
            color: rgb(0, 0, 0); /* Cor do texto do botão */
            font-family: Verdana, Helvetica, sans-serif;
            padding: 10px 20px; /* Espaçamento interno do botão */
            border: 1px solid black; /* Borda preta */
            cursor: pointer; /* Cursor do mouse quando sobre o botão */
            font-size: 16px; /* Tamanho da fonte */
        }

        button:hover {
            background-color: rgba(180, 180, 180, 0.096); /* Cor do botão ao passar o mouse */
        }

        button#home {
            border-radius: 10px 0 0 10px; /* Arredondar a ponta esquerda */
        }

        button#ladder {
            border-radius: 0 10px 10px 0; /* Arredondar a ponta direita */
        }

        button#play {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            background-color: green;
            margin: 0 10px;
            border-radius: 10px;
        }

        button#play:hover {
            background-color: rgb(0, 155, 0);
        }

        /*
        configuração de css do link de logout
        nav a {
            text-decoration: none;
            color: black;
            padding: 10px 20px;
            border: 1px solid black;
            border-radius: 10px;
        }

        nav a:hover {
            background-color: rgba(180, 180, 180, 0.096);
        }
        */
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .modal-content input,
        .modal-content select {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
        }

        /*container de jogar ou baixar o jogo*/
        .container {
            width: 300px; /* Largura do contêiner */
            background-color: #f8f9fa; /* Cor de fundo do contêiner */
            border: 1px solid black; /* Borda preta */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sombra para o contêiner */
            padding: 10px;
            border-radius: 10px;
            box-sizing: border-box; /* Inclui padding e borda na largura e altura */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .forml {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .content {
            display: flex;
            align-items: center; /* Alinha os itens verticalmente no centro */
            margin-bottom: 10px; /* Espaçamento abaixo do conteúdo */
        }

        .video {
            width: 100px; /* Largura do vídeo */
            height: 100px; /* Altura do vídeo */
            margin-right: 10px; /* Espaçamento à direita do vídeo */
        }

        .description {
            font-size: 12px; /* Tamanho da fonte pequena */
            text-align: left; /* Alinhamento do texto à esquerda */
        }

        #play-online {
            background-color: #3a813c; /* Cor do fundo do botão */
            color: white; /* Cor do texto do botão */
            padding: 10px 20px; /* Espaçamento interno do botão */
            border: 2px solid rgba(0, 0, 0, 0); /* Borda preta */
            cursor: pointer; /* Cursor do mouse quando sobre o botão */
            font-size: 16px; /* Tamanho da fonte */
            border-radius: 10px; /* Bordas arredondadas */
            margin-bottom: 10px; /* Espaçamento abaixo do botão */
        }

        #play-online:hover {
            background-color: #45a049; /* Cor do botão ao passar o mouse */
        }

        span {
            font-size: 14px; /* Tamanho da fonte do texto "or" */
        }
        #download-game {
            color: blue;
            font-size: 10px;
        }
        /*CSS NOVO*/
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container2 {
            width: 600px;
            background-color: #cacaca;
            border: 1px solid rgba(0, 0, 0, 0);
            /*box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);*/
            border-radius: 10px;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 20px; /* Espaçamento entre container2 e container3 */
        }
        .container2 form {
            display: flex;
            flex-direction: row; /* Alinha os botões horizontalmente */
            justify-content: space-between; /* Espaço igual entre os botões */
        }
        .container2 button {
            margin: 0 5px;
            background-color: #e4e4e4;
            color: rgba(0, 4, 255, 0.616);
        }
        .container3 {
            width: 300px;
            background-color: #f8f9fa;
            border: 2px solid black;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            padding: 10px;
            box-sizing: border-box;
        }

        .container3 h1 {
            text-align: center;
            margin: 0;
            font-size: 11pt;
        }

        .servidores {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .servidores div {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="nav">
        <h1>Bagmon ShowUp - beta</h1>
        <nav>
            <button id="home" src="http://localhost/PokemonMMO/index.php">home</button>
            <button id="bagdex" src="">Bagdéx</button>
            <button id="replays">Replays</button>
            <button id="ladder">Ladder</button>
            <br>
            <button id="play">Play</button>
            <!--<a href="server/db/logout.php">Logout</a>-->
        </nav>
    </div>
<br><br><br>
    <div class="container"><!--container do video e apra jogar ou baixar o jogo-->
        <form action="" class="forml">
            <div class="content">
                <video class="video" src="" alt="Video de uma gameplay do jogo"></video>
                <p class="description">Bagmon ShowUp is a Bagmon battle Simulator. Play bagmon<br> battles online! Play with randomly<br> generated teams, or build your<br> own! Fully animated!<br></p>
            </div>
            <button id="play-online">Play online</button>
            <span>or</span>
            <a href="" id="download-game">Install (windows)</a>
        </form>        
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!--
/*
CASO PRECISE SO DO CODIGO DE CADA UM(NAO EXCLUIR PLSS)
Sobre algumas funções do jogo e namoral, fdp é meu amigo que deu a ideia de colocar pokemons brasileiros
.container2 {
    width: 300px; /* Largura do contêiner */
    background-color: #f8f9fa; /* Cor de fundo do contêiner */
    border: 2px solid black; /* Borda preta */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sombra para o contêiner */
    padding: 10px; /* Espaçamento interno do contêiner */
    box-sizing: border-box; /* Inclui padding e borda na largura e altura */
    display: flex; /* Usar flexbox para alinhamento */
    flex-direction: column; /* Alinha os itens verticalmente */
    align-items: center; /* Centraliza os itens horizontalmente */
    justify-content: center; /* Centraliza os itens verticalmente */
    margin: 0 auto; /* Centraliza o contêiner na tela */
}

.container2 form {
    display: flex; /* Usar flexbox para os botões */
    justify-content: space-between; /* Distribui espaço igual entre os botões */
    width: 100%; /* Faz o formulário ocupar toda a largura do contêiner */
    flex-wrap: wrap; /* Permite que os botões se movam para a próxima linha, se necessário */
}

button {
    flex: 1; /* Faz os botões ocuparem espaço igual */
    margin: 5px; /* Adiciona margem entre os botões */
    min-width: 90px; /* Largura mínima dos botões */
}

/* container para o servidores */
.container3 {
    width: 300px; /* Largura do contêiner */
    background-color: #f8f9fa; /* Cor de fundo do contêiner */
    border: 2px solid black; /* Borda preta */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sombra para o contêiner */
    padding: 10px; /* Espaçamento interno do contêiner */
    box-sizing: border-box; /* Inclui padding e borda na largura e altura */
    display: flex; /* Usar flexbox para alinhamento */
    flex-direction: column; /* Alinha os itens verticalmente */
    align-items: flex-start; /* Alinha os itens ao início do contêiner */
}

.container3 h1 {
    margin: 0; /* Remove a margem do título */
}

.servidores {
    display: flex; /* Usar flexbox para os servidores */
    flex-direction: column; /* Exibe os servidores na vertical */
    width: 100%; /* Faz o contêiner ocupar toda a largura */
}

.servidores div {
    display: flex; /* Usar flexbox para os textos dos servidores */
    justify-content: space-between; /* Distribui espaço entre o nome e outros elementos (se houver) */
    width: 100%; /* Faz cada servidor ocupar toda a largura */
    padding: 5px 0; /* Espaçamento vertical entre os servidores */
}
*/
HTML:
<div class="container2">
        <form action="">
            <button id="Damage calculator">Damage Calculator</button>
            <button id="Usage stats">Usage stats</button>
            <button id="github" src="">GitHub</button>
        </form>
    </div>

    <div class="container3">
        <h1>Server</h1>
        <hr>
        <div class="servidores" id="servidores">
             Exemplo de servidores -->
            <!--<div>Servidor 1</div>
            <div>Servidor 2</div>
            <div>Servidor 3</div>
        </div>
    </div>
-->
    <div class="main-container">
        <div class="container2">
            <form action="">
                <button id="Damage calculator">Damage Calculator</button>
                <button id="Usage stats">Usage stats</button>
                <button id="github" src="">GitHub</button>
            </form>
        </div>
<!--nao sei mais oq fazer pra essa bosta ficar no centro mn vou chorar-->
        <div class="container3"><!--em baio do container2-->
            <h1>Server</h1>
            <hr>
            <div class="servidores" id="servidores">
                <!-- Exemplo de servidores -->
                <div>Servidor 1</div>
                <div>Servidor 2</div>
                <div>Servidor 3</div>
            </div>
        </div>
    </div>
    <div class="container4"><!--container para o donate--><!--sua hora seu fdp-->
        <p>The project needs a<br> little more funding to<br> continue, if you like <br>the idea and would <br>like to participate,<br> support it financially. <br>ASS: Kauan Cybis</p>
    </div>
    <!--div para o painel de criaçao do personagem-->
    <div id="characterModal" class="modal">
        <div class="modal-content">
            <form method="post">
                <h2>Criar Personagem</h2>
                <input type="text" name="character_name" placeholder="Nome do Personagem" required>
                <select name="character_skin" required>
                    <option value="skin1">Personagem 1</option>
                    <option value="skin2">Personagem 2</option>
                    <option value="skin3">Personagem 3</option>
                </select>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('play').addEventListener('click', function() {
            document.getElementById('characterModal').style.display = 'flex';
        });
        window.onclick = function(event) {
            if (event.target == document.getElementById('characterModal')) {
                document.getElementById('characterModal').style.display = 'none';
            }
        }
    </script>
</body>
</html>