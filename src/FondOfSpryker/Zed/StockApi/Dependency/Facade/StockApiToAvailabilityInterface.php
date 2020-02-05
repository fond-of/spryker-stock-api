<?php

namespace FondOfSpryker\Zed\StockApi\Dependency\Facade;

use Generated\Shared\Transfer\StockProductTransfer;

interface StockApiToAvailabilityInterface
{
    /**
     * @param string $sku
     *
     * @return int
     */
    public function calculateStockForProduct($sku);

    /**
     * @param string $sku
     *
     * @return bool
     */
    public function isNeverOutOfStock($sku);

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $transferStockProduct
     *
     * @return int
     */
    public function createStockProduct(StockProductTransfer $transferStockProduct);

    /**
     * @param \Generated\Shared\Transfer\w $stockProductTransfer
     *
     * @return int
     */
    public function updateStockProduct(StockProductTransfer $stockProductTransfer);

    /**
     * @return array
     */
    public function getAvailableStockTypes();

    /**
     * @param int $idProductConcrete
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer[]
     */
    public function getStockProductsByIdProduct($idProductConcrete);
}
