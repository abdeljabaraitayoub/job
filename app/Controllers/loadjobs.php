<?php

namespace App\Controllers;

use App\Models\offerModel;
use App\Models\UserModel;

class loadjobs
{

    public function loadjobs()
    {
        $user = new UserModel;
        $offer = new offerModel;
        $user1 = $user->is_logged();


        if (isset($_GET["keywords"]) && isset($_GET["locations"]) && isset($_GET["company"])) {
            $keywords = $_GET["keywords"];
            $location = $_GET["locations"];
            $company = $_GET["company"];
            $jobs = $offer->read($keywords, $location, $company);
        }


        require(__DIR__ . '../../../view/loadjobs.php');
    }
}
