<?php
/**
 * Created by PhpStorm.
 * User: ibenchu-024
 * Date: 2017/5/24
 * Time: 11:54
 */

namespace Notadd\WechatLogin\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\DataHandler;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class GetAlipayconfHandler.
 */
class GetConfHandler extends DataHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * GetHandler constructor.
     *
     * @param Container $container
     * @param SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    public function data()
    {
        $this->validate($this->request, [
            'app_id' => 'required',
            'app_secret' => 'required'
        ], [
            'app_id.required' => 'app_id参数为必传',
            'app_secret.required' => 'app_secret参数为必传'
        ]);

        $data = [
            'app_id' => $this->settings->get('alipay.alipay_enabled', false),

            'app_secret' => $this->settings->get('alipay.sign_type'),
        ];
    }

    public function execute()
    {
        $this->data();
    }
}
