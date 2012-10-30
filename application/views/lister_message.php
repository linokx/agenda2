<div id="centre">
    <table width='100%'>
        <?php
        $current_convers = 1;
        $bonPseudo = false;
        foreach($messages as $message):
            $class =($session->id == $message->id_exp)? "envoie" : "recu";
            ?>
            <div class="<?php echo $class; ?>">
            <?php echo $message->message; ?>
            </div>
            <?php
        endforeach;
        ?>
    </table>
<form method="post" action="index.php?a=ajouter&c=message&id=<?php echo $message->id_convers; ?>">
    <fieldset>
        <textarea name="message"></textarea>
        <input type="submit" value="Envoyer" />
    </fieldset>
</form>
</div>