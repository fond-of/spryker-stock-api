<?php

namespace FondOfSpryker\Zed\StockApi;

use Codeception\Test\Unit;
use Spryker\Shared\Kernel\AbstractLocator;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Spryker\Zed\Stock\Business\StockFacadeInterface;

class StockApiDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Shared\Kernel\BundleProxy |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiMock;

    /**
     * @var \Spryker\Shared\Kernel\BundleProxy |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityMock;

    /**
     * @var \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainer | \PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $availabilityQueryContainerMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Shared\Kernel\AbstractLocator|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $locatorMock;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $productFacadeMock;

    /**
     * @var \Spryker\Shared\Kernel\BundleProxy |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productMock;

    /**
     * @var \Spryker\Zed\Stock\Business\StockFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockFacadeMock;

    /**
     * @var \Spryker\Shared\Kernel\BundleProxy |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\StockApiDependencyProvider $stockApiDependencyProvider
     */
    protected $stockApiDependencyProvider;

    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainer |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainerMock;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->setMethods(['queryContainer'])
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->availabilityMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->setMethods(['queryContainer'])
            ->getMock();

        $this->availabilityQueryContainerMock = $this->getMockBuilder('\Pyz\Zed\Availability\Persistence\AvailabilityQueryContainer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->setMethods(['getLocator'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(AbstractLocator::class)
            ->disableOriginalConstructor()
            ->setMethods(['api', 'availability', 'product', 'stock', 'locate'])
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->setMethods(['facade'])
            ->getMock();

        $this->stockFacadeMock = $this->getMockBuilder(StockFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->setMethods(['facade'])
            ->getMock();

        $this->stockApiDependencyProvider = new StockApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies()
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('api')
            ->willReturn($this->apiMock);

        $this->apiMock->expects($this->atLeastOnce())
            ->method('queryContainer')
            ->willReturn($this->apiQueryContainerMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('availability')
            ->willReturn($this->availabilityMock);

        $this->availabilityMock->expects($this->atLeastOnce())
            ->method('queryContainer')
            ->willReturn($this->availabilityQueryContainerMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('product')
            ->willReturn($this->productMock);

        $this->productMock->expects($this->atLeastOnce())
            ->method('facade')
            ->willReturn($this->productFacadeMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('stock')
            ->willReturn($this->stockMock);

        $this->stockMock->expects($this->atLeastOnce())
            ->method('facade')
            ->willReturn($this->stockFacadeMock);

        $this->stockApiDependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        $valueNames = $this->containerMock->keys();

        $this->assertTrue(in_array(StockApiDependencyProvider::FACADE_PRODUCT, $valueNames));
        $this->assertTrue(in_array(StockApiDependencyProvider::FACADE_STOCK, $valueNames));
        $this->assertTrue(in_array(StockApiDependencyProvider::QUERY_CONTAINER, $valueNames));
        $this->assertTrue(in_array(StockApiDependencyProvider::QUERY_CONTAINER_API, $valueNames));
        $this->assertNotNull($this->containerMock[StockApiDependencyProvider::FACADE_PRODUCT]);
        $this->assertNotNull($this->containerMock[StockApiDependencyProvider::FACADE_STOCK]);
        $this->assertNotNull($this->containerMock[StockApiDependencyProvider::QUERY_CONTAINER]);
        $this->assertNotNull($this->containerMock[StockApiDependencyProvider::QUERY_CONTAINER_API]);
    }
}
