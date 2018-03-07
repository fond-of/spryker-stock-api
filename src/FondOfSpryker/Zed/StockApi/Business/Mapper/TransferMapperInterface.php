<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\StockApi\Business\Mapper;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    public function toTransfer(array $data);

    /**
     * @param array $stockEntityCollection
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer[]
     */
    public function toTransferCollection(array $stockEntityCollection);
}
