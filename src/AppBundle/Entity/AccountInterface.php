<?php

namespace AppBundle\Entity;

interface AccountInterface {
    public function getId();
    public function setBalance($balance);
    public function getBalance();
}