<?php

use common\models\Gallery;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model Gallery */
?>

<?php
if ($model->isNewRecord) {
    echo 'Yangi rekord uchun rasmlarni yuklash imkonsiz';
} else {
    echo GalleryManager::widget(
        [
            'model' => $model,
            'behaviorName' => 'galleryBehavior',
            'apiRoute' => 'gallery/galleryApi'
        ]
    );
}
?>
