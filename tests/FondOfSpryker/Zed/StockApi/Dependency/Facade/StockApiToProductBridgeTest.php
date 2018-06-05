<?php

namespace FondOfSpryker\Zed\StockApi\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class StockApiToProductBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductBridgeTest $stockApiToProductBridge
     */
    protected $stockApiToProductBridge;

    /**
     * @return void
     */
    public function _before()
    {
        $this->productFacadeMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['findProductConcreteIdBySku'])
            ->getMockForAbstractClass();

        $this->stockApiToProductBridge = new StockApiToProductBridge($this->productFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindProductConcreteIdBySku()
    {
        $this->productFacadeMock->expects($this->atLeastOnce())
            ->method('findProductConcreteIdBySku')
            ->willReturn(1);

        $idConcreteProduct = $this->stockApiToProductBridge->findProductConcreteIdBySku('sku');

        $this->assertEquals(1, $idConcreteProduct);
    }
}
