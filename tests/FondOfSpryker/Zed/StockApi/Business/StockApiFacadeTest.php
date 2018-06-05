<?php

namespace FondOfSpryker\Zed\StockApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\StockApi\Business\Model\StockApi;
use FondOfSpryker\Zed\StockApi\Business\Model\Validator\StockApiValidator;

class StockApiFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Model\StockApi|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Model\Validator\StockApiValidator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiValidatorMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiBusinessFactoryMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\StockApiFacadeInterface
     */
    protected $stockApiFacade;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->apiDataTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiDataTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiItemTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiMock = $this->getMockBuilder(StockApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['update'])
            ->getMock();

        $this->stockApiBusinessFactoryMock = $this->getMockBuilder(StockApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['createStockApi', 'createStockApiValidator'])
            ->getMock();

        $this->stockApiValidatorMock = $this->getMockBuilder(StockApiValidator::class)
            ->disableOriginalConstructor()
            ->setMethods(['validate'])
            ->getMock();

        $this->stockApiFacade = new StockApiFacade();
    }

    /**
     * @return void
     */
    public function testUpdateStock()
    {
        $this->stockApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createStockApi')
            ->willReturn($this->stockApiMock);

        $this->stockApiMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->apiItemTransferMock);

        $this->stockApiFacade->setFactory($this->stockApiBusinessFactoryMock);
        $stock = $this->stockApiFacade->updateStock(1, $this->apiDataTransferMock);

        $this->assertInstanceOf('\Generated\Shared\Transfer\ApiItemTransfer', $stock);
    }

    /**
     * @return void
     */
    public function testValidate()
    {
        $this->stockApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createStockApiValidator')
            ->willReturn($this->stockApiValidatorMock);

        $this->stockApiValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->willReturn([]);

        $this->stockApiFacade->setFactory($this->stockApiBusinessFactoryMock);
        $errors = $this->stockApiFacade->validate($this->apiDataTransferMock);

        $this->assertInternalType('array', $errors);
    }
}
