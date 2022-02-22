<?php

if (isset($_POST['contenu'])) {
    $fichier = $_POST['file'];
    $files = fopen($fichier, 'w');
    fwrite($files, $_POST['contenu']);
    fclose($files);
}


function Listage($path)
{
    //On déclare le tableau qui contiendra tous les éléments de nos dossiers
    $tableau_elements = array();

    //On ouvre le dossier
    $dir = opendir($path);

    //Pour chaque élément du dossier...
    while (($element_dossier = readdir($dir)) !== FALSE) {
        //Si l'élément est lui-même un dossier (en excluant les dossiers parent et actuel), on appelle la fonction de listage en modifiant la racine du dossier à ouvrir
        if ($element_dossier != '.' && $element_dossier != '..' && is_dir($path . '/' . $element_dossier)) {
            //On fusionne ici le tableau grâce à la fonction array_merge. Au final, tous les résultats de nos appels récursifs à la fonction listage fusionneront dans le même tableau
            $tableau_elements = array_merge($tableau_elements, Listage($path . '/' . $element_dossier));
        } elseif ($element_dossier != '.' && $element_dossier != '..' && $element_dossier != '.DS_Store') {
            //Sinon, l'élément est un fichier : on l'enregistre dans le tableau
            $tableau_elements[] = $path . '/' . $element_dossier;
        }
    }
    //On ferme le dossier
    closedir($dir);

    //On retourne le tableau
    return $tableau_elements;
}

//On définit la racine
$path = './files';

//Appel à notre fonction
$tableau_elements = Listage($path);

function ListageArray($tableau_elements)
{
    //Pour chaque élément du tableau...
    foreach ($tableau_elements as $key => $value) {
        //Si l'élément est un tableau, on appelle la fonction pour qu'elle le parcoure
        if (is_array($value)) {
            echo $key . ' :<ul>';
            ListageArray($value);
            echo '</ul><br/>';
        } else //Sinon, c'est un élément à afficher, alors on le liste !
        {
            echo '<a href="?f=' . $value . '">';
            echo '<li>' . $value . '</li>';
            echo '</a>';
        }
    }
}

ListageArray($tableau_elements);
?>
