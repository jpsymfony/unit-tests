<?php

namespace AppBundle\Twig;

class I18nExtension extends \Twig_Extension
{
    private static $fallback = 'fr';
    private static $format   = array(
        'en'    => ':',
        'fr'    => 'h',
        'fr_FR' => 'h',
        'de'    => ':',
        'nl'    => ':',
        'br'    => 'h'
    );

    public function getFunctions()
    {
        return array(
            'formatTime' => new \Twig_Function_Method($this, 'formatTime'),
        );
    }

    public static function get($locale)
    {
        return (self::$format[$locale])? : self::$format[self::$fallback];
    }

    public static function getDefault()
    {
        return self::get(\Locale::getDefault());
    }

    public static function formatTime($time, $format = ':')
    {
        $timeParts       = explode($format, $time);
        $transformedTime = $timeParts[0] . self::getDefault() . $timeParts[1];

        return $transformedTime;
    }

    public static function formatSingleDayPart($daypart)
    {
        $daypartParts       = explode('-', $daypart);
        $tempDayPart        = self::constructDayPart($daypartParts);
        $daypartTransformed = implode('-', $tempDayPart);

        return $daypartTransformed;
    }

    public static function formatArrayDayPart($dayparts)
    {
        foreach ($dayparts as $keyDayPart => $daypart) {
            if (false !== strpos($daypart, '-')) {
                $daypartParts          = explode('-', $daypart);
                $tempDayPart           = self::constructDayPart($daypartParts);
                $dayparts[$keyDayPart] = implode('-', $tempDayPart);
            } else {
                $tempDayPart        = self::constructDayPart(array($daypart));
                $dayparts[$daypart] = current($tempDayPart);
            }
        }

        return $dayparts;
    }

    public static function constructDayPart($daypartParts)
    {
        $tempDayPart = array();

        foreach ($daypartParts as $hour) {
            if (0 != $hour) {
                $hour = str_pad($hour, 2, '0', STR_PAD_LEFT) . self::getDefault();

                if ('en' == \Locale::getDefault()) {
                    $hour .= '00';
                }
            } else {
                $hour = 'Flexibilité journée';
            }
            $tempDayPart[] = $hour;
        }

        return $tempDayPart;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'i18n_extension';
    }

}