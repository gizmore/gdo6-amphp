<?php
namespace GDO\AmPHP;

use GDO\Core\GDO_Module;
use GDO\Util\Strings;

final class Module_AmPHP extends GDO_Module
{
    public function thirdPartyFolders() { return ['/amp/', '/parallel/', '/promise/']; }
    
    public function onInit()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        require_once 'amp/lib/functions.php';
        require_once 'amp/lib/Internal/functions.php';
    }
    
    public function autoload($name)
    {
        if (Strings::startsWith($name, 'Amp\\'))
        {
            $name = str_replace('\\', '/', $name);
            $name = Strings::substrFrom($name, 'Amp/');
            require_once 'amp/lib/' . $name . '.php';
        }
    }
    
}
