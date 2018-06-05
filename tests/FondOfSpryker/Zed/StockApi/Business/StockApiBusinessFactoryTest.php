<?php

namespace FondOfSpryker\Zed\StockApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface;
use FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\StockApi\Business\Model\StockApi;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface;
use FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface;
use FondOfSpryker\Zed\StockApi\StockApiDependencyProvider;
use Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use Spryker\Zed\Kernel\Container;

class StockApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainerMock;

    /**
     * @var \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityQueryContainerMock;

    /**
     * @var \Spryker\Zed\Kernel\AbstractBundleConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityMapperMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory
     */
    protected $stockBusinessFactory;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transferMapperMock;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiQueryContainerMock = $this->getMockBuilder(StockApiToApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->availabilityQueryContainerMock = $this->getMockBuilder(AvailabilityQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(AbstractBundleConfig::class)
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityMapperMock = $this->getMockBuilder(EntityMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(StockApiToProductInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockFacadeMock = $this->getMockBuilder(StockApiToAvailabilityInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockBusinessFactory = new StockApiBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateStockApi()
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('offsetGet')
            ->withConsecutive(
                [StockApiDependencyProvider::QUERY_CONTAINER_API],
                [StockApiDependencyProvider::FACADE_STOCK],
                [StockApiDependencyProvider::FACADE_PRODUCT],
                [StockApiDependencyProvider::QUERY_CONTAINER]
            )->willReturnOnConsecutiveCalls(
                $this->apiQueryContainerMock,
                $this->stockFacadeMock,
                $this->productFacadeMock,
                $this->availabilityQueryContainerMock
            );

        $this->stockBusinessFactory
            ->setConfig($this->configMock)
            ->setContainer($this->containerMock);

        $stockApi = $this->stockBusinessFactory->createStockApi();

        $this->assertInstanceOf(StockApi::class, $stockApi);
    }
}
