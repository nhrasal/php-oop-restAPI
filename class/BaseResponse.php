<?php 

class BaseResponse{
   static public function responseSuccess($code,$data,$msg){
        return [
            "status"=>$code,
            'data'=>$data,
            "message"=>$msg,
        ];

    }
}
?>