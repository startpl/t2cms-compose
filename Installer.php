<?php

namespace t2cms\composer;

use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Installer\LibraryInstaller;
use t2cms\composer\installers\T2cmsInstaller;

class Installer extends LibraryInstaller
{
    const PREFIX_TYPE = 't2cms';
    
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $installer = new T2cmsInstaller($package, $this->composer, $this->getIO());
        return $installer->getInstallPath($package, self::PREFIX_TYPE);
    }

    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::uninstall($repo, $package);
        $installPath = $this->getPackageBasePath($package);
        $this->io->write(sprintf('Deleting %s - %s', $installPath, !file_exists($installPath) ? '<comment>deleted</comment>' : '<error>not deleted</error>'));
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {   
        if(substr($packageType, 0, strlen(self::PREFIX_TYPE)) !== self::PREFIX_TYPE){
            return false;
        }
        
        $locationPattern = $this->getLocationPattern();
        return (bool)preg_match('#' . self::PREFIX_TYPE . '-' . $locationPattern . '#', $packageType);
    }

    protected function getLocationPattern()
    {
        $installer = new T2cmsInstaller(null, $this->composer, $this->getIO());
        $locations = array_keys($installer->getLocations());
        $pattern = $locations ? '(' . implode('|', $locations) . ')' : false;

        return $pattern ? : '(\w+)';
    }

    /**
     * Get I/O object
     *
     * @return IOInterface
     */
    private function getIO()
    {
        return $this->io;
    }
}
