<html>
<head>
    <title>Новостной сайт</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
</head>

<body>


<?

function myAutoLoader(string $className)
{
    require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
}

spl_autoload_register('myAutoLoader');

$a = new \Models\Article\Article();
$arResult = $a->getArticle();

?>


<div class="news_wrapper">
    <h1>Новостная лента</h1>
    <div class="news_list">
        <? foreach ($arResult as $id => $item): ?>
            <div class="news_element">
                <h2>
                    <a href="#" id="<?= $id ?>"><?= $item["ARTICLE_TITLE"] ?></a>
                </h2>
                <div class="news_text">
                    <p>
                        <?= $item["ARTICLE_ANNOUNCE"] ?>
                    </p>
                </div>
            </div>
        <? endforeach; ?>
    </div>


</div>


</body>

</html>

