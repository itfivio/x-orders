<?php

namespace App\Models;

interface SellasistConnectedModelInterface
{
    public function setSellasistOrderId($sellasistOrderId);
    public function save();
}
