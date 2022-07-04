<?php 
 namespace Kxm123\Uploads\src\oss;
 class OssYun
 {
    public static function upfile($path,$type){
        $config = new OssConfig(config('yun.qiniu.appid'), config('yun.qiniu.appkey'), '');
        $ossObj = (new OssFactory(OssFactory::OSS_QINIU))->getOssService();
        $ossObj->init($config)->bucket(config('yun.qiniu.bucket'));
        //上传文件
        $url = "http://oss.xxx.work/";

        $fileName = md5(rand(10000, 99999)) . "." . $type;
        $result = $ossObj->put($fileName, $path)['key'];
        if(!$result){
            return '上传失败';
        }
        $result = $ossObj->put($result, $path)['key'];
        return  $url.$result;
    }
 }