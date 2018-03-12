<?php
namespace DDD\Constraint\Tests;

use PHPUnit\Framework\TestCase;
use DDD\Constraint\Bucket;

/**
 * Class BucketTest
 *
 * @package DDD\Constraint\Tests
 */
class BucketTest extends TestCase
{
    public function testCanPour()
    {
        $bucket = new Bucket(100);
        
        $bucket->pourIn(1);
        $bucket->pourIn(99);
        
        $this->assertEquals(100, $bucket->getContents());
    }
    
    public function testOverflow()
    {
        $bucket = new Bucket(100);
        
        $bucket->pourIn(101);
        
        $this->assertEquals(100, $bucket->getContents());
    }
}