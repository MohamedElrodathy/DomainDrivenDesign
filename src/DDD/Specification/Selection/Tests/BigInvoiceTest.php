<?php
namespace DDD\Specification\Selection\Tests;

use PHPUnit\Framework\TestCase;
use DDD\Specification\Selection\InvoiceRepository;
use DDD\Specification\Selection\BigInvoiceSpecification;
use DDD\Specification\Selection\Invoice;

/**
 * Class BigInvoiceTest
 *
 * @package DDD\Specification\Selection\Tests
 */
class BigInvoiceTest extends TestCase
{
    public function testInvoiceIsBig()
    {
        $repository = new InvoiceRepository();
        
        $bigSpec = new BigInvoiceSpecification(10000);
        
        /** @var Invoice[] $bigInvoices */
        $bigInvoices = $repository->findSatisfying($bigSpec);
        
        $this->assertEquals(3, $bigInvoices[0]->getId());
    }
}
