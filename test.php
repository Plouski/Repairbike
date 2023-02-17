<!-- Formulaire -->
    <div id="formulaire">
    <form method="post" action="formulaire.php">
    <p>
    Votre prénom :
        <input type="text" name="prenom" /><br /><br />

    Votre note (/5) :
    <select name="choix">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select>
            <br /><br />

    Votre message :
        <textarea name="message" rows="8" cols="45"></textarea><br /><br />

    <input type="submit" value="Valider" />
    </p>
    </form>

    <!-- / -->


    <!-- Commentaires -->
    <p><div class="element_corps">
    <p>
        <?php

         if(isset($_POST['prenom']))
              echo '<u>'.strip_tags($_POST['prenom']).'</u><br />';

         if(isset($_POST['choix']))
              echo '('.strip_tags($_POST['choix']).'/5)<br />';

         if(isset($_POST['prenom']))
              echo '«'.strip_tags($_POST['message']).'»<br />';
    ?>
    </p>
    </div></p>
    </div>
    <!-- / -->
