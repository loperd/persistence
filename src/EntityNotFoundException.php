<?php

declare(strict_types=1);

namespace Loper\Persistence;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class EntityNotFoundException extends NotFoundHttpException
{
    /**
     * @param class-string $type
     */
    public function __construct(string $type, string $source, string $value)
    {
        parent::__construct(\sprintf('Entity "%s" not found by "%s" with "%s".', $type, $source, $value));
    }

    /**
     * @param class-string $type
     */
    public static function notFoundById(string $type, int|string|\Stringable $id): self
    {
        return new self($type, 'id', (string) $id);
    }

    /**
     * @param class-string $type
     */
    public static function notFoundBy(string $type, string $attribute, int|string|\Stringable $id): self
    {
        return new self($type, $attribute, (string) $id);
    }
}
