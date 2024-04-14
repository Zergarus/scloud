<?
if (empty($_POST)) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

if (is_countable($_POST)) {
    if ($_POST["mode"] == "create") {
        $article = new \Models\Article\Article();
        $article->addArticle($_POST);
    } elseif (ctype_digit($_GET["id"])) {
        $article = new \Models\Article\Article($_GET["id"]);
        $article->updateArticle($_POST);
    }

}
$edtiMode = false;
if (isset($_GET["mode"]) ?? $_GET["mode"] == "edit" && ctype_digit($_GET["id"])) {
    $edtiMode = true;
    $article = new \Models\Article\Article($_GET['id'], $_GET["mode"]);
    $arResult = $article->getArticleById();
}


?>
<? if ($edtiMode) { ?>
    <div class="news_wrapper">
        <h1>Добавить новость</h1>
        <div class="news_list">
            <div class="form">
                <form id="form" mode="edit">
                    <div class="input">
                        <label for="title">Название</label>
                        <input id="title" type="text" value="<?= $arResult["ARTICLE_TITLE"] ?>">
                    </div>
                    <div class="input">
                        <label for="announce">Анонс</label>
                        <textarea id="announce"><?= $arResult["ARTICLE_ANNOUNCE"] ?></textarea>
                    </div>
                    <div class="input">
                        <label for="text">Текст</label>
                        <textarea id="text"><?= $arResult["ARTICLE_TEXT"] ?></textarea>
                    </div>
                    <div class="add_user_button">
                        <button type="submit">Сохранить новость</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<? } else { ?>
    <div class="news_wrapper">
        <h1>Добавить новость</h1>
        <div class="news_list">
            <div class="form">
                <form id="form" mode="create">
                    <div class="input">
                        <label for="title">Название</label>
                        <input id="title" type="text" value="">
                    </div>
                    <div class="input">
                        <label for="announce">Анонс</label>
                        <textarea id="announce"></textarea>
                    </div>
                    <div class="input">
                        <label for="text">Текст</label>
                        <textarea id="text"></textarea>
                    </div>
                    <div class="add_user_button">
                        <button type="submit">Сохранить новость</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<? } ?>
<script type="module">

    const form = document.getElementById("form");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        let title = document.getElementById("title").value;
        let announce = document.getElementById("announce").value;
        let text = document.getElementById("text").value;
        let createForm = form.getAttribute("mode")

        const url = window.location.href;
        const data = {
            title: title,
            announce: announce,
            text: text,
            mode: createForm,
        };

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(() => window.location.replace("http://news/index.php"));
    });

</script>