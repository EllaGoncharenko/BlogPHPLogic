<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $data['categoryData']['title']?></title>
</head>
<body>
<?php
if(!empty($data['posts'])):
    foreach ($data['posts']as $post):
        ?>

    <?php
    endforeach;
else:?>
    <h1>Не одного поста не найдено</h1>
<?php endif;?>
</body>
</html>


