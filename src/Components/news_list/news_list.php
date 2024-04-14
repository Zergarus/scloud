<?

$articles = new \Models\Article\Article();
if (isset($_GET["page"])) {
    $arResult = $articles->getPage($_GET["page"], 5);
} else {
    $arResult = $articles->getPage(1, 5);
}


if (isset($_GET["id"]) && $_GET["mode"] == "delete" && ctype_digit($_GET["id"])) {
    $a = new \Models\Article\Article($_GET["id"]);
    $a->removeArticle();
    header("Location: http://news/index.php", true, 301);
    exit();
}
?>

<div class="news_wrapper">
    <h1>Новостная лента</h1>
    <div class="news_list">
        <div class="add_user_button">
            <a href="/new-article/">
                <button>Добавить новость</button>
            </a>
        </div>
        <? foreach ($arResult as $id => $item): ?>
            <div class="news_element">
                <h2>
                    <a href="/detail/index.php?mode=detail&id=<?= $id ?>"
                       id="<?= $id ?>"><?= $item["ARTICLE_TITLE"] ?></a>
                </h2>
                <div class="news_text">
                    <p>
                        <?= $item["ARTICLE_ANNOUNCE"] ?>
                    </p>
                </div>
                <div class="edit_buttons">
                    <a href="/new-article/index.php?mode=edit&id=<?= $id ?>">Редактировать</a>
                    <a id="del" href="/index.php?mode=delete&id=<?= $id ?>">Удалить</a>
                </div>
            </div>
        <? endforeach; ?>
        <div style="text-align: center">
            <?php for ($pageNum = 1; $pageNum <= $articles->getPagesCount(5); $pageNum++): ?>
                <a href="/index.php<?= $pageNum === 1 ? '' : '?page=' . $pageNum ?>"><?= $pageNum ?></a>
            <?php endfor; ?>
        </div>
    </div>
</div>