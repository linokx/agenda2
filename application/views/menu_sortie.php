
<h4>Distance</h4>
<p>
    <?php 
    foreach ($distances as $distance) {
        echo anchor('filter/distance/'.$distance['distance'], $distance['texte'], 'title="Rayon de '.$distance['texte'].'km"');
    }
    ?>
</p>
<br>
<hr>
<h4>Type</h4>
<p>
    <?php 
    foreach ($types as $type) {
        echo anchor('filter/type/'.$type['type'], $type['texte'], 'title="Rayon de '.$type['texte'].'"');
    }
    ?>
</p>
<br>
<hr>
<h4>Note</h4>
<a href="">0</a>
<a href="">1</a>
<a href="">2</a>
<a href="">3</a>
<a href="">4</a>
<a href="">5</a>
</p>