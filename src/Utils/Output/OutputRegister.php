<?php

namespace App\Utils\Output;

use App\Command\GenerateFilesCombination;
use Symfony\Component\Filesystem\Filesystem;

class OutputRegister implements AbleToOutputRegister
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @param Filesystem $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * @inheritDoc
     */
    public function registerOutputs(array $copies) : void
    {
        foreach ($copies as $key => $copy) {
            $nextKey = $key + 1;
            $currentDate = (new \DateTime())->format('Y_m_d-H-i');

            $this->fileSystem->dumpFile(GenerateFilesCombination::OUTPUT_FILES_PATH . $currentDate . '/combination_' . $nextKey . '.json', json_encode($copy));
        }
    }
}