<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-19 下午5:20
 */
namespace Notadd\WechatLogin\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Notadd\WechatLogin\help;

/**
 * Class BindHandler.
 */
class BindHandler extends Handler
{
    /**
     * @return $this
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute()
    {
        $this->validate($this->request, [
            'user_id' => 'required',
        ], [
            'user_id.required' => 'user_id为必传参数',
        ]);
        $uid = $this->request->input('user_id');
        $token = help::getToken();
        $socialite = $this->container->make('wechat');
        $driver = $socialite->driver('wechat')->scopes(['snsapi_userinfo']);
        $redirectUrl = url('/api/wechat/bindcallback') . '?token=' . $token . '&user_id=' . $uid;
        $response = $driver->setRedirectUrl($redirectUrl)->redirect();
        $url = $response->getTargetUrl();
        $renderer = new Png();
        $renderer->setHeight(512);
        $renderer->setWidth(512);
        $writer = new Writer($renderer);
        $fileName = 'qrcodeForLogin' . random_int(0, 999999) . '.png';
        $writer->writeFile($url, $fileName);
        $str = file_get_contents(base_path('/public/' . $fileName));
        $base64_qrcode = base64_encode($str);
        $result = $this->container->make('files')->delete(base_path('/public/' . $fileName));
        if ($result) {
            return $this->withCode(200)->withData([
                'qrcode' => $base64_qrcode,
                'token'  => $token,
            ])->withMessage('获取二维码成功');
        } else {
            return $this->withCode(402)->withError('服务器异常,请稍候重试');
        }
    }
}