<?php

namespace Dev\Infrastructure\Repository;

use Dev\Infrastructure\Repository\Abstracts\AbstractRepository;

/**
 * Class DataProviderYRepository
 * @package Dev\Infrastructure\Repository
 */
class DataProviderYRepository extends AbstractRepository
{
    protected $providerFilePath = 'jsons/DataProviderY.json';

    public function getContent()
    {
        $contents = file_get_contents(storage_path($this->providerFilePath));
        $contents = json_decode($contents, true);
        return $contents;
    }
}
