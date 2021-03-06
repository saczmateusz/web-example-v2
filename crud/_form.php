<div class="content container">
  <div class="card">
    <div class="card-header">
      <h3>
        <?php if ($city['id']): ?>
        Edytuj miasto <b><?php echo $city['name'] ?></b>
        <?php else: ?>
        Dodaj nowe miasto
        <?php endif?>
      </h3>
    </div>
    <div class="card-body">

      <form method="POST" enctype="multipart/form-data" action="">
        <div class="form-group">
          <label>Nazwa</label>
          <input name="name" value="<?php echo $city['name'] ?>"
            class="form-control">
          <div class="invalid-feedback">
            <?php echo $errors['name'] ?>
          </div>
        </div>
        <div class="form-group">
          <label>Temperatura</label>
          <input name="temperature" value="<?php echo $city['temperature'] ?>"
            class="form-control">
          <div class="invalid-feedback">
            <?php echo $errors['temperature'] ?>
          </div>
        </div>
        <div class="form-group">
          <label>Wilgotność</label>
          <input name="humidity" value="<?php echo $city['humidity'] ?>"
            class="form-control">
          <div class="invalid-feedback">
            <?php echo $errors['humidity'] ?>
          </div>
        </div>
        <div class="form-group">
          <label>Wiatr</label>
          <input name="wind" value="<?php echo $city['wind'] ?>"
            class="form-control">
          <div class="invalid-feedback">
            <?php echo $errors['wind'] ?>
          </div>
        </div>
        <div class="form-group">
          <label>Opis</label>
          <input name="description" list="description" value="<?php echo $city['description'] ?>"
            class="form-control">
          <datalist id="description">
            <option value="bezchmurnie">
            <option value="rozproszone chmury">
            <option value="całkowite zachmurzenie">
            <option value="deszcz">
            <option value="ulewa">
            <option value="śnieg">
            <option value="mgła">
            <option value="burza z piorunami">
          </datalist>

          <div class="invalid-feedback">
            <?php echo $errors['description'] ?>
          </div>
        </div>

        <button class="button add">
          <?php if ($city['id']): ?>
          Zapisz
          <?php else: ?>
          Dodaj
          <?php endif?>
        </button>
        <a href="../admin/admin-dashboard.php" class="button view">Wróć</a>
      </form>
    </div>
  </div>
</div>

<footer>
  <p>
    © 2020 Mateusz Sączawa. All rights reserved.
  </p>
</footer>

</body>

</html>