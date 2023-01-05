<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait FormQueryWithoutUrlParams
{
    public static function getPrefixForm(): string
    {
        return '_search';
    }

    public function index()
    {
        $queryParams = request()->all();
        $searchFormId = data_get($queryParams, self::getPrefixForm());

        if (!empty($searchFormId) || empty($queryParams)) {
            $requestParams = session()->get(self::getPrefixForm(), []);

            $searchFormId ? request()->merge($requestParams) : session()->forget(self::getPrefixForm());

            return parent::index();
        }

        $sessionId = time();
        session()->put(self::getPrefixForm(), $queryParams);

        return redirect()->route(Route::currentRouteName(), [self::getPrefixForm() => $sessionId]);
    }
}
