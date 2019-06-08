<?php

//Проверка на пустое поле
function required($data){
    //return empty($data);
    //return true;
    if (!empty($data)) {
        return true;
    }
}


function email($data){
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $_POST['email'])) {
        return true;
    }else{
        echo "Некорректный email";
        return false;
    }
}

function password($data){
//return false;
    //Требования к паролю: Должно быть не менее 8 символов; Должно быть 2 числа; Разрешенные символы: ! @ # $ % *
    if(preg_match('/[!@#$%*a-zA-Z0-9]{8,}/',$_POST['password']) && preg_match_all('/[0-9]/',$_POST['password']) >= 2)
    {
        return true;
    }
    else
    {
echo 'Некорректный пароль';
    }
}

function login ($data) {
    //если состоит из одних цифр, или состоит не из цифр или букв, то не пускать
    $login = 'ё1';
    if(preg_match("/^[0-9]+$/", $_POST['login']) || !preg_match("/^[0-9a-zа-яё]+$/iu", $_POST['login'])){
        echo 'Некорректный логин';
    } else {
        return true;
    }
}

/**
 * @param $dataWithRules
 * @param $data
 * @return array
 */
function validateForm($dataWithRules, $data) {
    $errorForms=[];
//будут храниться имена ключей на каждой итерации
    $fields = array_keys($dataWithRules);

    foreach ($fields as $fieldName) {
        $fieldData = $data[$fieldName];
        $rules = $dataWithRules[$fieldName];
        foreach ($rules as $ruleName) {
            if (!$ruleName($fieldData)){
                $errorForms[$fieldName][]= $ruleName;
            }
        }
    }

    return $errorForms;
}

