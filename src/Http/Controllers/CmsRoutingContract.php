<?php

declare(strict_types=1);

namespace Made\Cms\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface CmsRoutingContract
{
    public function __invoke(Request $request, Model $model): View | Response;
}
