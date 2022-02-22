<?php include('inc/head.php'); ?>

<h2>Cliquer sur un fichier pour le supprimer</h2>

<?php require('fonctionRecursive.php'); ?>

<?php
if(isset($_GET['f'])) {
    $fichier = "./" . $_GET['f'];
    if (file_exists($fichier)) (unlink($fichier));
?>
</br>
<form method="POST" action="index.php">
    <input type="hidden" name="file" value="<?= $_GET['f'] ?>" />
    <input type="submit" name="deleteFile" value="Supprimer un fichier" />

</form>
</br>
<?php
header('location: deleteFile.php');
}
?>
</br>
<button><a href="index.php">Modifier un fichier</a></button>
</br>


<?php include('inc/foot.php'); ?>