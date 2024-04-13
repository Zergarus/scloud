<?php

namespace Models\Article;

class Article
{
    private $id;
    private $mode;

    public function __construct($id = 0, $mode = "list")
    {
        $this->id = $id;
        $this->mode = $mode;
        $this->db = new \mysqli("localhost", "root", "", "news");
    }

    public function getArticleById()
    {
        if ($this->id == 0 || $this->mode == "list") {
            http_response_code(404);
            die();
        }
        $arResult = [];

        $this->db->query("SET NAMES 'utf8'");
        $result = $this->db->query("SELECT * FROM news_list WHERE id=" . $this->id);

        if ($result->num_rows > 0) {
            while ($arArticle = $result->fetch_assoc()) {
                $arResult["ARTICLE_TITLE"] = $arArticle["title"];
                $arResult["ARTICLE_ANNOUNCE"] = $arArticle["announce"];
                $arResult["ARTICLE_TEXT"] = $arArticle["text"];
            }
        }


        return $arResult;
    }

    public function removeArticle()
    {

        $this->db->query("SET NAMES 'utf8'");

        $result = $this->db->query("DELETE FROM `news_list` WHERE id=" . $this->id);


    }

    public function updateArticle($data)
    {

        $this->db->query("SET NAMES 'utf8'");

        $asd = $this->db->query("UPDATE news_list SET title = " . $data["title"] . ", announce = " . $data["announce"] . ", text = " . $data["text"] . " WHERE id=" . $this->id);
        $log = date('Y-m-d H:i:s') . ' ' . print_r($asd, true);
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);

    }

    public function addArticle($data)
    {
        $this->db->query("SET NAMES 'utf8'");
        $result = $this->db->query("INSERT INTO `news_list` (`title`, `announce`, `text`) VALUES ('" . $data["title"] . "', '" . $data["announce"] . "', '" . $data["text"] . "')");
    }


    public function getPagesCount(int $itemsPerPage): int
    {
        $result = $this->db->query('SELECT COUNT(*) AS cnt FROM news_list')->fetch_array();
        return ceil($result["cnt"] / $itemsPerPage);
    }

    public function getPage(int $pageNum, int $itemsPerPage)
    {
        $arResult = [];

        $result = $this->db->query(
            sprintf(
                'SELECT * FROM `%s` ORDER BY id DESC LIMIT %d OFFSET %d;',
                "news_list",
                $itemsPerPage,
                ($pageNum - 1) * $itemsPerPage
            ),
        );
        if ($result->num_rows > 0) {
            while ($arArticle = $result->fetch_assoc()) {
                $arResult[$arArticle["id"]]["ARTICLE_TITLE"] = $arArticle["title"];
                $arResult[$arArticle["id"]]["ARTICLE_ANNOUNCE"] = $arArticle["announce"];
                $arResult[$arArticle["id"]]["ARTICLE_TEXT"] = $arArticle["text"];
            }
        }
        return $arResult;
    }
}