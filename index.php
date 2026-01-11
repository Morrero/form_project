<?php
session_start();
$success = $_SESSION['success'] ?? null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="assets/js/script.js" defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ankieta</title>
</head>
<body>
  <div class="form-wrapper">
    <?php if ($success): ?>
      <h2><?= htmlspecialchars($success) ?></h2>
      <p>Dziękujemy! Twoja aplikacja została zapisana.</p>
      <?php unset($_SESSION['success']); ?>
    <?php else: ?>
      <h2>Szukasz najlepszej oferty?</h2>
      <p>Zostaw aplikację, a nasz menedżer skontaktuje się z Tobą w celu konsultacji</p>
      <form action="submit.php" method="post" class="custom-form">
        <div class="form-row">
          <input type="text" name="first_name" placeholder="Twoje imię" maxlength="50" required>
          <input type="text" name="last_name" placeholder="Twoje nazwisko" maxlength="50" required>
          <input type="text" name="middle_name" placeholder="Twoje drugie imię" maxlength="50">
        </div>

        <div class="form-row date">
          <input type="text" id="birth_date" name="birth_date" placeholder="Twoja data urodzenia" required>
        </div>

        <div class="form-row">
          <input type="email" name="email" placeholder="E-mail">
        </div>

        <div class="form-row phone">
          <select name="country_code">
            <option value="" disabled selected>Kod kraju</option>
            <option value="+375">+375</option>
            <option value="+7">+7</option>
          </select>
          <input type="tel" name="phone[]" placeholder="Telefon">
          <img src="assets/img/add a telefone button.svg" alt="plus" class="plus-icon">
        </div>

        <div class="form-row marital">
          <select name="marital_status" required>
            <option value="" disabled selected>Stan cywilny</option>
            <option value="single">Wolny/Wolna</option>
            <option value="married">Żonaty/Zamężna</option>
            <option value="divorced">Rozwiedziony/Rozwiedziona</option>
            <option value="widowed">Wdowiec/Wdowa</option>
          </select>
          <img src="assets/img/Vector 9.svg" alt="arrow" class="arrow-icon">
        </div>

        <div class="form-row about">
          <textarea name="about" placeholder="O mnie" maxlength="1000" required></textarea>
        </div>

        <div class="form-row actions">
          <label class="checkbox-label">
            <input type="checkbox" name="agree" required> Przeczytałem zasady
          </label>
          <button type="submit" class="submit-btn" disabled>Wyślij</button>
        </div>
      </form>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
