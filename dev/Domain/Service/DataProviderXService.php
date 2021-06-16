<?php

namespace Dev\Domain\Service;

use Dev\Domain\Service\Abstracts\AbstractService;
use Dev\Domain\Service\Abstracts\DataProvider;
use Dev\Infrastructure\Repository\DataProviderXRepository;

/**
 * Class DataProviderXService
 * @package Dev\Domain\Service
 */
class DataProviderXService extends AbstractService implements DataProvider
{
    const AUTHORISED = 'authorised';

    const DECLINE = 'decline';

    const REFUNDED = 'refunded';

    const AUTHORISED_CODE = 1;

    const DECLINE_CODE = 2;

    const REFUNDED_CODE = 3;

    /**
     * DataProviderXService constructor.
     * @param DataProviderXRepository $repository
     */
    public function __construct(DataProviderXRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getData(array $filters = [])
    {
        $data = $this->repository->getContent();
        return $this->mapData($data, $filters);
    }

    protected function mapData(array $data, array $filters = [])
    {
        foreach ($data as $item) {
            if ($filters) {
                if (isset($filters['statusCode'])) {
                    if ($item['statusCode'] != $this->mapTextToStatusCode($filters['statusCode'])) {
                        continue;
                    }
                }
                if (isset($filters['balanceMin'])) {
                    if (!($item['parentAmount'] >= $filters['balanceMin'])) {
                        continue;
                    }
                }
                if (isset($filters['balanceMax'])) {
                    if (!($item['parentAmount'] <= $filters['balanceMax'])) {
                        continue;
                    }
                }
                if (isset($filters['currency'])) {
                    if ($item['Currency'] != $filters['currency']) {
                        continue;
                    }
                }
            }
            $this->data[] = [
                'balance' => isset($item['parentAmount']) ? $item['parentAmount'] : null,
                'currency' => isset($item['Currency']) ? $item['Currency'] : null,
                'email' => isset($item['parentEmail']) ? $item['parentEmail'] : null,
                'status' => isset($item['statusCode']) ? $this->mapStatusCodeToText($item['statusCode']) : null,
                'registration_date' => isset($item['registerationDate']) ? $item['registerationDate'] : null,
                'identification' => isset($item['parentIdentification']) ? $item['parentIdentification'] :null
            ];
        }
        return $this->data;
    }

    private function mapStatusCodeToText(string $value)
    {
        $codeValue = [
            self::AUTHORISED_CODE => self::AUTHORISED,
            self::DECLINE_CODE => self::DECLINE,
            self::REFUNDED_CODE => self::REFUNDED
        ];
        return isset($codeValue[$value]) ? $codeValue[$value] : null;
    }

    private function mapTextToStatusCode(string $value)
    {
        $codeValue = [
            self::AUTHORISED => self::AUTHORISED_CODE,
            self::DECLINE => self::DECLINE_CODE,
            self::REFUNDED => self::REFUNDED_CODE
        ];
        return isset($codeValue[$value]) ? $codeValue[$value] : null;
    }
}