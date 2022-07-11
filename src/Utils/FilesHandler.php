<?php

namespace App\Utils;

use App\Utils\Checker\AbleToCheckKeyExistence;
use App\Utils\Combination\AbleToHandleCombination;
use App\Utils\Converter\AbleToConvertArray;
use App\Utils\Creator\AbleToCreateCopy;
use App\Utils\Output\AbleToOutputRegister;
use App\Utils\Provider\AbleToProvideArrayKeys;

class FilesHandler
{
    /** @var array  */
    public $configArrays = [];

    /** @var array  */
    public $copiesArrays = [];

    /** @var array  */
    public $tempArrays = [];

    /** @var AbleToConvertArray  */
    private $arrayConverter;

    /** @var AbleToHandleCombination  */
    private $combinationHandler;

    /** @var AbleToProvideArrayKeys  */
    private $arrayKeysProvider;

    /** @var AbleToCheckKeyExistence  */
    private $arrayKeysExistenceChecker;

    /** @var AbleToCreateCopy  */
    private $arrayCopyCreator;

    /** @var AbleToOutputRegister  */
    private $outputRegister;

    /**
     * @param AbleToConvertArray $arrayConverter
     * @param AbleToHandleCombination $combinationHandler
     * @param AbleToProvideArrayKeys $arrayKeysProvider
     * @param AbleToCheckKeyExistence $arrayKeysExistenceChecker
     * @param AbleToCreateCopy $arrayCopyCreator
     * @param AbleToOutputRegister $outputRegister
     */
    public function __construct(
        AbleToConvertArray $arrayConverter,
        AbleToHandleCombination $combinationHandler,
        AbleToProvideArrayKeys $arrayKeysProvider,
        AbleToCheckKeyExistence $arrayKeysExistenceChecker,
        AbleToCreateCopy $arrayCopyCreator,
        AbleToOutputRegister $outputRegister
    )
    {
        $this->arrayConverter = $arrayConverter;
        $this->combinationHandler = $combinationHandler;
        $this->arrayKeysProvider = $arrayKeysProvider;
        $this->arrayKeysExistenceChecker = $arrayKeysExistenceChecker;
        $this->arrayCopyCreator = $arrayCopyCreator;
        $this->outputRegister = $outputRegister;
    }

    /**
     * @param array $baseFile
     * @param array $paramsConfigFile
     */
    public function handle(array $baseFile, array $paramsConfigFile)
    {
        $this->arrayConverter->convertToOneDimensionalArray($paramsConfigFile, $this->configArrays);
        $arrayKeys = array_keys($this->configArrays);
        $baseArrayKeys = $this->arrayKeysProvider->provide($baseFile);
        $atLeastOneKeyExist = $this->arrayKeysExistenceChecker->check($arrayKeys, $baseArrayKeys);

        if ($atLeastOneKeyExist) {
            $this->tempArrays = $this->combinationHandler->combinations($this->configArrays, $arrayKeys);

            foreach ($this->tempArrays as $key => $tempArray) {
                if (!key_exists($key, $this->copiesArrays)) {
                    $this->copiesArrays[$key] = [];
                }

                $this->arrayCopyCreator->create($tempArray, $baseFile, $this->copiesArrays[$key]);
            }
        } else {
            $this->copiesArrays[] = $baseFile;
        }

        $this->outputRegister->registerOutputs($this->copiesArrays);
    }
}