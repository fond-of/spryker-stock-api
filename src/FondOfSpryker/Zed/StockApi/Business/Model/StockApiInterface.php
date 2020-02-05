<?php

namespace FondOfSpryker\Zed\StockApi\Business\Model;

use Generated\Shared\Transfer\ApiDataTransfer;

interface StockApiInterface
{
    /**
     * @param int $idStock
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($idStock, ApiDataTransfer $apiDataTransfer);
}
