<?

$a = new \Models\Article\Article();
$arResult = $a->getArticles();

?>

<div class="news_wrapper">
    <h1>Новостная лента</h1>
    <div class="news_list">
        <? foreach ($arResult as $id => $item): ?>
            <div class="news_element">
                <h2>
                    <a href="/detail/index.php?mode=detail&id=<?=$id?>" id="<?= $id ?>"><?= $item["ARTICLE_TITLE"] ?></a>
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