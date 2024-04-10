
<?
echo "<pre>";
var_dump($_REQUEST);
echo "</pre>";
?>

<div class="news_wrapper">
    <h1>Добавить новость</h1>
    <div class="news_list">
        <div class="form">
            <form id="edit_form">
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
                   <button id="but" type="submit">Добавить новость</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="module">

    const form = document.getElementById("edit_form");
    form.addEventListener("submit", async function (event){
        event.preventDefault();
        let title = document.getElementById("title").value;
        let announce = document.getElementById("announce").value;
        let text = document.getElementById("text").value;


        const url = "index.php";
        const data = {
            title: title,
            announce: announce,
            text: text,
        };

        await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

    });

</script>