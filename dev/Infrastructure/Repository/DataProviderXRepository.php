<?php

namespace Dev\Infrastructure\Repository;

use Dev\Infrastructure\Repository\Abstracts\AbstractRepository;

/**
 * Class DataProviderXRepository
 * @package Dev\Infrastructure\Repository
 */
class DataProviderXRepository extends AbstractRepository
{
    protected $providerFilePath = 'jsons/DataProviderX.json';

    public function getContent()
    {
        $contents = file_get_contents(storage_path($this->providerFilePath));
        $contents = json_decode($contents, true);
        return $contents;
    }
}