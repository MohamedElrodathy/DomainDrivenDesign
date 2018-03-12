<?php
namespace DDD\Specification\Selection\Tests;

use PHPUnit\Framework\TestCase;
use DDD\Specification\Selection\InvoiceRepository;
use DDD\Specification\Selection\DelinquentInvoiceSpecification;
use DDD\Specification\Selection\Invoice;

/**
 * Class DelinquentInvoiceTest
 *
 * @package DDD\Specification\Selection\Tests
 */
class DelinquentInvoiceTest extends TestCase
{
    public function testInvoiceIsDelinquent()
    {
        $repository = new InvoiceRepository();
        
        $delinquentSpec = new DelinquentInvoiceSpecification(new \DateTime());
        
        /** @var Invoice[] $delinquentInvoices */
        $delinquentInvoices = $repository->findSatisfying($delinquentSpec);
        
        $this->assertEquals(2, $delinquentInvoices[0]->getId());
    }
}
