<?

$a = new \Models\Article\Article($_GET["id"], $_GET["mode"]);
$arResult = $a->getArticleById();

?>

<div class="news_wrapper">
    <h1>Новостная лента</h1>
    <div class="news_list">
        <div class="news_element">
            <h2>
                <?= $arResult["ARTICLE_TITLE"] ?>
            </h2>
            <div class="news_text">
                <p>
                    <?= $arResult["ARTICLE_TEXT"] ?>
                </p>
            </div>
        </div>
    </div>
</div>