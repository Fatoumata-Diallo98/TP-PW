<?php if (isset($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php else: ?>
    <h2>Modifier un contact</h2>

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
            <input type="text" name="nom"
                   value="<?php echo htmlspecialchars($_POST['nom'] ?? $contact->getNom()); ?>">
        </p>
        <p>
            <label>Prénom :</label><br>
            <input type="text" name="prenom"
                   value="<?php echo htmlspecialchars($_POST['prenom'] ?? $contact->getPrenom()); ?>">
        </p>
        <p>
            <label>Email :</label><br>
            <input type="email" name="email"
                   value="<?php echo htmlspecialchars($_POST['email'] ?? $contact->getEmail()); ?>">
        </p>
        <p>
            <label>Téléphone :</label><br>
            <input type="text" name="telephone"
                   value="<?php echo htmlspecialchars($_POST['telephone'] ?? $contact->getTelephone()); ?>">
        </p>
        <p>
            <button type="submit">Mettre à jour</button>
        </p>
    </form>
<?php endif; ?>
