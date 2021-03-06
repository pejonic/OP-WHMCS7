<?php
namespace WeDevelopCoffee\wPower\Core;
use WeDevelopCoffee\wPower\Module\Module;

class Path
{
    /**
     * Core
     *
     * @var instance
     */
    protected $core;

    /**
     * Module
     *
     * @var instance
     */
    protected $module;

    /**
    * __construct
    * @param object $core   
    */
    public function __construct (Core $core, Module $module)
    {  
        $this->core = $core;
        $this->module = $module;
    }


    /**
    * getPath
    * 
    * @return string
    */
    public function getDocRoot ()
    {
        global $customadminpath;

        if($this->core->isCli())
        {
            // DOC_ROOT does not work with cli
            // WARNING: This part of the code is not tested!
            $currentDir = __DIR__;
            $currentDirExploded = explode('modules', $currentDir);

            return $currentDirExploded[0];
        }

        $parts = explode(DIRECTORY_SEPARATOR, getcwd());
        if ($parts[sizeof($parts) - 1] == $customadminpath) {
            unset($parts[sizeof($parts) - 1]);
        }
        return implode(DIRECTORY_SEPARATOR, $parts);
    }

    /**
     * Get the path to the addons folder.
     *
     * @return string
     */
    public function getAddonsPath()
    {
        return $this->getDocRoot() . '/modules/addons/';
    }

    /**
     * Get the path to the current addon
     *
     * @return void
     */
    public function getAddonPath()
    {
        $addon = $this->module->getName();
        return $this->getDocRoot() . '/modules/addons/' . $addon . '/';
    }

    /**
     * Get the path to the current addon
     *
     * @return void
     */
    public function getModulePath()
    {
        $name   = $this->module->getName();
        $type   = $this->module->getType().'s';
        return $this->getDocRoot() . '/modules/'.$type.'/' . $name . '/';
    }
}