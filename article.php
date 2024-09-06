<?php
require_once "../include/head.php";
require_once "../include/config.php";

session_start();

$dd = $bdd->prepare("SELECT * FROM articles");
$dd->execute();
$data = $dd->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <?php require_once "../include/header_index.php"; ?>
    <br>
    <?php if (isset($_SESSION['prenom'])) { ?>
        <h2>Bonjour <?= $_SESSION['prenom'] ?></h2>
    <?php } ?>
    <h1>Acheter des biens</h1>
    <?php if (isset($_SESSION['id_user'])) { ?>
        <a href="../www/vente.php" class="btn btn-primary">Voulez vous vendre un article ?</a>
    <?php } ?>
    <br>
    <table>
        <tr>
            <td>ID</td>
            <td>Type</td>
            <td>Caracteristique</td>
            <td>Adresse</td>
            <td>Ville</td>
            <td>Manière de payer</td>
            <?php if (isset($_SESSION['id_user'])) { ?>
                <td>Actions</td>
            <?php } ?>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?= htmlspecialchars($value['id_article']); ?></td>
                <td><?= htmlspecialchars($value['type']); ?></td>
                <td><?= htmlspecialchars($value['caracteristique']); ?></td>
                <td><?= htmlspecialchars($value['adresse']); ?></td>
                <td><?= htmlspecialchars($value['ville']); ?></td>
                <td><?= htmlspecialchars($value['maniere_paiement']); ?></td>
                <td>
                    <?php if (isset($value['images']) && !empty($value['images'])) { ?>
                        <center><img width="150" class="media-object" src="../img/photo_profil/<?= htmlspecialchars($value['images']); ?>" alt="photo"></center>
                    <?php } ?>
                </td>
                <?php if (isset($_SESSION['id_user']) || isset($_SESSION['role = ADMIN'])) {?>
                    <td>
                        <a href="edit_article.php?id=<?= htmlspecialchars($value['id_article']); ?>" class="btn btn-warning">Éditer</a>
                        <a href="delete_article.php?id=<?= htmlspecialchars($value['id_article']); ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                    </td>
                    <td>
                        <a href="acheter_article.php?id=<?= htmlspecialchars($value['id_article']); ?>" class="btn btn-success">Acheter</a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <?php require_once "../include/footer_index.php"; ?>
</body>