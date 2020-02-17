<div class="container">
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

            <form method="POST" enctype="multipart/form-data"
                  action="">
                <div class="form-group">
                    <label>Nazwa</label>
                    <input name="name" value="<?php echo $city['name'] ?>"
                           class="form-control <?php echo $errors['name'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Temperatura</label>
                    <input name="temperature" value="<?php echo $city['temperature'] ?>"
                           class="form-control <?php echo $errors['temperature'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['temperature'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Wilgotność</label>
                    <input name="humidity" value="<?php echo $city['humidity'] ?>"
                           class="form-control  <?php echo $errors['humidity'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['humidity'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Wiatr</label>
                    <input name="wind" value="<?php echo $city['wind'] ?>"
                           class="form-control  <?php echo $errors['wind'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['wind'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Opis</label>
                    <input name="description" value="<?php echo $city['description'] ?>"
                           class="form-control  <?php echo $errors['description'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['description'] ?>
                    </div>
                </div>

                <button class="btn btn-success">Dodaj</button>
            </form>
        </div>
    </div>
</div>
