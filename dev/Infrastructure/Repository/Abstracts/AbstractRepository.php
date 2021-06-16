<?php

namespace Dev\Infrastructure\Repository\Abstracts;

/**
 * Class AbstractRepository base class for all repositories
 * @package Dev\Infrastructure\Repository\Abstracts
 */
abstract class AbstractRepository
{
    protected $providerFilePath;

    abstract public function getContent();
}