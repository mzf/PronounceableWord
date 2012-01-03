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

class PronounceableWord_Tests_Configuration_LinkedLettersTest extends PHPUnit_Framework_TestCase {
    public function testAreAllLettersInAtLeastOneLinkedLetters() {
        foreach (PronounceableWord_Configuration_LinkedLetters::$lettersWithLinkedLetters as $letter => $linkedLettersToIgnore) {
            $isInAtLeastOneLinkedLetters = false;
            foreach (PronounceableWord_Configuration_LinkedLetters::$lettersWithLinkedLetters as $letterToIgnore => $linkedLetters) {
                $isLetterInLinkedLetters = strpos($linkedLetters, $letter);

                if (false !== $isLetterInLinkedLetters) {
                    $isInAtLeastOneLinkedLetters = true;
                    break;
                }
            }

            $this->assertTrue($isInAtLeastOneLinkedLetters);
        }
    }

    public function testAreAllLinkedLettersInLetters() {
        foreach (PronounceableWord_Configuration_LinkedLetters::$lettersWithLinkedLetters as $letterToIgnore => $linkedLetters) {
            $isLinkedLetterInLetters = false;
            foreach (PronounceableWord_Configuration_LinkedLetters::$lettersWithLinkedLetters as $letter => $linkedLettersToIgnore) {
                $isLetterInLinkedLetters = strpos($linkedLetters, $letter);

                if (false !== $isLetterInLinkedLetters) {
                    $isInAtLeastOneLinkedLetters = true;
                    break;
                }
            }

            $this->assertTrue($isInAtLeastOneLinkedLetters);
        }
    }
}
