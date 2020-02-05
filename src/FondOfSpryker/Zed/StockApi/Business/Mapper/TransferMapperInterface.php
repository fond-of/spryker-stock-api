<?php

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
