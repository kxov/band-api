<?php

declare(strict_types=1);

namespace App\Infrastructure\Listener;

use App\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ApiException) {
            $response = new JsonResponse($this->createResponse($exception), $exception->getStatusCode());
            $event->setResponse($response);
        }
    }

    /**
     * @param \Throwable $exception
     * @return array<string, array<string, array>>
     */
    private function createResponse(\Throwable $exception)
    {
        /** @var array|null $messages */
        $messages = json_decode($exception->getMessage(), true);
        if (!is_array($messages)) {
            $messages = $exception->getMessage() ? [$exception->getMessage()] : [];
        }

        return [
            'error' => [
                'message' => $messages
            ]
        ];
    }
}