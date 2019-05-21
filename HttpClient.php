namespace app\common\library;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class HttpClient
{
    //错误信息
    private $errorInfo = '';
    //http请求类
    private $httpClient = null;
    //http状态码
    private $httpCode = 200;
    //超时时间(s)
    private static $timeOut = 120;
    public function __construct()
    {
        $this->httpClient = new Client();
    }
    //单例
    private static $_instance = NULL;

    /**
     * 静态工厂方法，返还此类的唯一实例
     * @param int $timeOut   超时时间
     * @return HttpClient|null
     */
    public static function getInstance($timeOut=120)
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        self::$timeOut = $timeOut;
        return self::$_instance;
    }
    /**
     * 通用请求方法
     * @param string  $url        请求地址
     * @param array   $data        请求参数
     * @param string  $method     请求方法（GET/POST）
     * @param bool    $ajax         是否是ajax请求 true是，false不是
     * @param array   $headers     请求头
     * @return bool|string(json/html)
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpClientFun($url='',$data=[],$method='POST',$ajax=false,$headers=[]){
        try {
            $method = strtolower($method);
            //构建请求参数
            $param = [];
            $param['verify'] = false;
            $param['timeout'] = self::$timeOut;
            if($ajax){
                //判断是否为ajax请求
                $param['json'] = $data;
            }else{
                //判断是否为post请求
                if($method=='post')
                {
                    $param['form_params'] = $data;
                }
            }
            //如果请求头不为空，设置请求头
            if(!empty($headers))
            {
                $param['headers'] = $headers;
            }
            //请求
            $response = $this->httpClient->request($method,$url,$param);
            //状态码
            $resStatus = $response->getStatusCode();
            if($resStatus!=200){
                $this->httpCode = $resStatus;
                $this->errorInfo = '请求失败';
                return false;
            }
            $body = $response->getBody();
            $contents = $body->getContents();
            return $contents;
        }catch(TransferException $exception){
            $this->errorInfo = '错误的请求';
            return false;
        }
    }
    //输出错误信息
    public function getErrorInfoStr(){
        return $this->errorInfo;
    }
    //http的请求状态码
    public function getHttpCode()
    {
        return $this->httpCode;
    }
    //返回 GuzzleHttp 原始的客户端
    public function getHttpClient()
    {
        return $this->httpClient;
    }
}
