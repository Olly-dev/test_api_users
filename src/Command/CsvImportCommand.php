<?php

namespace App\Command;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;

/**
 * class import the csv file and save the data in the database
 */
class CsvImportCommand extends Command
{
    /**
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * constructeur 
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     *  function configure the command in the terminal
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Import a CSV file');
    }

    /**
     *  function import the csv file and save the data in the database
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting to import the feed...');

        $reader = Reader::createFromPath('%kernel.project_dir%/../src/data/data.csv');
        $result = $reader->fetchColumn();

        foreach ($result as $row) {
            $ligne = explode(";", $row);
            $identifiant = $ligne[0];
            $nom = $ligne[1];
            $prenom = $ligne[2];
            $telephone = $ligne[3];
            if ($identifiant !== 'identifiant') {
                $member = (new Member())
                    ->setNom($nom)
                    ->setPrenom($prenom)
                    ->setTelephone($telephone);
                $this->em->persist($member);
            }
        }

        $this->em->flush();
        $io->success('the file was successfully imported');
        return 1;
    }
}
