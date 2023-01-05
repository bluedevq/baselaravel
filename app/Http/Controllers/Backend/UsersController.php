<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\UserRepository;
use App\Traits\FormQueryWithoutUrlParams;
use App\Services\UserService;
use App\Validator\UserValidator;
use Core\Providers\Facades\Storages\BaseStorage;
use Illuminate\Http\UploadedFile;

class UsersController extends BackendController
{
    use FormQueryWithoutUrlParams;

    public function __construct()
    {
        $this->setTitle(__('messages.page_title.backend.users'));
        $this->repository = app(UserRepository::class);
        $this->validator = app(UserValidator::class);
        $this->service = app(UserService::class);
    }

    protected function _prepareValid(&$params)
    {
        $avatar = data_get($params, 'avatar');

        if (!empty($avatar) && $avatar instanceof UploadedFile) {
            $params['avatar'] = BaseStorage::uploadToTmp($avatar);
        }
    }
}
