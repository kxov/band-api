<?php

declare(strict_types=1);

namespace App\Infrastructure\ArgumentResolver;

use App\Infrastructure\Exception\ApiException;
use App\Infrastructure\Request\RequestApiInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestApiResolver implements ValueResolverInterface
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        /** @var class-string $type */
        $type = $argument->getType();

        return is_subclass_of($type, RequestApiInterface::class);
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
        $command = $this->serializer->deserialize($request->getContent(), $type, 'json');

        $errors = $this->validator->validate($command);

        if (\count($errors)) {
            $json = $this->serializer->serialize($errors, 'json');

            throw new ApiException($json);
        }

        yield $command;
    }
}