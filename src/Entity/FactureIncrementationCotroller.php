<?php

namespace App\Controller;

use App\Entity\Facture;

class FactureIncrementationController
{
    public function __invoke(Facture $data)
    {
        dd($data);
    }
}