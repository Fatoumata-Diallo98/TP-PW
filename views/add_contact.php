<h2>Ajouter un contact</h2>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="">
    <p>
        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>">
    </p>
    <p>
        <label>Prénom :</label><br>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>">
    </p>
    <p>
        <label>Email :</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    </p>
    <p>
        <label>Téléphone :</label><br>
        <input type="text" name="telephone" value="<?php echo htmlspecialchars($_POST['telephone'] ?? ''); ?>">
    </p>
    <p>
        <button type="submit">Enregistrer</button>
    </p>
</form>
