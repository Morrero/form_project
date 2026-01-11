<?php
session_start();
$data = $_SESSION['form_data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
?>
<?php if ($success): ?>
    <h2><?= htmlspecialchars($success) ?></h2>
<?php else: ?>
<form action="submit.php" method="post">
    <input type="text" name="first_name" value="<?= htmlspecialchars($data['first_name'] ?? '') ?>">
    <?php if(isset($errors['first_name'])) echo "<p>{$errors['first_name']}</p>"; ?>

    <input type="text" name="last_name" value="<?= htmlspecialchars($data['last_name'] ?? '') ?>">
    <?php if(isset($errors['last_name'])) echo "<p>{$errors['last_name']}</p>"; ?>

    <button type="submit">Wyślij</button>
</form>
<?php endif; ?>
