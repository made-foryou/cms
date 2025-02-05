<?php

namespace Made\Cms\App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MadeController implements CmsRoutingContract
{
    public function __invoke(Request $request, Model $model): View | Response
    {
        return response('<h1>' . $model->name . '</h1>');
    }
}
