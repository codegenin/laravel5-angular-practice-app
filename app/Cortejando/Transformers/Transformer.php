<?php

namespace App\Cortejando\Transformers;


abstract class Transformer
{
    /**
     * Transform a collection of items
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * Transform a single item
     *
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}