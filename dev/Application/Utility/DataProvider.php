<?php

namespace Dev\Application\Utility;

use Dev\Domain\Service\DataProviderXService;
use Dev\Domain\Service\DataProviderYService;

class DataProvider
{
    const DATA_PROVIDER_X = DataProviderXService::class;

    const DATA_PROVIDER_Y = DataProviderYService::class;

    const DATA_PROVIDER_X_LABEL = 'DataProviderX';

    const DATA_PROVIDER_Y_LABEL = 'DataProviderY';

    public static function getProviderService(string $provider)
    {
        $providers = self::getProvidersServices();
        return isset($providers[$provider]) ? $providers[$provider] : null;
    }

    public static function getProvidersServices()
    {
        return [
            self::DATA_PROVIDER_X_LABEL => app(self::DATA_PROVIDER_X),
            self::DATA_PROVIDER_Y_LABEL => app(self::DATA_PROVIDER_Y)
        ];
    }
}