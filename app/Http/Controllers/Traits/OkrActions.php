<?php


namespace App\Http\Controllers\Traits;
use App\Kr;
use App\Okr;

trait OkrActions
{
    public function checkKrStatus($id){
        $kr = Kr::find($id);
        $count = $kr->tasks()->where('status', '!=','Completed')->count();
//        dump($kr,$count);
        if($count==0){
            $kr->status="Completed";
            $kr->save();
        }else {
            $kr->status="Active";
            $kr->save();
        }
        $this->checkOKrStatus($kr->OKR_id);
    }


    public function checkOKrStatus($id){
        $okr = Okr::find($id);
        $count = $okr->krs()->where('status', '!=','Completed')->count();
//        dump($kr,$count);
        if($count==0){
            $okr->status="Completed";
            $okr->save();
        }else {
            $okr->status="Active";
            $okr->save();
        }
    }
}
