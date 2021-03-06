<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Blastar\AdminUserBundle\BlastarAdminUserBundle(),
            new Blastar\FrontUserBundle\BlastarFrontUserBundle(),
			new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Blastar\AdminCategoryBundle\BlastarAdminCategoryBundle(),
            new Blastar\AdminCmsBundle\BlastarAdminCmsBundle(),
            new Blastar\FrontCmsBundle\BlastarFrontCmsBundle(),
            new Blastar\AdminNewsBundle\BlastarAdminNewsBundle(),
            new Blastar\FrontNewsBundle\BlastarFrontNewsBundle(),
            new Admin\ProductBundle\AdminProductBundle(),
            new Admin\WarehouseBundle\AdminWarehouseBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
