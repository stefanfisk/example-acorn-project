<?php

namespace App\Traits;

use Illuminate\Support\Str;
use InvalidArgumentException;
use ReflectionMethod;

use function add_action;
use function add_filter;
use function method_exists;
use function sprintf;

trait AddsHooksTrait
{
    /**
     * @param string      $tag
     * @param null|string $method
     * @param int         $priority
     * @param int         $acceptedArgs
     */
    public function addAction($tag, $method = null, $priority = 10, $acceptedArgs = -1)
    {
        if (! $method) {
            if (method_exists($this, $tag)) {
                $method = $tag;
            } else {
                $method = Str::camel($tag);
            }
        }

        if (! method_exists($this, $method)) {
            throw new InvalidArgumentException(sprintf("%s::%s() does not exist.", static::class, $method));
        }

        $reflectionMethod = new ReflectionMethod(static::class, $method);

        if (! $reflectionMethod->isPublic()) {
            throw new InvalidArgumentException(sprintf("%s::%s() is not public.", static::class, $method));
        }

        if (-1 === $acceptedArgs) {
            $acceptedArgs = $reflectionMethod->getNumberOfParameters();
        }

        add_action($tag, [$this, $method], $priority, $acceptedArgs);
    }

    /**
     * @param string      $tag
     * @param null|string $method
     * @param int         $priority
     * @param int         $acceptedArgs
     */
    public function addFilter($tag, $method = null, $priority = 10, $acceptedArgs = -1)
    {
        if (! $method) {
            if (method_exists($this, $tag)) {
                $method = $tag;
            } else {
                $method = 'filter' . Str::studly($tag);
            }
        }

        if (! method_exists($this, $method)) {
            throw new InvalidArgumentException(sprintf("%s::%s() does not exist.", static::class, $method));
        }

        $reflectionMethod = new ReflectionMethod(static::class, $method);

        if (! $reflectionMethod->isPublic()) {
            throw new InvalidArgumentException(sprintf("%s::%s() is not public.", static::class, $method));
        }

        if (-1 === $acceptedArgs) {
            $acceptedArgs = $reflectionMethod->getNumberOfParameters();
        }

        add_filter($tag, [$this, $method], $priority, $acceptedArgs);
    }
}
