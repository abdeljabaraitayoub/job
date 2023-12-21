<?php

namespace App\Controllers;

use App\Models\offerModel;

class CandidatController
{
    public function candidat()
    {
        $offer = new offerModel();
        $rows = $offer->readoffres();
        require(__DIR__ . '../../../view/candidat.php');
    }
    public function accept()
    {
        $offer = new offerModel();
        $rows = $offer->accept($_GET['id']);
        header('Location:?route=candidat');
    }
    public function refuse()
    {
        $offer = new offerModel();
        $rows = $offer->refuse($_GET['id']);
        header('Location:?route=candidat');
    }
}
