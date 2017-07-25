<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-13 下午5:30
 */
namespace Notadd\WechatLogin\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Illuminate\Container\Container;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Notadd\WechatLogin\help;
use Notadd\WechatLogin\Models\LoginStatus;

/**
 * Class BackAuthHandler.
 */
class BackAuthHandler extends Handler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * BackAuthHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * @return $this
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function execute()
    {
        $token = help::getToken();
        $login = new LoginStatus();
        $login->token = $token;
        $login->status = 1;//status = 1 代表该用户暂未扫描二维码登陆
        $saveResult = $login->save();
        if (!$saveResult) {
            $this->withCode(400)->withError('保存token失败，请稍候重试');
        }
        $socialite = $this->container->make('wechat');
        $driver = $socialite->driver('wechat')->scopes(['snsapi_userinfo']);
        $redirectUrl = url('/api/wechat/callback') . '?token=' . $token;
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