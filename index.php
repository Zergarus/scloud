<?require_once __DIR__ . '/src/templates/main/header.php';?>

<?
function myAutoLoader(string $className)
{
    require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
}
spl_autoload_register('myAutoLoader');
?>

<?require_once __DIR__ . '/src/Components/news_list/news_list.php';?>

<?require_once __DIR__ . '/src/templates/main/footer.php';?>
