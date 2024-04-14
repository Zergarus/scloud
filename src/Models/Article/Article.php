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
        $this->db = new \PDO("mysql:host=localhost;dbname=news", "root", "");

    }

    public function getArticleById()
    {
        if ($this->id == 0 || $this->mode == "list") {
            http_response_code(404);
            die();
        }

        try {
            $sql = "SELECT * FROM news_list WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($arArticle = $stmt->fetch()) {
                    $arResult["ARTICLE_TITLE"] = $arArticle["title"];
                    $arResult["ARTICLE_ANNOUNCE"] = $arArticle["announce"];
                    $arResult["ARTICLE_TEXT"] = $arArticle["text"];
                }
            }
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }

        return $arResult;
    }

    public function removeArticle()
    {
        try {
            $sql = "DELETE FROM `news_list` WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }

    public function updateArticle($data)
    {
        try {
            $sql = "UPDATE news_list SET title = :title, announce = :announce, text = :text WHERE id = :userid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":title", $data["title"]);
            $stmt->bindValue(":announce", $data["announce"]);
            $stmt->bindValue(":text", $data["text"]);
            $stmt->bindValue(":userid", $this->id);
            $stmt->execute();
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }

    public function addArticle($data)
    {
        try {
            $sql = "INSERT INTO `news_list` (`title`, `announce`, `text`) VALUES (:title, :announce, :text)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":title", $data["title"]);
            $stmt->bindValue(":announce", $data["announce"]);
            $stmt->bindValue(":text", $data["text"]);
            $stmt->execute();
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }


    public function getPagesCount(int $itemsPerPage): int|bool
    {
        try {
            $sql = "SELECT COUNT(*) AS cnt FROM news_list";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return ceil($stmt->fetch()["cnt"] / $itemsPerPage);
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }

    }

    public function getPage(int $pageNum, int $itemsPerPage)
    {
        $arResult = [];
        try {
            $sql = sprintf(
                'SELECT * FROM `%s` ORDER BY id DESC LIMIT %d OFFSET %d;',
                "news_list",
                $itemsPerPage,
                ($pageNum - 1) * $itemsPerPage
            );
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($arArticle = $stmt->fetch()) {
                    $arResult[$arArticle["id"]]["ARTICLE_TITLE"] = $arArticle["title"];
                    $arResult[$arArticle["id"]]["ARTICLE_ANNOUNCE"] = $arArticle["announce"];
                    $arResult[$arArticle["id"]]["ARTICLE_TEXT"] = $arArticle["text"];
                }
            }
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }

        return $arResult;
    }
}