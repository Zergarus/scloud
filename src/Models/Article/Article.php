<?php

namespace Models\Article;

class Article
{

    public function getArticle()
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
}