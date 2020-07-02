<?php
/**
 * Matomo - free/libre analytics platform
 * Plugin developed for Web Analytics Italia (https://webanalytics.italia.it)
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\UsersManagerOnlyAdmin;

use Piwik\Config;
use Piwik\Piwik;
use Piwik\Plugins\UsersManager\UsersManager;

class UsersManagerOnlyAdmin extends \Piwik\Plugin
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $pluginConfig;

    /**
     * Construct a new LoginFilterIp instance.
     */
    public function __construct() {
        parent::__construct();

        $this->pluginConfig = Config::getInstance()->{$this->pluginName};
    }

    /**
     * Get event handlers.
     *
     * @return array the event handlers
     */
    public function registerEvents()
    {
        return [
            'Controller.UsersManager.userSettings' => 'checkUserHasAdminAccess',
        ];
    }

    /**
     * Filter IP using the value of the client IP address.
     */
    public function checkUserHasAdminAccess()
    {
        Piwik::checkUserIsNotAnonymous();
        Piwik::checkUserHasSomeAdminAccess();
        UsersManager::dieIfUsersAdminIsDisabled();
    }
}
