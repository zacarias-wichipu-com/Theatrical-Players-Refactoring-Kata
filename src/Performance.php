<?php

declare(strict_types=1);

namespace Theatrical;

class Performance
{
    public function __construct(
        public string $playId,
        public int $audience
    ) {
    }

    public function credit(Play $play): Credit
    {
        $performanceCredit = new Credit(credit: max($this->audience - 30, 0));
        $creditByType = $this->creditByPlayType($play);
        return $performanceCredit->add($creditByType);
    }

    private function creditByPlayType(Play $play): Credit
    {
        if ($play->type === 'comedy') {
            return new Credit(credit: (int)floor($this->audience / 5));
        }
        return new Credit(credit: 0);
    }
}
