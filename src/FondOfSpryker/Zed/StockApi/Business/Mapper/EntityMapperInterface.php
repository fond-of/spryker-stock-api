<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

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
