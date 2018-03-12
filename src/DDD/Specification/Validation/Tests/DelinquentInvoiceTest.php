<?php
namespace DDD\Specification\Tests;

use PHPUnit\Framework\TestCase;
use DDD\Specification\Validation\Customer;
use DDD\Specification\Validation\Invoice;
use DDD\Specification\Validation\DelinquentInvoiceSpecification;

/**
 * Class DelinquentTest
 *
 * @package DDD\Specification\Tests
 */
class DelinquentInvoiceTest extends TestCase
{
    /**
     * @dataProvider invoiceProvider
     *
     * @param Invoice $invoice
     * @param $expected
     */
    public function testInvoiceIsDelinquent(Invoice $invoice, $expected)
    {
        $today = new \DateTime();
        
        $delinquentSpec = new DelinquentInvoiceSpecification($today);
        
        $this->assertSame($expected, $delinquentSpec->isSatisfiedBy($invoice));
    }
    
    /**
     * @return array
     */
    public function invoiceProvider()
    {
        $customer = new Customer(1);
        
        $invoice1 = new Invoice(1, $customer, 1, new \DateTime());
        $customer->setInvoice($invoice1);
        
        $invoice2 = new Invoice(2, $customer, 1, new \DateTime('2018-01-01 00:00:00'));
        $customer->setInvoice($invoice2);
        
        $customer->setPaymentGracePeriod(7);
        
        return [
            'invoice.id = 1 is not delinquent' => [$invoice1, false],
            'invoice.id = 2 is delinquent'     => [$invoice2, true]
        ];
    }
}
