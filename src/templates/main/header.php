<?
function myAutoLoader(string $className)
{
    require_once __DIR__ . '/../../../src/' . str_replace('\\', '/', $className) . '.php';
}
spl_autoload_register('myAutoLoader');
?>

<html>
<head>
    <title>Новостной сайт</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
