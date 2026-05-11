<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'taskuser';
$pass = getenv('DB_PASS') ?: 'taskpass';
$db   = getenv('DB_NAME') ?: 'taskmanager';

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['tasca'])) {
    $tasca = $conn->real_escape_string($_POST['tasca']);
    $conn->query("INSERT INTO tasques (nom, feta) VALUES ('$tasca', 0)");
}

if (isset($_GET['feta'])) {
    $id = (int)$_GET['feta'];
    $conn->query("UPDATE tasques SET feta=1 WHERE id=$id");
}

$result = $conn->query("SELECT * FROM tasques ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Task Manager</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; }
    .feta { text-decoration: line-through; color: gray; }
    form { margin-bottom: 20px; }
    input[type=text] { width: 70%; padding: 8px; }
    button { padding: 8px 16px; }
  </style>
</head>
<body>
  <h1>Task Manager</h1>
  <form method="POST">
    <input type="text" name="tasca" placeholder="Nova tasca..." required>
    <button type="submit">Afegir</button>
  </form>
  <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li class="<?= $row['feta'] ? 'feta' : '' ?>">
        <?= htmlspecialchars($row['nom']) ?>
        <?php if (!$row['feta']): ?>
          <a href="?feta=<?= $row['id'] ?>">✓</a>
        <?php endif; ?>
      </li>
    <?php endwhile; ?>
  </ul>
</body>
</html>
