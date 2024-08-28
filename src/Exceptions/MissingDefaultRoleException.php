<?php

namespace Made\Cms\Exceptions;

use Illuminate\Http\Client\HttpClientException;
use Throwable;

class MissingDefaultRoleException extends HttpClientException
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        if (strlen($message) === 0) {
            $message = __('made-cms::exceptions.missing-default-role');
        }

        if ($code === 0) {
            $code = 418;
        }

        parent::__construct($message, $code, $previous);
    }
}
