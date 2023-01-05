<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CustomRepository;
use App\Services\CustomService;
use App\Validator\CustomValidator;
use Core\Http\Controllers\BaseController;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class BackendController extends BaseController
{
    /** @var CustomRepository $repository */
    protected $repository;

    /** @var CustomValidator $validator */
    protected $validator;

    /** @var CustomService $service */
    protected $service;

    protected $formDataKeySuffix;

    /**
     * @return string
     */
    protected function setFormDataKeySuffix($formDataKeySuffix = null)
    {
        $this->formDataKeySuffix = $formDataKeySuffix;
    }

    /**
     * @return string
     */
    protected function getFormDataKey()
    {
        return getArea() . '_' . getControllerName() . '_' . $this->formDataKeySuffix;
    }

    /**
     * @param $data
     * @return $this
     */
    protected function setFormData($data)
    {
        $primaryKey = $this->repository->getKeyName();
        $this->setFormDataKeySuffix(data_get($data, $primaryKey));

        foreach (Arr::get($data, 'upload_fields', []) as $item){
            if (isset($data[$item]) && ($data[$item] instanceof UploadedFile || isBase64Img($data[$item]))){
                unset($data[$item]);
            }
        }

        session()->put([$this->getFormDataKey() => $data]);

        return $this;
    }

    /**
     * @param null $suffix
     * @param bool $clean
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function getFormData($suffix = null, bool $clean = false)
    {
        $this->setFormDataKeySuffix($suffix);
        $data = session()->get($this->getFormDataKey(), []);

        if ($clean) {
            $this->cleanFormData($data);
        }

        return $data;
    }

    /**
     * @param array $data
     */
    protected function cleanFormData(array $data = [])
    {
        session()->put([$this->getFormDataKey() => []]);
        session()->flash('hasClean', !empty($data));
    }

    protected function _prepareValid(&$params)
    {
        //
    }

    public function index()
    {
        $data = request()->all();
        $record = $this->service->index($data);
        $this->setViewData(['records' => $record,]);

        return $this->render();
    }

    public function create()
    {
        $formData = $this->getFormData('', true);
        $this->setViewData(['record' => $formData]);

        return $this->render();
    }

    public function edit($id)
    {
        $validate = $this->validator->validateShow($id);

        if (!$validate) {
            session()->flash('action_failed', __('messages.no_result_found'));

            return redirect(getBackUrl());
        }

        $formData = $this->getFormData($id, true);
        $record = !empty($formData) ? $formData : $this->repository->find($id)->toArray();
        $this->setViewData(['record' => $record]);

        return $this->render();
    }

    public function show($id)
    {
        $validate = $this->validator->validateShow($id);

        if (!$validate) {
            session()->flash('action_failed', __('messages.no_result_found'));

            return redirect(getBackUrl());
        }

        $record = $this->repository->find($id)->toArray();
        $this->setViewData(['record' => $record]);

        return $this->render();
    }

    public function valid()
    {
        $params = request()->all();
        $this->_prepareValid($params);
        $this->setFormData($params);
        $primaryKey = $this->repository->getKeyName();
        $primaryValue = data_get($params, $primaryKey);

        $validate = !empty($primaryValue)
            ? $this->validator->validateUpdate($params)
            : $this->validator->validateCreate($params);

        if (!$validate) {
            return redirect()->back()
                ->withErrors($this->validator->errorsBag())
                ->withInput();
        }

        $routeConfirm = str_replace('.valid', '', request()->route()->getName()) . '.confirm';

        return redirect()->route($routeConfirm, [$primaryKey => $primaryValue]);
    }

    public function confirm()
    {
        $params = request()->all();
        $primaryKey = $this->repository->getKeyName();
        $formData = $this->getFormData(data_get($params, $primaryKey));

        if (empty($formData)) {
            return redirect(getBackUrl());
        }

        $this->setViewData(['record' => $formData]);

        return $this->render();
    }

    public function store()
    {
        $routeIndex = str_replace('.store', '', request()->route()->getName()) . '.index';

        try {
            $params = $this->getFormData();

            if (empty($params)) {
                return redirect()->route($routeIndex);
            }

            if (!$this->validator->validateCreate($params)) {
                $this->cleanFormData();
                session()->flash('action_failed', $this->validator->errorsBag()->first());

                return redirect()->route($routeIndex);
            }

            if (!$this->service->store($params)) {
                $this->cleanFormData();
                session()->flash('action_failed', __('messages.create_failed'));

                return redirect()->route($routeIndex);
            }
        } catch (\Exception $exception) {
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            $this->cleanFormData();
            session()->flash('action_failed', __('messages.create_failed'));

            return redirect()->route($routeIndex);
        }

        $this->cleanFormData();
        session()->flash('action_success', __('messages.create_success'));

        return redirect()->route($routeIndex);
    }

    public function update($id)
    {
        $routeIndex = str_replace('.update', '', request()->route()->getName()) . '.index';
        $params = $this->getFormData($id);

        try {
            if (empty($id) || empty($params)) {
                return redirect()->route($routeIndex);
            }

            if (!$this->validator->validateShow($id)) {
                session()->flash('action_failed', __('messages.no_result_found'));

                return redirect()->route($routeIndex);
            }

            if (!$this->validator->validateUpdate($params)) {
                $this->cleanFormData();
                session()->flash('action_failed', $this->validator->errorsBag()->first());

                return redirect()->route($routeIndex);
            }

            if (!$this->service->update($id, $params)) {
                $this->cleanFormData();
                session()->flash('action_failed', __('messages.update_failed'));

                return redirect()->route($routeIndex);
            }
        } catch (\Exception $exception) {
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            session()->flash('action_failed', __('messages.update_failed'));

            return redirect()->route($routeIndex);
        }

        $this->cleanFormData();
        session()->flash('action_success', __('messages.update_success'));

        return redirect()->route($routeIndex);
    }

    public function destroy($id)
    {
        try {
            if (empty($id)) {
                return redirect(getBackUrl());
            }

            $validate = $this->validator->validateShow($id);

            if (!$validate) {
                session()->flash('action_failed', __('messages.no_result_found'));

                return redirect(getBackUrl());
            }

            if (!$this->service->destroy($id)) {
                session()->flash('action_failed', __('messages.delete_failed'));

                return redirect(getBackUrl());
            }
        } catch (\Exception $exception) {
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            session()->flash('action_failed', __('messages.delete_failed'));

            return redirect(getBackUrl());
        }

        session()->flash('action_success', __('messages.delete_success'));

        return redirect(getBackUrl());
    }

    public function downloadCsv()
    {
        $this->service->downloadCsv(request()->all());
    }
}
