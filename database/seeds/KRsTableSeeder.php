<?php

use Illuminate\Database\Seeder;
use App\Kr;

class KRsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $krs = [
            [
                "OKR_id" => 2,
                "title" => "Deliver SSO",
                "description" => "Evaluate Keycloak. ;Develop a unified role & permissions framework for customers, employees and partners.",
                "status" => "Active",
                "vx_impact" => "REV;CET;CEE",
            ],
            [
                "OKR_id" => 2,
                "title" => "Deliver Order Center",
                "description" => "Integrate with SSO. Align NetSuite Item Master.",
                "status" => "Active",
                "vx_impact" => "CET;CEE",
            ],
            [
                "OKR_id" => 2,
                "title" => "Deliver Learning Center (current vXacademy)",
                "status" => "Active",
                "description" => "Integrate with SSO. ;Base on the new Moodle framework + vxacademy.net.",
                "vx_impact" => "REV;CET;CEE",
            ],
            [
                "OKR_id" => 2,
                "title" => "Deliver 100% Accuracy of Product Inventory Records	",
                "status" => "Active",
                "description" => "Need to devise a sampling methodology to establish a baseline.;Need to identify major causes of errors/defects and create a solutions roadmap to address root cause rather than symptoms.",
                "vx_impact" => "REV;CET;CEE",
            ],
            [
                "OKR_id" => 2,
                "title" => "NetSuite License Reduction",
                "status" => "Active",
                "description" => "Need to target Sales and Operations.;Sales: CRM and Order Management Issues (does HubSpot and vX Price solve?).;Operations: Focus on Support Tickets (queue/dispatch workflow and netsuite_cache).",
                "vx_impact" => "COP",
            ],
            [
                "OKR_id" => 2,
                "title" => "Deliver CMMS",
                "status" => "Active",
                "description" => "CMMS will be one of the functions for the Ops Center. ;Is integration with Masscomm necessary? ;Prepare additional inventory imports for database.",
                "vx_impact" => "CET;CEE",
            ]
        ];

        foreach ($krs as $kr) {
            Kr::create($kr);

        }
    }
}
