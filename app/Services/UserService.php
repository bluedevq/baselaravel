<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Core\Helpers\ExportCsv;

class UserService extends CustomService
{
    /** @var UserRepository $userRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function index($params)
    {
        return $this->getRepository()->getListForIndex($params);
    }

    public function downloadCsv($params)
    {
        $filename = getConfig('csv.users.filename');
        $header = getConfig('csv.users.header');
        $data = $this->repository->getListForExport($params);
        $export = new ExportCsv($filename);
        $export->export($header, $data);
    }

    protected function prepareDataBeforeSave(&$params)
    {
        if (!empty($params['password'])) {
            $params['password'] = bcrypt($params['password']);
        } else {
            unset($params['password']);
        }
    }
}
