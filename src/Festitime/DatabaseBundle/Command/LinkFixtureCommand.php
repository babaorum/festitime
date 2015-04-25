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
    protected $mongoManager;

    protected $linksConfig;

    protected $fixturesData;

    protected $documentNamespace = "Festitime\\DatabaseBundle\\Document\\";

    protected function configure()
    {
        $this
            ->setName('festitime:fixtures:link')
            ->setDescription('Link fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputText = '';
        $this->initAttributes();

        foreach ($this->linksConfig['links'] as $documentType => $links) {
            foreach ($links as $fixtureName => $toLinks) {
                $mainDocument = $this->getDocument($documentType, $fixtureName);
                $classWithNamespace = $this->documentNamespace.ucfirst($documentType);

                if ($mainDocument instanceof $classWithNamespace) {
                    $this->linkDocument($mainDocument, $toLinks);
                } else {
                    $outputText .= '<error>Cannot get document of type '.ucfirst($documentType).' with fixture\'s name '.$fixtureName.'</error>';
                }
            }
        }

        if (empty($outputText)) {
            $outputText = '<info>Links have all been generated</info>';
        }
        $output->writeln($outputText);
    }

    protected function linkDocument($mainDocument, $toLinks)
    {
        foreach ($toLinks as $linkDocumentType => $linkFixtureNames) {
            $toCall = 'add'.ucfirst($linkDocumentType);
            foreach ($linkFixtureNames as $linkFixtureName) {
                $toLinkDocument = $this->getDocument($linkDocumentType, $linkFixtureName);
                $mainDocument->$toCall($toLinkDocument);
            }
        }
        $this->mongoManager->persist($mainDocument);
        $this->mongoManager->flush();
    }

    protected function initAttributes()
    {
        //add mongoManager to $this
        $this->getMongoManager();

        //get fixtures content + link fixtures content
        $kernel = $this->getApplication()->getKernel()->getContainer()->get('kernel');
        $path = $kernel->locateResource('@FestitimeDatabaseBundle/Resources/config/link.fixtures.yml');
        $this->linksConfig = Yaml::parse(file_get_contents($path));
        $festivalPath = $kernel->locateResource('@FestitimeDatabaseBundle/Resources/fixtures/festival.fixtures.yml');
        $this->fixturesData['festival'] = Yaml::parse(file_get_contents($festivalPath));
        $artistPath = $kernel->locateResource('@FestitimeDatabaseBundle/Resources/fixtures/artist.fixtures.yml');
        $this->fixturesData['artist'] = Yaml::parse(file_get_contents($artistPath));
    }

    /**
     * Get document row from yaml information
     * @param  string $documentType
     * @param  string $fixtureName
     * @return Document
     */
    protected function getDocument($documentType, $fixtureName)
    {
        $repository     = $this->mongoManager->getRepository('FestitimeDatabaseBundle:'.ucfirst($documentType));
        $elementData    = $this->fixturesData[$documentType]['fixtures'][$fixtureName];
        $elementFilters = $this->linksConfig[$documentType];

        $where = array();
        foreach ($elementFilters as $filter) {
            $where[$filter] = $elementData[$filter];
        }
        return $repository->findOneBy($where);
    }

    protected function getMongoManager()
    {
        $this->mongoManager = $this->getApplication()->getKernel()->getContainer()->get('doctrine_mongodb')->getManager();
    }
}
