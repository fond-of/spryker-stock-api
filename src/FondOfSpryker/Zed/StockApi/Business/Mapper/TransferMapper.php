<?php

namespace FondOfSpryker\Zed\StockApi\Business\Mapper;

use Generated\Shared\Transfer\StockProductTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    public function toTransfer(array $data)
    {
        $availabilityStockTransfer = new StockProductTransfer();
        $availabilityStockTransfer->fromArray($data, true);

        return $availabilityStockTransfer;
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer[]
     */
    public function toTransferCollection(array $data)
    {
        $transferList = [];
        foreach ($data as $itemData) {
            $transferList[] = $this->toTransfer($itemData);
        }

        return $transferList;
    }
}
