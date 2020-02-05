<?php

namespace FondOfSpryker\Zed\StockApi\Business\Mapper;

interface EntityMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStock
     */
    public function toEntity(array $data);

    /**
     * @param array $stockApiDataCollection
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStock[]
     */
    public function toEntityCollection(array $stockApiDataCollection);
}
