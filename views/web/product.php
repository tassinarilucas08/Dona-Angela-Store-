<?php
 $this->layout("_theme",[
    "title" => "Produto"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url("/assets/web/css/product.css") ?>">
    <script src="<?= url("/assets/web/js/product.js") ?>" defer></script>
</head>
<body>
<div class="produto-container">
        <button type="button" class="btn-voltar" onclick="window.history.back()">← Voltar</button>

        <div class="produto-info">
            <div class="imagem-produto">
                <button class="prev" onclick="changeImage(-1)">&#10094;</button>

                <img id="product-image" src="" alt="Produto">

                <button class="next" onclick="changeImage(1)">&#10095;</button>

                <div class="indicators" id="indicators"></div>
            </div>

            <div class="texto-produto">
                <h1 class="nome-produto" id="product-name"></h1>
                <p class="preco-produto" id="product-price"></p>
                <p class="descricao-produto" id="product-description"></p>
                <button class="btn-adicionar" type="button"onclick="handleAddToCart()">Adicionar ao Carrinho</button>

            </div>
        </div>

        <h1><b>Produtos Relacionados</b></h1>
        <section class="products-related" id="related">
            <div class="product-card">
                <span class="tag tag-natura">Natura</span>
                <img src="/Dona-Angela-Store-/images/perfums/biografia.jpg" alt="Produto Natura Biografia">
                <div class="product-infos">
                    <h2>Biografia</h2>
                    <p>Uma fragrância atemporal</p>
                    <div class="product-price">
                        <span class="normal">R$ 69,90</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="feedback-produto">
            <h2>Avaliações</h2>
            <div class="resumo-avaliacoes">
                <div class="estrelas-media">
                    <span class="estrela-avaliada">★★★★★</span>
                    <span class="nota">4.8 / 5</span>
                </div>
                <p class="recomendacao"><strong>97%</strong> dos clientes recomendam este produto</p>
        
                <div class="barras-avaliacao">
                    <div class="barra"><span>5 Estrelas</span><div class="grafico" style="width: 90%;"></div><span>98</span></div>
                    <div class="barra"><span>4 Estrelas</span><div class="grafico" style="width: 20%;"></div><span>9</span></div>
                    <div class="barra"><span>3 Estrelas</span><div class="grafico"></div><span>0</span></div>
                    <div class="barra"><span>2 Estrelas</span><div class="grafico"></div><span>0</span></div>
                    <div class="barra"><span>1 Estrela</span><div class="grafico" style="width: 5%;"></div><span>2</span></div>
                </div>
            </div>

            <div class="escrever-avaliacao">
                <h3>Deixe sua avaliação</h3>
            
                <label for="nota">Nota:</label>
                <select id="nota" name="nota">
                    <option value="5">★★★★★ - Excelente</option>
                    <option value="4">★★★★☆ - Muito bom</option>
                    <option value="3">★★★☆☆ - Bom</option>
                    <option value="2">★★☆☆☆ - Regular</option>
                    <option value="1">★☆☆☆☆ - Ruim</option>
                </select>
            
                <label for="comentario">Comentário:</label>
                <textarea id="comentario" name="comentario" rows="4" placeholder="Escreva aqui seu comentário..."></textarea>
            
                <button type="button" id="avaliar">Enviar avaliação</button>
            </div>
        
            <div class="avaliacao-detalhada">
                <div class="avaliacao">
                    <p><strong>Juliana M.</strong> ★★★★★</p>
                    <p class="localdata">14/05/2025</p>
                    <p>Esse perfume é maravilhoso! Tem cheiro de elegância e dura o dia todo na pele. Comprei pela primeira vez e já quero outro!</p>
                </div>
        
                <div class="avaliacao">
                    <p><strong>Marcos L.</strong> ★★★★☆</p>
                    <p class="localdata">14/05/2025</p>
                    <p>Gostei bastante da fragrância, é suave e marcante ao mesmo tempo. Só não dou 5 estrelas porque achei o preço um pouco elevado.</p>
                </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>