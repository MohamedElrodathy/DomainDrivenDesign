<?php
namespace DDD\Specification\Tests;

use PHPUnit\Framework\TestCase;
use DDD\Specification\Validation\Customer;
use DDD\Specification\Validation\Invoice;
use DDD\Specification\Validation\BigInvoiceSpecification;

/**
 * Class BigInvoiceTest
 *
 * @package DDD\Specification\Tests
 */
class BigInvoiceTest extends TestCase
{
    /**
     * @dataProvider invoiceProvider
     *
     * @param Invoice $invoice
     * @param $expected
     */
    public function testInvoiceIsBig(Invoice $invoice, $expected)
    {
        $bigSpec = new BigInvoiceSpecification(10000);
        
        $this->assertSame($expected, $bigSpec->isSatisfiedBy($invoice));
    }
    
    /**
     * @return array
     */
    public function invoiceProvider()
    {
        $customer = new Customer(1);
        
        $invoice1 = new Invoice(1, $customer, 1, new \DateTime());
        $customer->setInvoice($invoice1);
        
        $invoice2 = new Invoice(2, $customer, 10000, new \DateTime());
        $customer->setInvoice($invoice2);
        
        $customer->setPaymentGracePeriod(7);
        
        return [
            'invoice.id = 1 is not big' => [$invoice1, false],
            'invoice.id = 2 is big '    => [$invoice2, true]
        ];
    }
}