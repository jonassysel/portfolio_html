<?php
$prispevek = null;
$chyba = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"])) {
        $chyba = "ID chybí";
    } elseif (!is_numeric($_GET["id"])) {
        $chyba = "ID není číslo";
    } else {
        try {
            $host = "192.168.100.88";
            $dbname = "s2024JonasSysel_blog";
            $user = "s2024JonasSysel";
            $password = "Student123";

            $dsn = "mysql:host=$host;dbname=$dbname";

            $connection = new PDO($dsn, $user, $password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $SQL = "SELECT id, title, created_at, content FROM posts WHERE id = ?";

            $statement = $connection->prepare($SQL);
            $statement->execute([$_GET["id"]]);

            $prispevek = $statement->fetch();

            if (!$prispevek) {
                $chyba = "Příspěvek nebyl nalezen.";
            }
        } catch (Exception $e) {
            $chyba = $e->getMessage();
        }
    }
} else {
    $chyba = "Tato metoda není podporována.";
}

require_once('layout/header.php');
require_once('layout/navigation.php');
?>

<main class="container">
    <?php if ($chyba): ?>
        <div class="error-message"><?= htmlspecialchars($chyba) ?></div>
    <?php else: ?>
        <article class="post post-detail">
            <h2 class="post-title"><?= htmlspecialchars($prispevek['title']) ?></h2>
            <div class="post-date"><?= htmlspecialchars($prispevek['created_at']) ?></div>
            <div class="post-content">
                <?= nl2br(htmlspecialchars($prispevek['content'])) ?>
            </div>
        </article>
    <?php endif; ?>

    <a href="index.php" class="back-link">&larr; Zpět na všechny příspěvky</a>
</main>

<?php require_once('layout/footer.php'); ?>

</body>
</html>
