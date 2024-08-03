<?php
use yii\helpers\Html;
use yii\web\View;

/** @var yii\web\View $this */

$this->title = 'Product-Catalog-Management';
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['depends' => [\yii\web\JqueryAsset::class]]);
$exportJs = <<<JS
$('#export-excel').on('click', function() {
    var url = 'site/export-excel';
    window.location.href = url;
});
JS;
$this->registerJs($exportJs);
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <span class="my-stylish">Product-Catalog-Management<span/>
    </div>
    <div class="row mb-2">
        <div class="p-0">
            <?= Html::a('Create', ['/site/create'], ['class' => 'btn btn-outline-primary mb-1 blob-btn']) ?>
            <?= Html::a('Export to Excel', ['/site/export-excel'], ['class' => 'btn btn-outline-primary mb-1 blob-btn']) ?>

        </div>
    </div>
    <div class="body-content">
        <div class="row table-responsive">
            <table class="table table-hover table-responsive text-center">
                <thead class="table-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">BRAND</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">MANUFACTURING DATE</th>
                        <th scope="col">EXPIRY DATE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody style="align-items:center;vertical-align:middle;">
                    <?php if (count($posts) > 0): ?>
                        <?php foreach ($posts as $post): ?>
                            <tr class="table-success">
                                <th scope="row"><?= Html::encode($post->id) ?></th>
                                <td><?= Html::encode($post->name) ?></td>
                                <td><?= Html::encode($post->brand) ?></td>
                                <td><?= Html::encode($post->category) ?></td>
                                <td><?= Html::encode($post->manu_date) ?></td>
                                <td><?= Html::encode($post->exp_date) ?></td>
                                <td class="d-flex justify-content-center gap-2 flex-wrap">
                                    <span><?= Html::a('View', ['view', 'id' => $post->id], ['class' => 'btn btn-outline-primary mb-1 blob-btn']) ?></span>
                                    <span><?= Html::a('Update', ['update', 'id' => $post->id], ['class' => 'btn btn-outline-success mb-1 blob-btn']) ?></span>
                                    <span><?= Html::a('Delete', ['delete', 'id' => $post->id], ['class' => 'btn btn-outline-danger mb-1 blob-btn blob-btn-delete']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No Records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    body {
        font-family: "Roboto", sans-serif;
    }
    .blob-btn {
        position: relative;
        padding: 0.5rem 1rem;
        overflow: hidden;
        border-radius: 8px;
        transition: color 0.8s, background-color 1s;
    }
    .blob-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300%;
        height: 300%;
        transition: transform 0.8s;
        border-radius: 40%;
        transform: translate(-50%, -50%) scale(0);
        z-index: 0;
    }
    .blob-btn:hover::before {
        transform: translate(-50%, -50%) scale(1);
    }
    .blob-btn:hover {
        color: white;
    }
    .blob-btn span {
        position: relative;
        z-index: 1;
    }
    .my-stylish {
        font-weight: 400;
        font-size: 30px;
    }
</style>

<?php
$deleteJs = <<<JS
$('.blob-btn-delete').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _csrf: csrfToken
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting your file.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'There was a problem deleting your file.',
                        'error'
                    );
                }
            });
        }
    });
});
JS;
$this->registerJs($deleteJs);
?>
