<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Backend\BackendController;
use App\Validator\UserValidator;
use Illuminate\Support\MessageBag;

class LoginController extends BackendController
{
    protected $userValidator;

    public function __construct(UserValidator $userValidator)
    {
        $this->userValidator = $userValidator;
        $this->middleware('guest')->except('logout');
        $this->setTitle(__('messages.page_title.backend.login'));
    }

    public function showLoginForm()
    {
        return $this->render('auth.login');
    }

    public function login()
    {
        if (!$this->userValidator->validateLogin(request()->all())) {
            return redirect()->back()
                ->withErrors($this->userValidator->errorsBag())
                ->withInput(request()->except('password'));
        }

        $userData = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        if (getGuard()->attempt($userData)) {
            return redirect()->route('backend.home');
        }

        $errors = new MessageBag(['email' => [__('validation.email_password_valid')]]);

        return redirect()->back()
            ->withErrors($errors)
            ->withInput(request()->except('password'));
    }

    public function logout()
    {
        getGuard()->logout();

        return redirect()->route('backend.login');
    }
}
