<?php if (isset($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php else: ?>
    <h2>Supprimer un contact</h2>

    <p>Voulez-vous vraiment supprimer le contact suivant ?</p>
    <ul>
        <li><strong>Nom :</strong> <?php echo htmlspecialchars($contact->getNom()); ?></li>
        <li><strong>Prénom :</strong> <?php echo htmlspecialchars($contact->getPrenom()); ?></li>
        <li><strong>Email :</strong> <?php echo htmlspecialchars($contact->getEmail() ?? ''); ?></li>
        <li><strong>Téléphone :</strong> <?php echo htmlspecialchars($contact->getTelephone()); ?></li>
    </ul>

    <form method="post" action="">
        <button type="submit" name="confirm" value="oui">Oui, supprimer</button>
        <button type="submit" name="confirm" value="non">Non, annuler</button>
    </form>
<?php endif; ?>
