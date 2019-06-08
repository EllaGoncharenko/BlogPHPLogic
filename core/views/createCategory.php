<?php
$allCategories=getAll('category');
?>
<form method="post" action="/blog/createCategory">
    <input type="text" name="title"><br>
    <select name="parent_id">
        <option selected value="0">No parent</option>
        <?php
        if(!empty($allCategories)):
        foreach ($allCategories as $cat):
        ?>
            <option value="<?= $cat['id']?>"><?= $cat['title']?></option>
        <?php
        endforeach;
        endif;
        ?>
    </select>
    <button>CreateCategory</button>

</form>
