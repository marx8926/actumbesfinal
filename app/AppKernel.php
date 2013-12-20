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
            new AE\DataBundle\AEDataBundle(),
            new AE\UserBundle\UserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new AE\ConfigurarBundle\AEConfigurarBundle(),
            new AE\GanarBundle\AEGanarBundle(),
            new AE\ServiciosBundle\AEServiciosBundle(),
            new AE\ServicesBundle\AEServicesBundle(),
            new AE\GanaBundle\AEGanaBundle(),
            new AE\ContabilidadBundle\AEContabilidadBundle(),
            new AE\ToolBundle\AEToolBundle(),
            new AE\EnviaBundle\AEEnviaBundle(),
            new AE\ConsolidaBundle\AEConsolidaBundle(),
            new AE\DiscipulaBundle\AEDiscipulaBundle(),
            new AE\SecretariaBundle\AESecretariaBundle(),
            new Ps\PdfBundle\PsPdfBundle(),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
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
