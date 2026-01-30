<?php

return [
    'required' => ':attributeを入力してください',
    'email' => ':attributeは「ユーザー名@ドメイン」形式で入力してください',
    'numeric' => ':attributeは数値で入力してください',

    'min' => [
        'string' => ':attributeは:min文字以上で入力してください',
        'numeric' => ':attributeは:min以上で入力してください',
    ],

    'max' => [
        'string' => ':attributeは:max文字以内で入力してください',
        'numeric' => ':attributeは:max以下で入力してください',
    ],

    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'current_weight' => '現在の体重',
        'target_weight' => '目標の体重',
    ],
];
