<?php

namespace FondOfSpryker\Zed\StockApi\Dependency\Facade;

use Generated\Shared\Transfer\StockProductTransfer;

class StockApiToAvailabilityBridge implements StockApiToAvailabilityInterface
{
    /**
     * @var \Spryker\Zed\Stock\Business\StockFacadeInterface
     */
    protected $stockFacade;

    /**
     * @param \Spryker\Zed\Stock\Business\StockFacadeInterface $stockFacade
     */
    public function __construct($stockFacade)
    {
        $this->stockFacade = $stockFacade;
    }

    /**
     * @param string $sku
     *
     * @return int
     */
    public function calculateStockForProduct($sku)
    {
        return $this->stockFacade->calculateStockForProduct($sku);
    }

    /**
     * @param string $sku
     *
     * @return bool
     */
    public function isNeverOutOfStock($sku)
    {
        return $this->stockFacade->isNeverOutOfStock($sku);
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $transferStockProduct
     *
     * @return int
     */
    public function createStockProduct(StockProductTransfer $transferStockProduct)
    {
        return $this->stockFacade->createStockProduct($transferStockProduct);
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $stockProductTransfer
     *
     * @return int
     */
    public function updateStockProduct(StockProductTransfer $stockProductTransfer)
    {
        return $this->stockFacade->updateStockProduct($stockProductTransfer);
    }

    /**
     * @return array
     */
    public function getAvailableStockTypes()
    {
        return $this->stockFacade->getAvailableStockTypes();
    }

    /**
     * @param int $idProductConcrete
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer[]
     */
    public function getStockProductsByIdProduct($idProductConcrete)
    {
        return $this->stockFacade->getStockProductsByIdProduct($idProductConcrete);
    }
}
