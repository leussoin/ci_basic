<H1><?= $data['recette']->nom_recette ?></H1>
<a href="<?= base_url('index.php/recette/update/' .$data['recette']->id_recette) ?>" class="btn btn-secondary">modifier</a>
<table class="table table-hover">
    <caption>Produits</caption>
    <thead>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Calories</th>
        <th>Prix</th>
    </thead>
    <tbody>
        <?php foreach($data['produits'] as $p) : ?>
        <tr>
            <td><?= $p->nom_prod ?></td>
            <td><?= $p->stock_prod .' '. $p->nom_mesure ?></td>
            <td><?= $p->calories ?></td>
            <td><?= $p->prix ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>