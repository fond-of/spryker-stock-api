<?php

namespace FondOfSpryker\Zed\StockApi\Business\Model;

use Codeception\Test\Unit;

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
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

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
            ->getMockForAbstractClass();

        $this->spyAvailabilityMock = $this->getMockBuilder("\Orm\Zed\Availability\Persistence\SpyAvailability")
            ->disableOriginalConstructor()
            ->setMethods(['getIdAvailability'])
            ->getMock();

        $this->spyAvailabilityQueryMock = $this->getMockBuilder('\Orm\Zed\Availability\Persistence\Base\SpyAvailabilityQuery')
            ->disableOriginalConstructor()
            ->setMethods(['findOneOrCreate'])
            ->getMock();

        $this->availabilityQueryContainerMock = $this->getMockBuilder('\Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface')
            ->disableOriginalConstructor()
            ->setMethods(['querySpyAvailabilityBySku'])
            ->getMockForAbstractClass();

        $this->apiDataTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiDataTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getData'])
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiItemTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApi = new StockApi(
            $this->apiQueryContainer,
            $this->entityMapperMock,
            $this->transferMapperMock,
            $this->stockFacadeMock,
            $this->availabilityQueryContainerMock
        );
    }

    /**
     * @return void
     */
    public function testUpdateStockOfProduct()
    {
        $this->spyAvailabilityQueryMock
            ->expects($this->atLeastOnce())
            ->method("findOneOrCreate")
            ->willReturn($this->spyAvailabilityMock);

        $this->availabilityQueryContainerMock
            ->expects($this->atLeastOnce())
            ->method('querySpyAvailabilityBySku')
            ->willReturn($this->spyAvailabilityQueryMock);

        $this->spyAvailabilityMock
            ->expects($this->atLeastOnce())
            ->method('getIdAvailability')
            ->willReturn(10);

        $this->apiDataTransferMock
            ->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->data);

        $this->stockFacadeMock
            ->expects($this->atLeastOnce())
            ->method("updateStockProduct")
            ->willReturn(10);

        $this->apiQueryContainer
            ->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $sku = "TST-123-456-789";
        $apiDataTransfer = $this->stockApi->update($sku, $this->apiDataTransferMock);

        $this->assertNotNull($apiDataTransfer);
        $this->assertInstanceOf('\Generated\Shared\Transfer\ApiItemTransfer', $apiDataTransfer);
    }
}
