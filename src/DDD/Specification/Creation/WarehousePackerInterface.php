<?php
namespace DDD\Specification\Creation;

/**
 * Interface WarehousePackerInterface (倉庫内格納サービス)
 *
 * @package DDD\Specification\Creation
 */
interface WarehousePackerInterface
{
    /**
     * ドラム缶をコンテナに格納する
     *
     * @param Container[] $containersToFill 格納先コンテナのコレクション
     * @param Drum[] $drumsToPack 格納されるドラム缶のコレクション
     * @return mixed
     */
    public function pack(array $containersToFill, array $drumsToPack);
}
