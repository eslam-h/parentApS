<?php

namespace Dev\Domain\Service\Abstracts;

interface DataProvider
{
    public function getData(array $filters = []);
}