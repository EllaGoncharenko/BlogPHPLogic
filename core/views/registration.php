<?php
?>
<h1>REG</h1>
<form method="post">
<!--    <input type="text"-->
<!--           name="login"-->
<!--           value="--><?//= (isset($_POST['login'])) ? $_POST['login'] : '' ?><!--"-->
<!--           class="--><?//= (isset($formErrors['login'])) ? 'error': ''?><!-- " placeholder="login"/>-->
<input type="text"
       name="login"
       value="<?= (isset($_POST['login'])) ? $_POST['login'] : '' ?>"
       class="<?= (empty($_POST['login'])) ? 'error': ''?> " placeholder="login"/>

    <input type="text"
           name="email"
           value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>"
           class="<?= (empty($_POST['email'])) ? 'error': ''?>"placeholder="email"/>

        <input type="password" name="password" placeholder="password">

    <button>Submit</button>
</form>
