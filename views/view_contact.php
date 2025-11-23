<?php if (isset($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php else: ?>
    <h2>Détails du contact</h2>

    <p><strong>ID :</strong> <?php echo $contact->getId(); ?></p>
    <p><strong>Nom :</strong> <?php echo htmlspecialchars($contact->getNom()); ?></p>
    <p><strong>Prénom :</strong> <?php echo htmlspecialchars($contact->getPrenom()); ?></p>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($contact->getEmail() ?? ''); ?></p>
    <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($contact->getTelephone()); ?></p>

    <p>
        <a href="index.php?page=edit&id=<?php echo $contact->getId(); ?>">Modifier</a> |
        <a href="index.php?page=delete&id=<?php echo $contact->getId(); ?>">Supprimer</a> |
        <a href="index.php?page=home">Retour à la liste</a>
    </p>
<?php endif; ?>
