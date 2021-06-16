<?php

namespace Dev\Domain\Service;

use Dev\Domain\Service\Abstracts\AbstractService;
use Dev\Domain\Service\Abstracts\DataProvider;
use Dev\Infrastructure\Repository\DataProviderYRepository;

/**
 * Class DataProviderXService
 * @package Dev\Domain\Service
 */
class DataProviderYService extends AbstractService implements DataProvider
{
    const AUTHORISED = 'authorised';

    const DECLINE = 'decline';

    const REFUNDED = 'refunded';

    const AUTHORISED_CODE = 100;

    const DECLINE_CODE = 200;

    const REFUNDED_CODE = 300;

    /**
     * DataProviderYService constructor.
     * @param DataProviderYRepository $repository
     */
    public function __construct(DataProviderYRepository $repository)
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
                    if ($item['status'] != $this->mapTextToStatusCode($filters['statusCode'])) {
                        continue;
                    }
                }
                if (isset($filters['balanceMin'])) {
                    if (!($item['balance'] >= $filters['balanceMin'])) {
                        continue;
                    }
                }
                if (isset($filters['balanceMax'])) {
                    if (!($item['balance'] <= $filters['balanceMax'])) {
                        continue;
                    }
                }
                if (isset($filters['currency'])) {
                    if ($item['currency'] != $filters['currency']) {
                        continue;
                    }
                }
            }
            $this->data[] = [
                'balance' => isset($item['balance']) ? $item['balance'] : null,
                'currency' => isset($item['currency']) ? $item['currency'] : null,
                'email' => isset($item['email']) ? $item['email'] : null,
                'status' => isset($item['status']) ? $this->mapStatusCodeToText($item['status']) : null,
                'registration_date' => isset($item['created_at']) ? $item['created_at'] : null,
                'identification' => isset($item['id']) ? $item['id'] :null
            ];
        }
        return $this->data;
    }

    protected function mapStatusCodeToText(string $value)
    {
        $codeValue = [
            self::AUTHORISED_CODE => self::AUTHORISED,
            self::DECLINE_CODE => self::DECLINE,
            self::REFUNDED_CODE => self::REFUNDED
        ];
        return isset($codeValue[$value]) ? $codeValue[$value] : null;
    }

    protected function mapTextToStatusCode(string $value)
    {
        $codeValue = [
            self::AUTHORISED => self::AUTHORISED_CODE,
            self::DECLINE => self::DECLINE_CODE,
            self::REFUNDED => self::REFUNDED_CODE
        ];
        return isset($codeValue[$value]) ? $codeValue[$value] : null;
    }
}