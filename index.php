<?php include('inc/head.php'); ?>

<h2>Cliquer sur un fichier pour le modifier</h2>


<?php require('fonctionRecursive.php'); ?>
<?php

if (isset($_GET['f'])) {
    $fichier = "./" . $_GET['f'];
    $contenu = file_get_contents($fichier);

?>

    <form method="POST" action="index.php">
        <textarea name="contenu"><?= $contenu ?></textarea>
        <input type="hidden" name="file" value="<?= $_GET['f'] ?>" />
        <input type="submit" value="Modifier" />
    </form>
<?php
}
?>
</br>
<button><a href="deleteFile.php">Supprimer un fichier</a></button>
</br>



<?php include('inc/foot.php'); ?>