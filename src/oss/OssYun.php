<?php 
 namespace yuan\oss;
 use Mrwanghongda\OssSdk\config\OssConfig;
 use Mrwanghongda\OssSdk\OssFactory;
 class OssYun
 {

    //qiniu
    public static function qiniu($path,$type){
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
    //阿里云
    public static function  ali($path,$type){
    
        $accessKeyId ="";

        $accessKeySecret = "";

        $region = "";

        $bucket = "";
        $config = new OssConfig($accessKeyId, $accessKeySecret, $region);
        $ossObj = (new OssFactory(OssFactory::OSS_ALIYUN))->getOssService();
        $ossObj->init($config)->bucket($bucket);

        $fileName = md5(rand(10000, 99999)) . "." . $type;
        $result = $ossObj->put($fileName, $path)['info']['url'];
        return  $result;
    }

/**
     * $appid   腾讯云的apiid
     * $appkey  腾讯云SecretKey
     * $region  地域
     * $tmp_name 临时文件名
     * $type 文件后缀
     * $bucket  桶名
     * @return string
     * @throws \Mrwanghongda\OssSdk\Exception\ConfigException
     * @throws \Mrwanghongda\OssSdk\Exception\NonsupportOssException
     */
    public static function txYun($path,$type)
    {
        $appid = "";

        $appKey = "";

        $region = "";

        $bucket = "";

        $config = new OssConfig($appid, $appKey, $region);

        $ossObj = (new OssFactory(OssFactory::OSS_TENCENT))->getOssService();

        $ossObj->init($config)->bucket($bucket);

        $fileName = md5(rand(10000, 99999)) . "." . $type;

        $result = $ossObj->put($fileName, $path);

        return "http://" . $result['Location'];
    }
 }