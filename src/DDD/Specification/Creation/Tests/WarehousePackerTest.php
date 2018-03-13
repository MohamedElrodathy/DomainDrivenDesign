<?php
namespace DDD\Specification\Creation\Tests;

use PHPUnit\Framework\TestCase;
use DDD\Specification\Creation\Container;
use DDD\Specification\Creation\ContainerFeature;
use DDD\Specification\Creation\Tnt;
use DDD\Specification\Creation\ContainerSpecification;
use DDD\Specification\Creation\Drum;
use DDD\Specification\Creation\PrototypePacker;

/**
 * Class WarehousePackerTest
 *
 * @package DDD\Specification\Creation\Tests
 */
class WarehousePackerTest extends TestCase
{
    public function testPack()
    {
        $containers[0] = new Container([new ContainerFeature('NORMAL')], 100);
        $containers[1] = new Container([new ContainerFeature('ARMORED')], 100);
        
        $tnt = new Tnt();
        $tnt->setContainerSpecification(new ContainerSpecification(new ContainerFeature('ARMORED')));
        
        $drum    = new Drum(100);
        $drums[] = $drum->setChemical($tnt);
        
        try {
            $prototype = new PrototypePacker();
            
            $prototype->pack($containers, $drums);
            
            $this->assertEmpty($containers[0]->getContents());
            $this->assertInstanceOf('DDD\Specification\Creation\Tnt', $containers[1]->getContents()[0]->getChemical());
        } catch (\Exception $e) {
            $this->fail();
        }
    }
    
    public function testCannotPackIfContainerFeatureMismatch()
    {
        $containers[] = new Container([new ContainerFeature('NORMAL')], 100);
        
        $tnt = new Tnt();
        $tnt->setContainerSpecification(new ContainerSpecification(new ContainerFeature('ARMORED')));
        
        $drum    = new Drum(100);
        $drums[] = $drum->setChemical($tnt);
        
        try {
            $prototype = new PrototypePacker();
            
            $prototype->pack($containers, $drums);
            
            $this->fail();
        } catch (\Exception $e) {
            $this->assertEquals(0, $e->getCode());
        }
    }
    
    public function testCannotPackIfContainerHasNotSpace()
    {
        $containers[] = new Container([new ContainerFeature('ARMORED')], 50);
        
        $tnt = new Tnt();
        $tnt->setContainerSpecification(new ContainerSpecification(new ContainerFeature('ARMORED')));
        
        $drum    = new Drum(100);
        $drums[] = $drum->setChemical($tnt);
        
        try {
            $prototype = new PrototypePacker();
            
            $prototype->pack($containers, $drums);
            
            $this->fail();
        } catch (\Exception $e) {
            $this->assertEquals(0, $e->getCode());
        }
    }
    
    public function testSafelyPacked()
    {
        $tnt = new Tnt();
        $tnt->setContainerSpecification(new ContainerSpecification(new ContainerFeature('ARMORED')));
    
        $drum = new Drum(100);
        $drum->setChemical($tnt);
        
        $container = new Container([new ContainerFeature('ARMORED')], 100);
        $container->setContents($drum);
        
        $this->assertTrue($container->isSafelyPacked());
    }
    
    public function testNotSafelyPackedIfContainerFeatureMismatch()
    {
        $tnt = new Tnt();
        $tnt->setContainerSpecification(new ContainerSpecification(new ContainerFeature('ARMORED')));
        
        $drum = new Drum(100);
        $drum->setChemical($tnt);
        
        $container = new Container([new ContainerFeature('NORMAL')], 100);
        $container->setContents($drum);
        
        $this->assertFalse($container->isSafelyPacked());
    }
}
