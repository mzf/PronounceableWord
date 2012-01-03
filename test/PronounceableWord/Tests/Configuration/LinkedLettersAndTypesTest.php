<?php
/*
 * This file is part of the PronounceableWord library.
 *
 * (c) Loic Chardonnet
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

require_once dirname(__FILE__) . '/../../../../src/PronounceableWord/Configuration/LinkedLetters.php';
require_once dirname(__FILE__) . '/../../../../src/PronounceableWord/Configuration/LetterTypes.php';
require_once dirname(__FILE__) . '/../../../../src/PronounceableWord/LetterTypes.php';

class PronounceableWord_Tests_Configuration_LinkedLettersAndTypesTest extends PHPUnit_Framework_TestCase {
    public function testAreAllLettersFromLinkedLettersInLettersFromLetterTypes() {
        $letterTypesConfiguration = new PronounceableWord_Configuration_LetterTypes();
        $linkedLettersConfiguration = new PronounceableWord_Configuration_LinkedLetters();

        foreach ($linkedLettersConfiguration->lettersWithLinkedLetters as $letter => $linkedLettersToIgnore) {
            $isLetterInTypes = false;
            foreach ($letterTypesConfiguration->letterTypesWithLetters as $lettersOfType) {
                $isLetterInLetters = strpos($lettersOfType, $letter);

                if (false !== $isLetterInLetters) {
                    $isLetterInTypes = true;
                    break;
                }
            }

            $this->assertTrue($isLetterInTypes);
        }
    }

    public function testHaveLettersAtLeastOneLinkedLetterOfDifferentType() {
        $letterTypesConfiguration = new PronounceableWord_Configuration_LetterTypes();
        $letterTypes = new PronounceableWord_LetterTypes($letterTypesConfiguration);
        $linkedLettersConfiguration = new PronounceableWord_Configuration_LinkedLetters();

        foreach ($linkedLettersConfiguration->lettersWithLinkedLetters as $letter => $linkedLetters) {
            $letterType = $letterTypes->getLetterType($letter);

            $hasOneDifferentType = false;
            $maximumLetterIndex = strlen($linkedLetters);
            for ($letterIndex = 0; $letterIndex < $maximumLetterIndex; $letterIndex++) {
                $linkedLetterType = $letterTypes->getLetterType($linkedLetters[$letterIndex]);

                if ($letterType !== $linkedLetterType) {
                    $hasOneDifferentType = true;
                    break;
                }
            }

            $this->assertTrue($hasOneDifferentType);
        }
    }
}
