<?php

declare(strict_types=1);

namespace Loper\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
abstract class BaseRepository
{
    /**
     * @param class-string<T> $model
     */
    public function __construct(private readonly string $model)
    {
    }

    public function getQueryBuilder(): Builder
    {
        /** @var Model $model */
        $model = new $this->model;

        return $model->query();
    }

    /**
     * @return T
     */
    public function findById(int $id)
    {
        return $this->model::find($id);
    }

    /**
     * @return T
     */
    public function getById(int $id)
    {
        return $this->findById($id) ?? throw EntityNotFoundException::notFoundById($this->model, $id);
    }

    /**
     * @param T $model
     * @return void
     */
    public function save($model = null): void
    {
        ($model ?? $this->model)->save();
    }
}
