<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class ApiException extends BadRequestHttpException
{

}