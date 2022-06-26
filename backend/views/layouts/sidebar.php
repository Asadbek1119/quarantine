<?php

use common\models\User;

$user = User::find()->andWhere(['status' => User::STATUS_ACTIVE])->one();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link d-flex align-items-center">
        <img src="/template/images/protection.png" alt="iteach Logo"
             style="width: 35px; height: 40px; margin-left: 20px; margin-right: 8px;">
        <span class="brand-text font-weight-light">QUARANTINE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/template/images/profile.png" alt=""
                     style="width: 30px; height: 30px; color: #a0a0a0;margin-top: 5px; margin-left: 10px">
            </div>
            <div class="info">
                <a href="#" class="d-block"><h5 style="margin: 0"><?= $user->username; ?></h5></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Asosiy qism',
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Kategoriya', 'icon' => 'fas fa-bars', 'url' => ['/category']],
                            ['label' => 'Menu', 'icon' => 'fas fa-bars', 'url' => ['/menumanager']],
                            ['label' => 'Malumotlar', 'icon' => 'fa fa-info-circle', 'url' => ['/info']],
                        ]
                    ],
                    [
                        'label' => 'Fayllar',
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Fayl kategoriya', 'icon' => 'fas fa-bars', 'url' => ['/subcategory']],
                            ['label' => 'Yuklanadigan fayllar', 'icon' => 'fa fa-download', 'url' => ['/download']],
                        ]
                    ],
                    [
                        'label' => 'Rahbariyat',
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Rahbar turlari', 'icon' => 'fas fa-bars', 'url' => ['/leader-category']],
                            ['label' => 'Rahbar', 'icon' => 'fa fa-user', 'url' => ['/leader']],
                        ]
                    ],
                    [
                        'label' => 'Yangiliklar',
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Post turlari', 'icon' => 'fas fa-bars', 'url' => ['/post-category']],
                            ['label' => 'Postlar', 'icon' => 'fas fa-sticky-note', 'url' => ['/post']],
                        ]
                    ],
                    [
                        'label' => 'Hududiy boshqarma',
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Hududlar', 'icon' => 'fa fa-globe', 'url' => ['/region']],
                            ['label' => 'Boshqarma rahbarlari', 'icon' => 'fa fa-user', 'url' => ['/region-leader']],
                        ]
                    ],
                    [
                        'label' => 'Kontakt qism',
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Kontakt Malumotlari', 'icon' => 'fas fa-id-card-alt', 'url' => ['/contact-data']],
                            ['label' => 'Forma Malumotlari', 'icon' => 'fas fa-envelope-square', 'url' => ['/contact-form-data']],
                        ]
                    ],
                    [
                        'label' => "Sayt bo'limlari",
                        'icon' => 'circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Foydali havolalar', 'icon' => 'fa fa-link', 'url' => ['/useful-link']],
                            ['label' => 'Ijtimoiy tarmoqlar', 'icon' => 'fas fa-globe', 'url' => ['/social-network']],
                            ['label' => 'Banner rasmlari', 'icon' => 'fas fa-image', 'url' => ['/banner-image']],
                        ]
                    ],

                    ['label' => 'Videolar', 'icon' => 'fas fa-video', 'url' => ['/video']],
                    ['label' => 'Tarjimalar', 'icon' => 'fas fa-language', 'url' => ['/translate-manager']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>