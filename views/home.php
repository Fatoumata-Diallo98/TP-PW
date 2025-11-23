<?php if (!empty($message)): ?>
    <p class="success"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<h2>Liste des contacts</h2>

<?php if (empty($contacts)): ?>
    <p>Aucun contact pour le moment.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $c): ?>
            <tr>
                <td><?php echo $c->getId(); ?></td>
                <td><?php echo htmlspecialchars($c->getNom()); ?></td>
                <td><?php echo htmlspecialchars($c->getPrenom()); ?></td>
                <td><?php echo htmlspecialchars($c->getEmail() ?? ''); ?></td>
                <td><?php echo htmlspecialchars($c->getTelephone()); ?></td>
                <td>
                    <a href="index.php?page=view&id=<?php echo $c->getId(); ?>">Voir</a> |
                    <a href="index.php?page=edit&id=<?php echo $c->getId(); ?>">Modifier</a> |
                    <a href="index.php?page=delete&id=<?php echo $c->getId(); ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
