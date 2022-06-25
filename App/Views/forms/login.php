<?php
/* @var array $errors */
?>
<h2>Contact Form</h2>
<form action='' method="post" style="display: flex; flex-direction: column">
    <label for="mail">Email</label>
    <?php if (!empty($errors['mail'])): ?>
        <span style="color: red"><?= $errors['mail'] ?></span>
    <?php endif ?>
    <input type="text" name="mail" id="mail">
    <label for="password">Password</label>
    <?php if (!empty($errors['password'])): ?>
        <span style="color: red"><?= $errors['password'] ?></span>
    <?php endif ?>
    <input type="text" name="password" id="password">
    <button type="submit">Submit</button>
</form>