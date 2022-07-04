<?php
namespace yuan\oss\call;

use yuan\oss\OssYun;

class Call
{
//调用文件上传
public static function upfiles($fileType,$path,$type){
if($fileType=="qiniu"){
    return OssYun::qiniu($path,$type);
}elseif($fileType=="ali"){
    return OssYun::ali($path,$type);
}elseif($fileType=="txYun"){
    return OssYun::txYun($path,$type);
}else{
    return "参数错误";
}
}

}