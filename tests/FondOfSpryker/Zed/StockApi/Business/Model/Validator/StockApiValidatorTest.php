<?php

namespace FondOfSpryker\Zed\StockApi\Business\Model\Validator;

use Codeception\Test\Unit;

class StockApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransfer;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Model\Validator
     */
    protected $stockApiValidator;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->apiDataTransfer = $this->getMockBuilder('\Generated\Shared\Transfer\ApiDataTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getData'])
            ->getMock();

        $this->stockApiValidator = new StockApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate()
    {
        $data = [
            "stock_type" => "Warehouse 1",
            "quantity" => 10,
            "is_never_out_of_stock" => false,
        ];

        $this->apiDataTransfer->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $errors = $this->stockApiValidator->validate($this->apiDataTransfer);

        $this->assertInternalType('array', $errors);
    }
}
