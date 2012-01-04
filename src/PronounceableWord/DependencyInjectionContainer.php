<?php
/*
 * This file is part of the PronounceableWord library.
 *
 * (c) Loic Chardonnet
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

require_once dirname(__FILE__) . '/Configuration/LinkedLetters.php';
require_once dirname(__FILE__) . '/Configuration/LetterTypes.php';
require_once dirname(__FILE__) . '/Configuration/Generator.php';
require_once dirname(__FILE__) . '/LinkedLetters.php';
require_once dirname(__FILE__) . '/LetterTypes.php';
require_once dirname(__FILE__) . '/LastLettersConsecutiveTypes.php';
require_once dirname(__FILE__) . '/Generator.php';

class PronounceableWord_DependencyInjectionContainer {
    public $configurations = array();

    public function  __construct() {
        $this->configurations['Generator'] = new PronounceableWord_Configuration_Generator();
        $this->configurations['LinkedLetters'] = new PronounceableWord_Configuration_LinkedLetters();
        $this->configurations['LetterTypes'] = new PronounceableWord_Configuration_LetterTypes();
    }

    public function getGenerator() {
        $linkedLetters = new PronounceableWord_LinkedLetters($this->configurations['LinkedLetters']);
        $letterTypes = new PronounceableWord_LetterTypes($this->configurations['LetterTypes']);
        $lastLettersConsecutiveTypes = new PronounceableWord_LastLettersConsecutiveTypes($letterTypes);
        $generator = new PronounceableWord_Generator($linkedLetters, $letterTypes, $lastLettersConsecutiveTypes, $this->configurations['Generator']);

        return $generator;
    }
}
