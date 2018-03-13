<?php
namespace DDD\Specification\Creation;

/**
 * Class PrototypePacker (プロトタイプ格納サービス)
 *
 * @package DDD\Specification\Creation
 */
class PrototypePacker implements WarehousePackerInterface
{
    /**
     * 格納する
     *
     * @param Container[] $containers コンテナのコレクション
     * @param Drum[] $drums ドラム缶のコレクション
     * @throws \Exception
     */
    public function pack(array $containers, array $drums)
    {
        foreach ($drums as $drum) {
            $container = $this->findContainerFor($containers, $drum);
            
            $container->setContents($drum);
        }
    }
    
    /**
     * ドラム缶に合うコンテナを見つける
     *
     * @param Container[] $containers コンテナのコレクション
     * @param Drum $drum ドラム缶
     * @return Container ドラム缶に合うコンテナ
     * @throws \Exception
     */
    public function findContainerFor(array $containers, Drum $drum)
    {
        foreach ($containers as $container) {
            // コンテナがドラム缶を収容できるか
            if ($container->canAccommodate($drum)) {
                return $container;
            }
        }
        throw new \Exception();
    }
}
