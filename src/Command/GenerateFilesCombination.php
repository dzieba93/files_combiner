<?php

namespace App\Command;

use App\Utils\FilesHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class GenerateFilesCombination extends Command
{
    /** @var string  */
    const WRONG_INPUT_FILES_NAME_MESSAGE = 'The file names are invalid. Check if the files have the following names: zad1-base.json, zad1-params-config.json';

    /** @var string  */
    const INPUT_FILES_PATH = './input_files/';

    /** @var string  */
    const OUTPUT_FILES_PATH = './output_files/';

    /** @var Filesystem  */
    private $fileSystem;

    /** @var FilesHandler  */
    private $filesHandler;

    /**
     * @param Filesystem $fileSystem
     * @param FilesHandler $filesHandler
     */
    public function __construct(
        Filesystem $fileSystem,
        FilesHandler $filesHandler)
    {
        $this->fileSystem = $fileSystem;
        $this->filesHandler = $filesHandler;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:generate-files-combinations')
            ->setDescription('Generate files combinations: zad1-base.json and zad1-params-config.json')
            ->addArgument('base', InputArgument::REQUIRED, 'Base configuration file name.')
            ->addArgument('params-config', InputArgument::REQUIRED, 'Params config file name.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $baseFileName = $input->getArgument('base');
        $paramsConfigFileName = $input->getArgument('params-config');

        $bothExist = $this->fileSystem->exists([self::INPUT_FILES_PATH . $baseFileName, self::INPUT_FILES_PATH . $paramsConfigFileName]);

        if (!$bothExist) {
            return $output->writeln(self::WRONG_INPUT_FILES_NAME_MESSAGE);
        }

        $baseFile = json_decode(file_get_contents(self::INPUT_FILES_PATH . $baseFileName), true);
        $paramsConfigFile = json_decode(file_get_contents(self::INPUT_FILES_PATH . $paramsConfigFileName), true);

        $this->filesHandler->handle($baseFile, $paramsConfigFile);
    }
}