<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class ValidationCasemarkController extends Controller
{
    public static function validationCasemark(Request $request){

        $kanban_id  = "R120477200D10001";
        $part_no    = "521190U933";
        $qty        = 250;
        $casemark   = "TMMIN-SP-";
        $manifest   = "R12207720";
        $item_no    = "0001";


        $data = $request->all();
        $total_qty = array_sum(array_column($data, 'qty'));
        foreach($data as $item){
            if(!array_key_exists("kanban_id",$item) || is_null($item["kanban_id"]) || $item["kanban_id"] == "") return ResponseFormatter::error($item,"Kanban ID Cannot Be Null!");
            if(!array_key_exists("part_no",$item) || is_null($item["part_no"]) || $item["part_no"] == "") return ResponseFormatter::error($item,"Part No Cannot Be Null!");
            if(!array_key_exists("casemark",$item) || is_null($item["casemark"]) || $item["casemark"] == "") return ResponseFormatter::error($item,"Casemark/RFID Cannot Be Null!");
            if(!array_key_exists("manifest",$item) || is_null($item["manifest"]) || $item["manifest"] == "") return ResponseFormatter::error($item,"Manifest Cannot Be Null!");
            if(!array_key_exists("item_no",$item) || is_null($item["item_no"]) || $item["item_no"] == "") return ResponseFormatter::error($item,"Item No Cannot Be Null!");
            if(!array_key_exists("case",$item) || is_null($item["case"]) || $item["case"] == "") return ResponseFormatter::error($item,"Case Cannot Be Null!");
            if(!array_key_exists("time",$item) || is_null($item["time"]) || $item["time"] == "") return ResponseFormatter::error($item,"Time Cannot Be Null!");
            if(!array_key_exists("user",$item) || is_null($item["user"]) || $item["user"] == "") return ResponseFormatter::error($item,"User Cannot Be Null!");

            if($item['kanban_id'] != $kanban_id) return ResponseFormatter::error($item,'Kanban Id :'.$item['kanban_id'].' Is Invalid');
            if($item['part_no'] != $part_no) return ResponseFormatter::error($item,'Part No :'.$item['part_no'].' Is Invalid');
            if($item['casemark'] != $casemark) return ResponseFormatter::error($item,'Casemark/RFID :'.$item['part_no'].' Is Invalid');
            if($item['manifest'] != $manifest) return ResponseFormatter::error($item,'Manifest :'.$item['manifest'].' Is Invalid');
            if($item['item_no'] != $item_no) return ResponseFormatter::error($item,'Item No :'.$item['item_no'].' Is Invalid');
            if($total_qty > $qty) return ResponseFormatter::error($item,'Order Qty Kanban Id :'.$item['kanban_id'].', Part No :'.$item['part_no'].', Casemark/RFID :'.$item['part_no'].', Manifest :'.$item['manifest'].', Item_no :'.$item['item_no'].' Exceed Remaining Orders!' );
        }



        return ResponseFormatter::success($request->all());
    }
}
