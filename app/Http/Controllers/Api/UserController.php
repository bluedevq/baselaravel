<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use App\Validator\UserValidator;

class UserController extends ApiController
{
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = app(UserRepository::class);
        $this->validator = app(UserValidator::class);
    }

    public function index()
    {
        /*
        if (!request()->isMethod('get')) {
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.METHOD_NOT_ALLOWED'));
            return $this->response();
        }
        */

        $users = $this->userRepository->paginate(10)->toArray();

        $this->setData(['users' => data_get($users, 'data', [])]);
        $this->appendResponse(['meta' => ['current_page' => data_get($users, 'current_page', 1), 'total_page' => data_get($users, 'to', 1)]]);
        return $this->response();
    }

    public function create()
    {
        /*
        if (!request()->isMethod('post')) {
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.METHOD_NOT_ALLOWED'));
            return $this->response();
        }
        */

        try {
            $validator = $this->validator->validateCreate($this->getParams());
            if (!$validator) {
                $this->setStatus(false);
                $this->setMessage($this->validator->customErrorsBag());
                return $this->response();
            }

            $email = $this->getParams('email');
            $password = $this->getParams('password');
            $password = !empty($password) ? bcrypt($password) : null;
            $users = [
                'email' => $email,
                'password' => $password,
            ];
            $user = $this->userRepository->create($users);

            $this->setMessage(trans('messages.create_success'));
            $this->setData($user->toArray());
        } catch (\Exception $exception) {
            logInfo('Params: ' . $this->jsonEncode($this->getParams()));
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.SERVER_ERROR'));
            return $this->response();
        }

        return $this->response();
    }

    public function detail($id)
    {
        /*
        if (!request()->isMethod('get')) {
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.METHOD_NOT_ALLOWED'));
            return $this->response();
        }
        */

        $validate = $this->validator->validateShow($id);
        if (!$validate) {
            $this->setStatus(false);
            $this->setMessage(trans('messages.no_result_found'));
            return $this->response();
        }

        $user = $this->userRepository->where('id', $id)->first();
        $user = !empty($user) ? $user->toArray() : [];
        $this->setData($user);
        return $this->response();
    }

    public function edit($id)
    {
        /*
        if (!request()->isMethod('put')) {
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.METHOD_NOT_ALLOWED'));
            return $this->response();
        }
        */

        try {
            $validate = $this->validator->validateShow($id);
            if (!$validate) {
                $this->setStatus(false);
                $this->setMessage(trans('messages.no_result_found'));
                return $this->response();
            }

            $this->appendParams(['id' => $id]);
            $validateEdit = $this->validator->validateUpdate($this->getParams());
            if (!$validateEdit) {
                $this->setStatus(false);
                $this->setMessage($this->validator->customErrorsBag());
                return $this->response();
            }

            $dataUpdate = [];
            $dataUpdate['email'] = $this->getParams('email');
            if (!empty($this->getParams('password'))) {
                $dataUpdate['password'] = bcrypt($this->getParams('password'));
            }
            $this->userRepository->update($id, $dataUpdate);
        } catch (\Exception $exception) {
            logInfo('Params: ' . $this->jsonEncode($this->getParams()));
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.SERVER_ERROR'));
            return $this->response();
        }

        return $this->response();
    }

    public function delete($id)
    {
        /*
        if (!request()->isMethod('delete')) {
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.METHOD_NOT_ALLOWED'));
            return $this->response();
        }
        */

        try {
            $validate = $this->validator->validateShow($id);
            if (!$validate) {
                $this->setStatus(false);
                $this->setMessage(trans('messages.no_result_found'));
                return $this->response();
            }

            $this->userRepository->delete($id);
        } catch (\Exception $exception) {
            logInfo('Params: ' . $this->jsonEncode($this->getParams()));
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            $this->setStatus(false);
            $this->setCode(getConstant('HTTP_CODE.SERVER_ERROR'));
            return $this->response();
        }

        return $this->response();
    }
}
