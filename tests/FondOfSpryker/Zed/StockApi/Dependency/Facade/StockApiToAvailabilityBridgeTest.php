<?php

namespace FondOfSpryker\Zed\StockApi\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\Stock\Business\StockFacadeInterface;

class StockApiToAvailabilityBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Stock\Business\StockFacadeInterface |\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $stockFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductBridge
     */
    protected $stockApiToAvailabilityBridge;

    /**
     * @var \Generated\Shared\Transfer\StockProductTransfer |\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $stockProductTransferMock;

    /**
     * @return void
     */
    public function _before()
    {
        $this->stockFacadeMock = $this->getMockBuilder(StockFacadeInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['calculateStockForProduct', 'createStockProduct', 'getAvailableStockTypes', 'getStockProductsByIdProduct', 'isNeverOutOfStock', 'updateStockProduct'])
            ->getMockForAbstractClass();

        $this->stockProductTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\StockProductTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiToAvailabilityBridge = new StockApiToAvailabilityBridge($this->stockFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindProductConcreteIdBySku()
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('calculateStockForProduct')
            ->willReturn(10);

        $stock = $this->stockApiToAvailabilityBridge->calculateStockForProduct('sku');

        $this->assertEquals(10, $stock);
    }

    /**
     * @return void
     */
    public function testIsNeverOutOfStock()
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('isNeverOutOfStock')
            ->willReturn(false);

        $isNeverOutOfStock = $this->stockApiToAvailabilityBridge->isNeverOutOfStock('sku');

        $this->assertEquals(false, $isNeverOutOfStock);
    }

    /**
     * @return void
     */
    public function testCreateStockProduct()
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('createStockProduct')
            ->willReturn(1);

        $stock = $this->stockApiToAvailabilityBridge->createStockProduct($this->stockProductTransferMock);

        $this->assertEquals(1, $stock);
    }

    /**
     * @return void
     */
    public function testUpdateStockProduct()
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('updateStockProduct')
            ->willReturn(1);

        $stock = $this->stockApiToAvailabilityBridge->updateStockProduct($this->stockProductTransferMock);

        $this->assertEquals(1, $stock);
    }

    /**
     * @return void
     */
    public function testGetAvailableStockTypes()
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('getAvailableStockTypes')
            ->willReturn([]);

        $stockTypes = $this->stockApiToAvailabilityBridge->getAvailableStockTypes();

        $this->assertInternalType('array', $stockTypes);
    }

    /**
     * @return void
     */
    public function testGetStockProductsByIdProduct()
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('getStockProductsByIdProduct')
            ->willReturn($this->stockProductTransferMock);

        $stockProducts = $this->stockApiToAvailabilityBridge->getStockProductsByIdProduct(1);

        $this->assertInstanceOf('Generated\Shared\Transfer\StockProductTransfer', $stockProducts);
    }
}
