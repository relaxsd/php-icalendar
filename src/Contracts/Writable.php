<?php

namespace Relaxsd\ICalendar\Contracts;

interface Writable
{
    function acceptWriter(Writer $formatter);
}
