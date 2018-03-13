<?php
namespace DDD\Specification\Creation;

/**
 * Class ContainerFeature (コンテナ機能)
 *
 * @package DDD\Specification\Creation
 */
class ContainerFeature
{
    // 通常コンテナ
    const NORMAL     = 'NORMAL';
    
    // 強化コンテナ
    const ARMORED    = 'ARMORED';
    
    // 通気設備付きコンテナ
    const VENTILATED = 'VENTILATED';
    
    const FEATURES = [self::NORMAL     => self::NORMAL,
                      self::ARMORED    => self::ARMORED,
                      self::VENTILATED => self::VENTILATED];
    
    private $feature;
    
    public function __construct($feature)
    {
        $this->feature = self::FEATURES[$feature];
    }
}
