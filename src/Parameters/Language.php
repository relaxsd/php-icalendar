<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class Language
 *
 * 4.2.10 Language
 *
 * Parameter Name: LANGUAGE
 *
 * Purpose: To specify the language for text values in a property or
 * property parameter.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * languageparam =    "LANGUAGE" "=" language
 *
 * language = <Text identifying a language, as defined in [RFC 1766]>
 *
 * Description: This parameter can be specified on properties with a
 * text value type. The parameter identifies the language of the text in
 * the property or property parameter value. The value of the "language"
 * property parameter is that defined in [RFC 1766].
 *
 * For transport in a MIME entity, the Content-Language header field can
 * be used to set the default language for the entire body part.
 * Otherwise, no default language is assumed.
 *
 * Example:
 *
 * SUMMARY;LANGUAGE=us-EN:Company Holiday Party
 *
 * LOCATION;LANGUAGE=en:Germany
 * LOCATION;LANGUAGE=no:Tyskland
 *
 * The following example makes use of the Quoted-Printable encoding in
 * order to represent non-ASCII characters.
 *
 * LOCATION;LANGUAGE=da:K=F8benhavn
 * LOCATION;LANGUAGE=en:Copenhagen
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class Language
{
    use HasValue;

    /**
     * Language constructor.
     *
     * @param string $language
     */
    public function __construct($language)
    {
        $this->setValue($language);
    }

}
