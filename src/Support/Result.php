<?php

declare(strict_types = 1);

namespace Mecene\Support;

use Throwable;

final readonly class Result
{
    /**
     * Summary of __construct
     * @param mixed $value
     * @param null|Throwable $error
     */
    public function __construct(public mixed $value, public null|Throwable $error = null)
    {        
    }

    /**
     * Summary of ok
     * @param mixed $value
     * @return Result
     */
    public static function ok(mixed $value): Result
    {
        return new self(
            value: $value,
            error: null
        );
    }    

    /**
     * Summary of error
     * @param Throwable $error
     * @return Result
     */
    public static function error(Throwable $error): Result
    {
        return new self(
            value: null,
            error: $error
        );
    }

    /**
     * Summary of isOk
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->error === null;
    }

    public function isError(): bool
    {
        return $this->error !== null;
    }

    /**
     * Summary of unwrap
     * @return mixed
     * @throws Throwable
     */
    public function unwrap(): mixed
    {
        if ($this->isError())
        {
            throw $this->error;
        }

        return $this->value;
    }
}