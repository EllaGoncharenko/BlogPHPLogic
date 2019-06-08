<?php
$allCategories=getAll('category');
?>
<form method="post" >
    <input type="text" name="title" value="<?=$data['category']['title']?>"><br>
    <select name="parent_id">
        <option <?= ($data['category']['parent_id'] == 0)?'selected':'' ?> value="0">No parent</option>
        <?php
        if(!empty($allCategories)):
            foreach ($allCategories as $cat):
                ?>
                <option value="<?= $cat['id']?>"<?= ($data['category']['parent_id'] == $cat['id'])?'selected':'' ?>><?= $cat['title']?></option>
            <?php
            endforeach;
        endif;
        ?>
    </select>
    <button>UpdateCategory</button>

</form>

