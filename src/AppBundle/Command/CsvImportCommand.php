<?php

namespace AppBundle\Command;

use AppBundle\Entity\race;
use AppBundle\Entity\Competitor;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CsvImportCommand
 * @package AppBundle\ConsoleCommand
 */
class CsvImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CsvImportCommand constructor.
     *
     * @param EntityManagerInterface $em
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Imports the mock CSV data file')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting import of Feed...');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/AppBundle/Data/RACE_DATA.csv');

      
        $results = $reader->fetchAssoc();

        $io->progressStart(count($results));

        foreach ($results as $row) {
           
                $race = (new Race())
                ->setFullName($row['fullName'])
                ->setDistance($row['distance'])
                ->setTime($row['time'])
                ->setAgecategory($row['ageCategory']);
                
            

            $this->em->persist($race);

            // do a lookup for existing Competitor matching some combination of fields
            $competitor = $this->em->getRepository('AppBundle:Competitor')
                ->findOneBy([
                    'fullname' => $row['fullName'],
                    'distance' => $row['distance'],
                    'time' => $row['time'],
                    'agecategory' => $row['ageCategory'],
                ]);

            if ($competitor === null) {
                // or create new Competitor
                $competitor = (new Competitor())
                ->setFullName($row['fullName'])
                ->setDistance($row['distance'])
                ->setTime($row['time'])
                ->setAgecategory($row['ageCategory']);

                $this->em->persist($competitor);
            }

            $race->setCompetitor($competitor);

            $io->progressAdvance();
        }

        $this->em->flush();

        $io->progressFinish();
        $io->success('Command exited cleanly!');
    }
}