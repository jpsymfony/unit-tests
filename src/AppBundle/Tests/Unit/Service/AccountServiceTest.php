<?php

namespace AppBundle\Tests\Unit\Service;

use AppBundle\Service\AccountService;
use AppBundle\Entity\Account;

class AccountServiceTest extends \PHPUnit_Framework_TestCase
{
    private $extension = null;

    protected function setUp()
    {
        parent::setUp();
        $this->extension = new AccountService(new Account(500));
    }

    public function testWithdraw()
    {
        $this->setExpectedException('AppBundle\Exception\AccountException');
        $this->extension->withdraw(-1000);
    }

}