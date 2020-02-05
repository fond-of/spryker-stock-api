<?php

namespace FondOfSpryker\Zed\StockApi\Business\Mapper;

use Orm\Zed\Stock\Persistence\SpyStock;

class EntityMapper implements EntityMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStock
     */
    public function toEntity(array $data)
    {
        $spyAvailability = new SpyStock();
        $spyAvailability->fromArray($data);

        return $spyAvailability;
    }

    /**
     * @param array $data
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStock[]
     */
    public function toEntityCollection(array $data)
    {
        $entityList = [];
        foreach ($data as $itemData) {
            $entityList[] = $this->toEntity($itemData);
        }

        return $entityList;
    }
}
