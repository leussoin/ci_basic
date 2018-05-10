<form id='form-recette'>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="<?= $data['recette']->nom_recette ?>" value="<?= $data['recette']->nom_recette ?>">
    </div>

    <table class="table table-hover">
        <caption>Produits</caption>
        <thead>
            <th> # </th>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Calories</th>
            <th>Prix</th>
        </thead>
        <tbody>
            <?php foreach($data['produits'] as $p) : ?>
            <tr data-id="<?= $p->id_prod ?>">
                <td> X </td>
                <td><?= $p->nom_prod ?></td>
                <td><?= $p->stock_prod .' '. $p->nom_mesure ?></td>
                <td><?= $p->calories ?></td>
                <td><?= $p->prix ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    
    <div class="form-group row">
        <div class="col-sm-10">
            <a href="javascript:;" id="submit-form-recette" class="btn btn-success">Valider</a>
        </div>
    </div>
</form>