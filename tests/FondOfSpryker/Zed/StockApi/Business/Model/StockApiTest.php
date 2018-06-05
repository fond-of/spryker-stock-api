<?php

namespace FondOfSpryker\Zed\StockApi\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface;

class StockApiTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityMapperMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transferMapperMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyAvailabilityMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyAvailabilityQueryMock;

    /**
     * @var \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiToProductMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockProductTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Model\StockApi
     */
    protected $stockApi;

    /**
     * @var array
     */
    protected $data = ["quantity" => 0, "is_never_out_of_stock" => true, "stock_type" => "Warehouse1"];

    /**
     * @return void
     */
    protected function _before()
    {
        $this->apiQueryContainer = $this->getMockBuilder('\FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->entityMapperMock = $this->getMockBuilder('\FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->transferMapperMock = $this->getMockBuilder('\FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->stockFacadeMock = $this->getMockBuilder('\FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface')
            ->disableOriginalConstructor()
            ->setMethods(['getStockProductsByIdProduct'])
            ->getMockForAbstractClass();

        $this->spyAvailabilityMock = $this->getMockBuilder("\Orm\Zed\Availability\Persistence\SpyAvailability")
            ->disableOriginalConstructor()
            ->setMethods(['getIdAvailability'])
            ->getMock();

        $this->spyAvailabilityQueryMock = $this->getMockBuilder('\Orm\Zed\Availability\Persistence\Base\SpyAvailabilityQuery')
            ->disableOriginalConstructor()
            ->setMethods(['findOneOrCreate'])
            ->getMock();

        $this->availabilityQueryContainerMock = $this->getMockBuilder("\Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface")
            ->disableOriginalConstructor()
            ->setMethods(['querySpyAvailabilityBySku'])
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiDataTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getData'])
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiItemTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiToProductMock = $this->getMockBuilder(StockApiToProductInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['findProductConcreteIdBySku'])
            ->getMock();

        $this->stockProductTransferMock = $this->getMockBuilder('Generated\Shared\Transfer\StockProductTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApi = new StockApi(
            $this->apiQueryContainer,
            $this->entityMapperMock,
            $this->transferMapperMock,
            $this->stockFacadeMock,
            $this->stockApiToProductMock,
            $this->availabilityQueryContainerMock
        );
    }

    /**
     * @return void
     */
    public function testUpdateStockOfProduct()
    {
        $this->apiDataTransferMock
            ->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->data);

        $this->stockFacadeMock
            ->expects($this->atLeastOnce())
            ->method("updateStockProduct")
            ->willReturn(10);

        $this->stockProductTransferMock->expects($this->any())
            ->method("getStockType")
            ->willReturn("Warehouse1");

        $this->stockFacadeMock
            ->expects($this->atLeastOnce())
            ->method("getStockProductsByIdProduct")
            ->willReturn(
                [
                    "0" => $this->stockProductTransferMock,
                ]
            );

        $this->apiQueryContainer
            ->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->stockApiToProductMock->expects($this->atLeastOnce())
            ->method('findProductConcreteIdBySku')
            ->willReturn(10);

        $sku = "SKU";
        $apiDataTransfer = $this->stockApi->update($sku, $this->apiDataTransferMock);

        $this->assertNotNull($apiDataTransfer);
        $this->assertInstanceOf('\Generated\Shared\Transfer\ApiItemTransfer', $apiDataTransfer);
    }
}
