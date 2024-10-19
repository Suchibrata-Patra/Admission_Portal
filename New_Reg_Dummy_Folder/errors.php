<?php if (isset($errors) && count($errors) > 0) : ?>
  <div class="error">
    <ul style="color:red">
    <?php foreach ($errors as $error) : ?>
      <li><?php echo htmlspecialchars($error) ?></li>
    <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>
