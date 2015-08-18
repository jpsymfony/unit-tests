<?php

namespace AppBundle\Tests\Unit\Twig;

use AppBundle\Twig\I18nExtension;

class I18NExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $extension = null;

    protected function setUp()
    {
        parent::setUp();
        $this->extension = new I18nExtension();
    }

    /**
     * @dataProvider formatArrayDayPartProvider
     */
    public function testFormatArrayDayPartWithDataProvider($input, $output) {
        $this->assertEquals($this->extension->formatArrayDayPart($input), $output);
    }

    public function formatArrayDayPartProvider(){
        return array(
            array(
                array(6 => '6', 7 => '7', 10 => '10'),
                array(6  => '06h', 7 => '07h', 10 => '10h')
            ),
            array(
                array(8 => '8', 9 => '9', 15 => '15'),
                array(8 => '08h', 9 => '09h', 15 => '15h')
            ),
            array(
                array(6 => '6-7', 9 => '9-10', 10 => '10-11'),
                array(6 => '06h-07h', 9  => '09h-10h', 10 => '10h-11h')
            ),
        );
    }

    public function testFormatArrayDayPart()
    {
        $horaires = array(6 => '6', 7 => '7', 10 => '10');
        $this->assertEquals(
            $this->extension->formatArrayDayPart($horaires), array(
                '6'  => '06h',
                '7'  => '07h',
                '10' => '10h',
            )
        );
    }

}