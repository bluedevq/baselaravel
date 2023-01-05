<?php

namespace App\Validator;

use App\Models\User;

class UserValidator extends CustomValidator
{
    protected $_model = User::class;

    public function validateCreate($data)
    {
        $rules = [
            'email' => 'required|email|without_space|not_japanese|unique:users,email',
            'password' => 'required|min:8|max:255|not_japanese',
            'password_confirm' => 'required|min:8|max:255|same:password|not_japanese',
        ];

        return $this->_addRulesMessages($rules, [], false)->with($data)->passes();
    }

    public function validateUpdate($data)
    {
        $rules = [
            'email' => 'required|email|without_space|not_japanese|unique:users,email,' . $data['id'],
            'password' => 'nullable|min:8|max:255|not_japanese',
            'password_confirm' => 'nullable|min:8|max:255|same:password|not_japanese',
        ];

        return $this->_addRulesMessages($rules, [], false)->with($data)->passes();
    }

    public function validateLogin($params)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|not_japanese'
        ];

        return $this->_addRulesMessages($rules, [], false)
            ->with($params)
            ->passes();
    }
}
