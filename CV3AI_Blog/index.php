<?php
try {
    $host = "192.168.100.88";
    $dbname = "s2024JonasSysel_blog";
    $user = "s2024JonasSysel";
    $password = "Student123";

    $dsn = "mysql:host=$host;dbname=$dbname";

    $connection = new PDO($dsn, $user, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $SQL = "SELECT id, title, created_at, content FROM posts";

    $statement = $connection->query($SQL);

    $prispevky = $statement->fetchAll();


}catch(Exception $e) {
    echo $e->getMessage();
}
?>

<?php
require_once('layout/header.php');
?>

<?php
require_once('layout/navigation.php');
?>

<main class="container">

    <?php
    foreach ($prispevky as $prispevek) {
        echo ('    <article class="post">
        <a href="prispevek.php?id='.$prispevek['id'].'" class="post-title">'.$prispevek['title'].'</a>
        <div class="post-date">'.$prispevek['created_at'].'</div>
        <div class="post-content">
            <p>'.$prispevek['content'].'</p>
        </div>
    </article>');

    }

    ?>

</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>