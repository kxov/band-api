<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ArgumentResolver;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommandResolver implements ValueResolverInterface
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    private RouterInterface $router;

    public function __construct(
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        RouterInterface $router
    )
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return iterable<array|object>
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        /** @var class-string $type */
        $type = $argument->getType();

        if (!is_subclass_of($type, CommandInterface::class)) {
            return [];
        }

        try {
            $command = $this->serializer->deserialize($request->getContent(), $type, 'json');
        } catch (\Exception $exception) {
            throw new ApiException($exception->getMessage());
        }

        $errors = $this->validator->validate($command);

        if (\count($errors)) {
            $json = $this->serializer->serialize($errors, 'json');

            throw new ApiException($json);
        }

        $routeParams = $request->attributes->get('_route_params');

        if (\count($routeParams) > 0) {
            $this->addRouteParams($command, $routeParams);
        }

        yield $command;
    }

    private function addRouteParams(CommandInterface $command, array $routeParams)
    {
        foreach ($routeParams as $paramName => $paramValue) {
            $command->{$paramName} = (int)$paramValue;
        }
    }
}