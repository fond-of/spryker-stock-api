<?php

namespace FondOfSpryker\Zed\StockApi\Dependency\Facade;

interface StockApiToProductInterface
{
    /**
     * @param string $sku
     *
     * @return int|null
     */
    public function findProductConcreteIdBySku($sku);
}
