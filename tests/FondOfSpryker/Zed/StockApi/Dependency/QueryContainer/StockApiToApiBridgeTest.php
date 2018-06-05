<?php

namespace FondOfSpryker\Zed\StockApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class StockApiToApiBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiBridge $stockApiToApiBridge
     */
    protected $stockApiToApiBridge;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiCollectionTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiCollectionTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiItemTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['createApiCollection', 'createApiItem', 'getConnection'])
            ->getMock();

        $this->stockApiToApiBridge = new StockApiToApiBridge($this->apiQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection()
    {
        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method("createApiCollection")
            ->willReturn($this->apiCollectionTransferMock);

        $apiCollectionTransfer = $this->stockApiToApiBridge->createApiCollection([]);

        $this->assertInstanceOf("\Generated\Shared\Transfer\ApiCollectionTransfer", $apiCollectionTransfer);
    }

    /**
     * @return void
     */
    public function testCreateApiItem()
    {
        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method("createApiItem")
            ->willReturn($this->apiItemTransferMock);

        $apiItemTransfer = $this->stockApiToApiBridge->createApiItem(1, []);

        $this->assertInstanceOf("\Generated\Shared\Transfer\ApiItemTransfer", $apiItemTransfer);
    }
}
