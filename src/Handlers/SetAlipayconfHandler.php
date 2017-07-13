<?php
/**
 * Created by PhpStorm.
 * User: ibenchu-024
 * Date: 2017/5/24
 * Time: 11:54
 */

namespace Notadd\Multipay\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\SetHandler as AbstractSetHandler;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class AlipayHandler.
 */
class SetAlipayconfHandler extends AbstractSetHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * SetHandler constructor.
     *
     * @param \Illuminate\Container\Container $container
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(
        Container $container,
        SettingsRepository $settings
    )
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        return $this->settings->all()->toArray();
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        $this->settings->set('alipay.input_charset', 'UTF-8');

        $this->settings->set('alipay.version', 1.0);

        $this->settings->set('alipay.sign_type', 'RSA2');

        $this->settings->set('alipay.enabled', $this->request->input('alipay_enabled'));

        $this->settings->set('alipay.app_id', $this->request->input('app_id'));

        $this->settings->set('alipay.private_key', $this->request->input('private_key'));

        $this->settings->set('alipay.public_key', $this->request->input('public_key'));

        $this->settings->set('alipay.alipay_key', $this->request->input('alipay_key'));

        return true;
    }


}
