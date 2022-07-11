<?php

namespace App\Utils\Output;

interface AbleToOutputRegister
{
    /**
     * Generate and store copies file ./output_files separated by directories with format ->format('Y_m_d-H-i')
     *
     * @param array $copies
     * @return void
     */
    public function registerOutputs(array $copies) : void;
}