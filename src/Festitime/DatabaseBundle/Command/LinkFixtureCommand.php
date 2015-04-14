<?php

namespace Festitime\DatabaseBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class LinkFixtureCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('festitime:fixtures:link')
            ->setDescription('Link fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mongoManager = $this->getApplication()->getKernel()->getContainer()->get('doctrine_mongodb')->getManager();
        $kernel = $this->getApplication()->getKernel()->getContainer()->get('kernel');
        $path = $kernel->locateResource('@FestitimeDatabaseBundle/Resources/config/link.fixtures.yml');
        $yaml = Yaml::parse(file_get_contents($path));
        $festivalPath = $kernel->locateResource('@FestitimeDatabaseBundle/Resources/fixtures/festival.fixtures.yml');
        $fixtures['festival'] = Yaml::parse(file_get_contents($festivalPath));
        $artistPath = $kernel->locateResource('@FestitimeDatabaseBundle/Resources/fixtures/artist.fixtures.yml');
        $fixtures['artist'] = Yaml::parse(file_get_contents($artistPath));

        foreach ($yaml['links'] as $type => $links) {
            foreach ($links as $elementName => $toLinks) {
                $elementData = $fixtures[$type]['fixtures'][$elementName];
                $elementFilters = $yaml[$type];
                $repository = $mongoManager->getRepository('FestitimeDatabaseBundle:'.ucfirst($type));

                $where = array();
                foreach ($elementFilters as $filter) {
                    $where[$filter] = $elementData[$filter];
                }

                $row = $repository->findOneBy($where);
                die(var_dump($row));
            }
        }
        die(var_dump($yaml));
        /*$rbac = $this->getApplication()->getKernel()->getContainer()->get('rbac.manager');
        $text = ($rbac->reset(true)) ? '<info>Root created</info>' : '<comment>Command failed</comment>' ;*/
//        $output->writeln($text);
    }
}
