<?php

namespace Dev\Domain\Service\Abstracts;

use Dev\Infrastructure\Repository\Abstracts\AbstractRepository;

/**
 * Class AbstractService base class for all services
 * @package Dev\Domain\Service\Abstracts
 */
abstract class AbstractService
{
    /**
     * @var AbstractRepository $repository
     */
    protected $repository;

    /**
     * @var array $data
     */
    protected $data = [];

    /**
     * AbstractService constructor.
     * @param AbstractRepository $repository
     */
    public function __construct(AbstractRepository $repository)
	{
		$this->repository = $repository;
	}
}