<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを承認してください。',
    'after' => ':attributeには、:dateより後の日付を選択してください。',
    'after_or_equal' => ':attributeには、:date以降の日付を選択してください。',
    'alpha' => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash' => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num' => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'before' => ':attributeには、:dateより前の日付を選択してください。',
    'before_or_equal' => ':attributeには、:date以前の日付を選択してください。',
    'between' => [
        'numeric' => ':attributeには、:minから、:maxまでの数字を入力してください。',
        'file' => ':attributeには、:min KBから:max KBまでのサイズのファイルを選択してください。',
        'string' => ':attributeは、:min文字から:max文字に入力してください。',
        'array' => ':attributeの項目は、:min個から:max個に入力してください。',
    ],

    'boolean' => ":attributeには、'true'か'false'を指定してください。",
    'confirmed' => ':attributeと:attribute確認が一致しません。',
    'date' => ':attributeには有効な日付を選択してください。',
    'date_equals' => ':attributeは:dateに等しい日付で選択してください。',
    'date_format' => ':attributeは:format形式で選択してください。',
    'date_format_multiple' => ':attributeは:format形式で選択してください。',
    'different' => ':attributeと:otherには、異なった内容を入力してください。',
    'digits' => ':attributeは、:digits桁に入力してください。',
    'digits_between' => ':attributeは、:min桁から:max桁に入力してください。',
    'email' => ':attributeはメールのフォーマットで入力してください。',
    'exists' => ':attributeは存在していません。',
    'custom_exists' => ':attributeは存在していません。',
    'filled' => ':attributeは必須です。',
    'gt' => [
        'numeric' => ':attributeには、:valueより大きな値を入力してください。',
        'file' => ':attributeには、:value kBより大きなファイルを選択してください。',
        'string' => ':attributeは、:value文字より長く入力してください。',
        'array' => ':attributeには、:value個より多くのアイテムを指定してください。',
    ],
    'gte' => [
        'numeric' => ':attributeには、:value以上の値を入力してください。',
        'file' => ':attributeには、:value kB以上のファイルを選択してください。',
        'string' => ':attributeは、:value文字以上で入力してください。',
        'array' => ':attributeには、:value個以上のアイテムを指定してください。',
    ],
    'in' => ':attributeが不正です。',
    'in_array' => ':attributeが不正です。',
    'integer' => ':attributeは整数で入力してください。',

    'lt' => [
        'numeric' => ':attributeには、:valueより小さな値を入力してください。',
        'file' => ':attributeには、:value kBより小さなファイルを選択してください。',
        'string' => ':attributeは、:value文字より短く入力してください。',
        'array' => ':attributeには、:value個より少ないアイテムを指定してください。',
    ],
    'lte' => [
        'numeric' => ':attributeには、:value以下の値を入力してください。',
        'file' => ':attributeには、:value kB以下のファイルを選択してください。',
        'string' => ':attributeは、:value文字以下で入力してください。',
        'array' => ':attributeには、:value個以下のアイテムを指定してください。',
    ],
    'max' => [
        'numeric' => ':attributeには、:max以下の数字を入力してください。',
        'file' => ':attributeには、:max MB以下のファイルを選択してください。',
        'string' => ':attributeは、:max文字以下で入力してください。',
        'array' => ':attributeは:max個以下指定してください。',
    ],
    'mimes' => ':attributeには、:valuesタイプのファイルを選択してください。',
    'mimetypes' => ':attributeには、:valuesタイプのファイルを選択してください。',
    'min' => [
        'numeric' => ':attributeには、:min以上の数字を入力してください。',
        'file' => ':attributeには、:min MB以上のファイルを選択してください。',
        'string' => ':attributeは、:min文字以上で入力してください。',
        'array' => ':attributeは:min個以上指定してください。',
    ],
    'not_in' => '選択された:attributeは正しくありません。',
    'not_regex' => ':attributeの形式が正しくありません。',
    'regex' => ':attributeに正しい形式を指定してください。',
    'numeric' => ':attributeには、数字を入力してください。',
    'number' => ':attributeには、数字を入力してください。',
    'same' => ':attributeと:otherが一致しません。',
    'string' => ':attributeには、文字列を入力してください。',
    'unique' => ':attributeの値は既に存在しています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeは正しい形式を入力してください。',

    // Custom Validation of Base
    'required' => ":attributeを入力してください。",
    'required_select' => ":attributeを選択してください。",
    'greater_than_field' => ':attribute＞:otherとなるように入力してください。',
    'greater_than_or_equal_field' => ':attribute≧:otherとなるように入力してください。',
    'greater_than_or_equal_time_field' => ':attribute≧:otherとなるように入力してください。',
    'less_than_field' => ':attribute＜:otherとなるように入力してください。',
    'less_than_or_equal_field' => ':attribute≦:otherとなるように入力してください。',
    'katakana' => ':attributeはカタカナで入力してください。',
    'maxlength' => ':attributeは、:max文字以下で入力してください。',
    'phone' => ':attributeには、数字を入力してください。',
    'valid' => ':attributeが不正です。',
    'not_japanese' => ':attributeに正しい形式を指定してください。',
    'password_format' => ':attributeは大小文字半角英数字記号で入力してください。',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
    'email_password_valid' => 'メールアドレスとパスワードが一致しません。',
    'password_invalid' => '現在のパスワードが正しくありません。',
    'password_not_japanese' => '新しい パスワードは大小文字半角英数字記号で入力してください。',
    'password_conf_not_japanese' => '新しいパスワード(確認)は大小文字半角英数字記号で入力してください。',
    'company_name_required' => 'アカウント名を入力してください。',
];
