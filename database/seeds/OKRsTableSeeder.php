<?php
use Illuminate\Database\Seeder;

use App\Okr;

class OKRsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $okrs[] = [
            "created_by" => 4,
            "OKRs_title" => "Provide a platform to manage OKRs, KR, Tasks and reports",
            "description" => "the expanded button shows the descriptions off okr, krs, and tasks. The statuses are inherited from the children on every update. example. an OKR with 1 kr that has 3 completed task and 1 active. OKR->Active KR->Active tasks->active 1 completed 3. when the last task gets completed the OKR and KR will change to Completed too.",
            "status" => "Proposed",
            "categories" => ["#Q2C", "#P&S", "#BO"],
            "contributors" => ["@BS", "@SW", "@QA", "@ARCH"],
            "impact_groups" => ["PAR", "CUS", "EMP"],
            "target_date" => "2019-12-20"
        ];
        $okrs[] = [
            "created_by" => 1,
            "OKRs_title" => "Deliver a unified on-line experience for customers, partners and employees to gain access to the primary tools and information they require, improving service and reducing costs.",
            "description" => "This involves merging the capabilities of in\site, vX Tools, vX Price and vXacademy into a single UX/UI experience for the end user accessible via one username and password and controlled by a unified role and permissions framework.",
            "status" => "Proposed",
            "categories" => ["#Q2C", "#P&S", "#BO"],
            "contributors" => ["@BS", "@SW", "@QA", "@ARCH"],
            "impact_groups" => ["PAR", "CUS", "EMP"],
            "target_date" => "2019-12-20"
        ];
        $okrs[] = [
            "created_by" => 1,
            "OKRs_title" => "Deliver a single Order Management solution which supports the configuration, workflow and order types required by employees, partners and customers.",
            "description" => "This involves basically building a fully functional CPQ tool, merging the existing capabilities found in vX Price and BPTool.",
            "status" => "Proposed",
            "categories" =>["#Q2C"],
            "contributors" => ["@BS", "@SW", "@QA", "@ARCH"],
            "impact_groups" => ["PAR", "CUS", "EMP"],
            "target_date" => "2019-12-20"
        ];

        foreach ($okrs as $okr) {
            Okr::create($okr);
        }
    }
}
