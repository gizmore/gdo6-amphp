<?php
namespace GDO\AmPHP;

use GDO\Core\GDO_Module;
use GDO\Util\Strings;
use GDO\Core\GDT_Array;

final class Module_AmPHP extends GDO_Module
{
    public function thirdPartyFolders() { return ['/amp/', '/parallel/', '/promise/']; }
    
    public function onInit()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        require 'amp/lib/functions.php';
        require 'amp/lib/Internal/functions.php';
    }
    
    public function autoload($name)
    {
        if (Strings::startsWith($name, 'Amp\\'))
        {
            $name = str_replace('\\', '/', $name);
            $name = Strings::substrFrom($name, 'Amp/');
            require 'amp/lib/' . $name . '.php';
        }
    }
 
    public function hookIgnoreDocsFiles(GDT_Array $ignore)
    {
        $ignore->data[] = 'GDO/AmPHP/amp/**/*';
        $ignore->data[] = 'GDO/AmPHP/parallel/**/*';
        $ignore->data[] = 'GDO/AmPHP/promise/**/*';
    }
    
}
