<?php

declare(strict_types=1);

namespace Mad\Base;

use Mad\Base\Exception\BaseInvalidArgException;
use Mad\Utility\Sanitizer;

class BaseEntity
{

    public function __construct(array $dirtyData)
    {
        if (empty($dirtyData)) {
            throw new BaseInvalidArgException('No data was submitted');
        }

        if (is_array($dirtyData)) {
            foreach ($this->cleanData($dirtyData) as $key => $value) {
                $this->$key = $value;
            }
        }
    }


    private function cleanData(array $dirtyData): array
    {
        $cleanData = Sanitizer::clean($dirtyData);
        if ($cleanData) {
            return $cleanData;
        }
    }
}