<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Product-Catalog-Management';
?>
<div class="site-index">

<div class="jumbotron text-center bg-transparent py-3">
    <h1 class="display-4">Records </h1>
</div>
<div class="row mb-2 ">
  
<div class="body-content">
    <div class="row table-responsive">
    <table class="table table-hover">
  <thead class="text-center">
    <tr class="table-dark">
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">BRAND</th>
      <th scope="col">CATEGORY</th>
      <th scope="col">MANUFACTURING DATE</th>
      <th scope="col">EXPIRY DATE</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <tr class="table-primary">
      <th scope="row"><?= Html::encode($post->id) ?></th>
      <td><?= Html::encode($post->name) ?></td>
      <td><?= Html::encode($post->brand) ?></td>
      <td><?= Html::encode($post->category) ?></td>
      <td><?= Html::encode($post->manu_date) ?></td>
      <td><?= Html::encode($post->exp_date) ?></td>
    </tr>
  
  </tbody>
</table>
<div class="row text-center">
    <span>
<a href="<?= Yii::$app->homeUrl; ?>" class="btn btn-secondary">BACK TO HOME</a>
    </span>
    
</div>
    </div>
</div>
</div>
