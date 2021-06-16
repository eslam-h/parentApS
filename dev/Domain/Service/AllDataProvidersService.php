<?php

namespace Dev\Domain\Service;

use Dev\Domain\Service\Abstracts\DataProvider;
use Dev\Application\Utility\DataProvider AS DataProviderUtility;

/**
 * Class AllDataProvidersService
 * @package Dev\Domain\Service
 */
class AllDataProvidersService implements DataProvider
{
    private $data = [];

    private $providers = [];

    public function getData(array $filters = [])
    {
        $this->providers = DataProviderUtility::getProvidersServices();
        foreach ($this->providers as $provider) {
            $this->data = array_merge($this->data, $provider->getData($filters));
        }
        return $this->data;
    }
}