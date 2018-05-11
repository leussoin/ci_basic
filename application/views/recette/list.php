<div class="container">
    <div class='row'>
        <?php foreach($data as $recette) : ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $recette->nom_recette ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= 'sous-titre' ?></h6>
                <p class="card-text">description</p>
                <a href="recette/detail/<?= $recette->id_recette ?>" class="card-link">Voir</a>
            </div>
        </div>
        <?php endforeach ; ?>
    </div>
</di