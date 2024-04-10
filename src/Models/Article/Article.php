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
    }

    public function getArticles()
    {
        $arResult = [];
        $mysql = new \mysqli("localhost", "root", "", "news");
        $mysql->query("SET NAMES 'utf8'");

        $result = $mysql->query("SELECT * FROM news_list");

        if ($result->num_rows > 0) {
            while ($arArticle = $result->fetch_assoc()) {
                $arResult[$arArticle["id"]]["ARTICLE_TITLE"] = $arArticle["title"];
                $arResult[$arArticle["id"]]["ARTICLE_ANNOUNCE"] = $arArticle["announce"];
                $arResult[$arArticle["id"]]["ARTICLE_TEXT"] = $arArticle["text"];
            }
        }

        $mysql->close();

        return $arResult;
    }

    public function getArticleById()
    {
        if ($this->id == 0 || $this->mode == "list") {
            http_response_code(404);
            die();
        }
        $arResult = [];
        $mysql = new \mysqli("localhost", "root", "", "news");
        $mysql->query("SET NAMES 'utf8'");

        $result = $mysql->query("SELECT * FROM news_list WHERE id=" . $this->id);

        if ($result->num_rows > 0) {
            while ($arArticle = $result->fetch_assoc()) {
                $arResult["ARTICLE_TITLE"] = $arArticle["title"];
                $arResult["ARTICLE_ANNOUNCE"] = $arArticle["announce"];
                $arResult["ARTICLE_TEXT"] = $arArticle["text"];
            }
        }

        $mysql->close();

        return $arResult;
    }

    public function removeArticle()
    {

    }

    public function updateArticle()
    {

    }

    public function addArticle()
    {

    }
}