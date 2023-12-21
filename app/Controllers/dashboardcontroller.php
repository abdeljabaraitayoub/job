<?php

namespace App\Controllers;

use App\Models\offerModel;

class dashboardcontroller
{
    public function dashboard()
    {
        $offer = new offerModel();
        $total = $offer->countTotalJobOffers();
        $active = $offer->countActiveJobOffers();
        $inactive = $offer->countInactiveJobOffers();
        $approved = $offer->countApprovedJobOffers();
        require(__DIR__ . '../../../view/dashboard.php');
    }
}
