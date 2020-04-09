<?php

namespace t2cms\composer\installers;

class T2cmsInstaller extends \t2cms\composer\BaseInstaller
{
    protected $locations = array(
        'theme'    => 'cms/themes/{$name}/',
        'module'   => 'cms/modules/{$name}/',
    );
}
