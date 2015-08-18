<?php

namespace AppBundle\Service;

use AppBundle\Entity\AccountInterface;
use AppBundle\AccountException;

class AccountService {
    private $account;

    public function __construct(AccountInterface $account){
        $this->account = $account;
    }

    public function withdraw($amount){
        $amountAfterWithDraw = $this->account->getBalance() - $amount;
        if ($amountAfterWithDraw < 0) {
            throw new AccountException();
        } else {
            $this->account->setBalance($amountAfterWithDraw);
        }
    }
}