<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>

<?php
require_once '_connec.php';

if (isset($_POST['validate'])) {

    if (empty($_POST['firstname'])) {
        $firstnameErr = '* veuillez entrez un prénom';
    } elseif (strlen($_POST['firstname']) > 45) {
        $firstnameErr = '* 45 caractères maximum';
    } else {
        $firstname = trim(htmlspecialchars($_POST['firstname']));
    }

    if (empty($_POST['lastname'])) {
        $lastnameErr = '* veuillez entrer un nom';
    } elseif (strlen($_POST['lastname']) > 45) {
        $lastnameErr = '* 45 caractères maximum';
    } else {
        $lastname = trim(htmlspecialchars($_POST['lastname']));
    }

    if(!isset($firstnameErr) && !isset($lastnameErr)) {

    $queryInsert = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $pdo->prepare($queryInsert);

    $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);

    $statement->execute();

    $addFriend = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('location: index.php');
    }
}

$querySelect = $pdo->query('SELECT firstname, lastname FROM friend');
$friends = $querySelect->fetchAll(PDO::FETCH_OBJ);
?>
<h2>Liste des Amis</h2>
<?php
foreach ($friends as $friend) :
?>
    <div>
        <span><?= $friend->firstname ?></span>
        <span><?= $friend->lastname ?></span>
        <div>

        <?php endforeach ?>

        <body>
            <h2>Entrez votre nom</h2>
            <form action="" method="post">
                <div>
                    <label for="firstname">Prénom :</label>
                    <input type="text" id="firstname" name="firstname" value="<?php if (isset($firstname)) echo $firstname; ?>">
                    <span class="error"><?php if (isset($firstnameErr)) echo $firstnameErr ?></span>
                </div>
                <div>
                    <label for="lastname">Nom :</label>
                    <input type="text" id="lastname" name="lastname" value="<?php if (isset($lastname)) echo $lastname; ?>">
                    <span class="error"><?php if (isset($lastnameErr)) echo $lastnameErr ?></span>
                </div>
                <div class="button">
                    <button type="submit" name="validate">S'inscrire</button>
                </div>
            </form>

        </body>

</html>