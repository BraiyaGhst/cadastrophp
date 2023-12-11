<?php
$a = explode("\\", __DIR__);
$dir = "/{$a[1]}/{$a[2]}/{$a[3]}";

include $dir."/src/controller/header.php";

session_destroy();

echo "<p>Finalizando sessão...</p>";

header("Refresh: 2; url = ".ROOT);

include $dir."/src/controller/footer.php";