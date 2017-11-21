<?php

namespace Relaxsd\ICalendar\Values;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;

/**
 * Class RecurrenceRule
 *
 * 4.3.10 Recurrence Rule
 *
 * Value Name: RECUR
 *
 * Purpose: This value type is used to identify properties that contain
 * a recurrence rule specification.
 *
 * Formal Definition: The value type is defined by the following
 * notation:
 *
 * recur      = "FREQ"=freq *(
 *
 * ; either UNTIL or COUNT may appear in a 'recur',
 * ; but UNTIL and COUNT MUST NOT occur in the same 'recur'
 *
 * ( ";" "UNTIL" "=" enddate ) /
 * ( ";" "COUNT" "=" 1*DIGIT ) /
 *
 * ; the rest of these keywords are optional,
 * ; but MUST NOT occur more than once
 *
 * ( ";" "INTERVAL" "=" 1*DIGIT )          /
 * ( ";" "BYSECOND" "=" byseclist )        /
 * ( ";" "BYMINUTE" "=" byminlist )        /
 * ( ";" "BYHOUR" "=" byhrlist )           /
 * ( ";" "BYDAY" "=" bywdaylist )          /
 * ( ";" "BYMONTHDAY" "=" bymodaylist )    /
 * ( ";" "BYYEARDAY" "=" byyrdaylist )     /
 * ( ";" "BYWEEKNO" "=" bywknolist )       /
 * ( ";" "BYMONTH" "=" bymolist )          /
 * ( ";" "BYSETPOS" "=" bysplist )         /
 * ( ";" "WKST" "=" weekday )              /
 * ( ";" x-name "=" text )
 * )
 *
 * freq       = "SECONDLY" / "MINUTELY" / "HOURLY" / "DAILY"
 * / "WEEKLY" / "MONTHLY" / "YEARLY"
 *
 * enddate    = date
 * enddate    =/ date-time            ;An UTC value
 *
 * byseclist  = seconds / ( seconds *("," seconds) )
 *
 * seconds    = 1DIGIT / 2DIGIT       ;0 to 59
 *
 * byminlist  = minutes / ( minutes *("," minutes) )
 *
 * minutes    = 1DIGIT / 2DIGIT       ;0 to 59
 *
 * byhrlist   = hour / ( hour *("," hour) )
 *
 * hour       = 1DIGIT / 2DIGIT       ;0 to 23
 *
 * bywdaylist = weekdaynum / ( weekdaynum *("," weekdaynum) )
 *
 * weekdaynum = [([plus] ordwk / minus ordwk)] weekday
 *
 * plus       = "+"
 *
 * minus      = "-"
 *
 * ordwk      = 1DIGIT / 2DIGIT       ;1 to 53
 *
 * weekday    = "SU" / "MO" / "TU" / "WE" / "TH" / "FR" / "SA"
 * ;Corresponding to SUNDAY, MONDAY, TUESDAY, WEDNESDAY, THURSDAY,
 * ;FRIDAY, SATURDAY and SUNDAY days of the week.
 *
 * bymodaylist = monthdaynum / ( monthdaynum *("," monthdaynum) )
 *
 * monthdaynum = ([plus] ordmoday) / (minus ordmoday)
 *
 * ordmoday   = 1DIGIT / 2DIGIT       ;1 to 31
 *
 * byyrdaylist = yeardaynum / ( yeardaynum *("," yeardaynum) )
 *
 * yeardaynum = ([plus] ordyrday) / (minus ordyrday)
 *
 * ordyrday   = 1DIGIT / 2DIGIT / 3DIGIT      ;1 to 366
 *
 * bywknolist = weeknum / ( weeknum *("," weeknum) )
 *
 * weeknum    = ([plus] ordwk) / (minus ordwk)
 *
 * bymolist   = monthnum / ( monthnum *("," monthnum) )
 *
 * monthnum   = 1DIGIT / 2DIGIT       ;1 to 12
 *
 * bysplist   = setposday / ( setposday *("," setposday) )
 *
 * setposday  = yeardaynum
 *
 * Description: If the property permits, multiple "recur" values are
 * specified by a COMMA character (US-ASCII decimal 44) separated list
 * of values. The value type is a structured value consisting of a list
 * of one or more recurrence grammar parts. Each rule part is defined by
 * a NAME=VALUE pair. The rule parts are separated from each other by
 * the SEMICOLON character (US-ASCII decimal 59). The rule parts are not
 * ordered in any particular sequence. Individual rule parts MUST only
 * be specified once.
 *
 * The FREQ rule part identifies the type of recurrence rule. This rule
 * part MUST be specified in the recurrence rule. Valid values include
 * SECONDLY, to specify repeating events based on an interval of a
 * second or more; MINUTELY, to specify repeating events based on an
 * interval of a minute or more; HOURLY, to specify repeating events
 * based on an interval of an hour or more; DAILY, to specify repeating
 * events based on an interval of a day or more; WEEKLY, to specify
 * repeating events based on an interval of a week or more; MONTHLY, to
 * specify repeating events based on an interval of a month or more; and
 * YEARLY, to specify repeating events based on an interval of a year or
 * more.
 *
 * The INTERVAL rule part contains a positive integer representing how
 * often the recurrence rule repeats. The default value is "1", meaning
 * every second for a SECONDLY rule, or every minute for a MINUTELY
 * rule, every hour for an HOURLY rule, every day for a DAILY rule,
 * every week for a WEEKLY rule, every month for a MONTHLY rule and
 * every year for a YEARLY rule.
 *
 * The UNTIL rule part defines a date-time value which bounds the
 * recurrence rule in an inclusive manner. If the value specified by
 * UNTIL is synchronized with the specified recurrence, this date or
 * date-time becomes the last instance of the recurrence. If specified
 * as a date-time value, then it MUST be specified in an UTC time
 * format. If not present, and the COUNT rule part is also not present,
 * the RRULE is considered to repeat forever.
 *
 * The COUNT rule part defines the number of occurrences at which to
 * range-bound the recurrence. The "DTSTART" property value, if
 * specified, counts as the first occurrence.
 *
 * The BYSECOND rule part specifies a COMMA character (US-ASCII decimal
 * 44) separated list of seconds within a minute. Valid values are 0 to
 * 59. The BYMINUTE rule part specifies a COMMA character (US-ASCII
 * decimal 44) separated list of minutes within an hour. Valid values
 * are 0 to 59. The BYHOUR rule part specifies a COMMA character (US-
 * ASCII decimal 44) separated list of hours of the day. Valid values
 * are 0 to 23.
 *
 * The BYDAY rule part specifies a COMMA character (US-ASCII decimal 44)
 * separated list of days of the week; MO indicates Monday; TU indicates
 * Tuesday; WE indicates Wednesday; TH indicates Thursday; FR indicates
 * Friday; SA indicates Saturday; SU indicates Sunday.
 *
 * Each BYDAY value can also be preceded by a positive (+n) or negative
 * (-n) integer. If present, this indicates the nth occurrence of the
 * specific day within the MONTHLY or YEARLY RRULE. For example, within
 * a MONTHLY rule, +1MO (or simply 1MO) represents the first Monday
 * within the month, whereas -1MO represents the last Monday of the
 * month. If an integer modifier is not present, it means all days of
 * this type within the specified frequency. For example, within a
 * MONTHLY rule, MO represents all Mondays within the month.
 *
 * The BYMONTHDAY rule part specifies a COMMA character (ASCII decimal
 * 44) separated list of days of the month. Valid values are 1 to 31 or
 * -31 to -1. For example, -10 represents the tenth to the last day of
 * the month.
 *
 * The BYYEARDAY rule part specifies a COMMA character (US-ASCII decimal
 * 44) separated list of days of the year. Valid values are 1 to 366 or
 * -366 to -1. For example, -1 represents the last day of the year
 * (December 31st) and -306 represents the 306th to the last day of the
 * year (March 1st).
 *
 * The BYWEEKNO rule part specifies a COMMA character (US-ASCII decimal
 * 44) separated list of ordinals specifying weeks of the year. Valid
 * values are 1 to 53 or -53 to -1. This corresponds to weeks according
 * to week numbering as defined in [ISO 8601]. A week is defined as a
 * seven day period, starting on the day of the week defined to be the
 * week start (see WKST). Week number one of the calendar year is the
 * first week which contains at least four (4) days in that calendar
 * year. This rule part is only valid for YEARLY rules. For example, 3
 * represents the third week of the year.
 *
 * Note: Assuming a Monday week start, week 53 can only occur when
 * Thursday is January 1 or if it is a leap year and Wednesday is
 * January 1.
 *
 * The BYMONTH rule part specifies a COMMA character (US-ASCII decimal
 * 44) separated list of months of the year. Valid values are 1 to 12.
 *
 * The WKST rule part specifies the day on which the workweek starts.
 * Valid values are MO, TU, WE, TH, FR, SA and SU. This is significant
 * when a WEEKLY RRULE has an interval greater than 1, and a BYDAY rule
 * part is specified. This is also significant when in a YEARLY RRULE
 * when a BYWEEKNO rule part is specified. The default value is MO.
 *
 * The BYSETPOS rule part specifies a COMMA character (US-ASCII decimal
 * 44) separated list of values which corresponds to the nth occurrence
 * within the set of events specified by the rule. Valid values are 1 to
 * 366 or -366 to -1. It MUST only be used in conjunction with another
 * BYxxx rule part. For example "the last work day of the month" could
 * be represented as:
 *
 * RRULE:FREQ=MONTHLY;BYDAY=MO,TU,WE,TH,FR;BYSETPOS=-1
 *
 * Each BYSETPOS value can include a positive (+n) or negative (-n)
 * integer. If present, this indicates the nth occurrence of the
 * specific occurrence within the set of events specified by the rule.
 *
 * If BYxxx rule part values are found which are beyond the available
 * scope (ie, BYMONTHDAY=30 in February), they are simply ignored.
 *
 * Information, not contained in the rule, necessary to determine the
 * various recurrence instance start time and dates are derived from the
 * Start Time (DTSTART) entry attribute. For example,
 * "FREQ=YEARLY;BYMONTH=1" doesn't specify a specific day within the
 * month or a time. This information would be the same as what is
 * specified for DTSTART.
 *
 * BYxxx rule parts modify the recurrence in some manner. BYxxx rule
 * parts for a period of time which is the same or greater than the
 * frequency generally reduce or limit the number of occurrences of the
 * recurrence generated. For example, "FREQ=DAILY;BYMONTH=1" reduces the
 * number of recurrence instances from all days (if BYMONTH tag is not
 * present) to all days in January. BYxxx rule parts for a period of
 * time less than the frequency generally increase or expand the number
 * of occurrences of the recurrence. For example,
 * "FREQ=YEARLY;BYMONTH=1,2" increases the number of days within the
 * yearly recurrence set from 1 (if BYMONTH tag is not present) to 2.
 *
 * If multiple BYxxx rule parts are specified, then after evaluating the
 * specified FREQ and INTERVAL rule parts, the BYxxx rule parts are
 * applied to the current set of evaluated occurrences in the following
 * order: BYMONTH, BYWEEKNO, BYYEARDAY, BYMONTHDAY, BYDAY, BYHOUR,
 * BYMINUTE, BYSECOND and BYSETPOS; then COUNT and UNTIL are evaluated.
 *
 * Here is an example of evaluating multiple BYxxx rule parts.
 *
 * DTSTART;TZID=US-Eastern:19970105T083000
 * RRULE:FREQ=YEARLY;INTERVAL=2;BYMONTH=1;BYDAY=SU;BYHOUR=8,9;
 * BYMINUTE=30
 *
 * First, the "INTERVAL=2" would be applied to "FREQ=YEARLY" to arrive
 * at "every other year". Then, "BYMONTH=1" would be applied to arrive
 * at "every January, every other year". Then, "BYDAY=SU" would be
 * applied to arrive at "every Sunday in January, every other year".
 * Then, "BYHOUR=8,9" would be applied to arrive at "every Sunday in
 * January at 8 AM and 9 AM, every other year". Then, "BYMINUTE=30"
 * would be applied to arrive at "every Sunday in January at 8:30 AM and
 * 9:30 AM, every other year". Then, lacking information from RRULE, the
 * second is derived from DTSTART, to end up in "every Sunday in January
 * at 8:30:00 AM and 9:30:00 AM, every other year". Similarly, if the
 * BYMINUTE, BYHOUR, BYDAY, BYMONTHDAY or BYMONTH rule part were
 * missing, the appropriate minute, hour, day or month would have been
 * retrieved from the "DTSTART" property.
 *
 * No additional content value encoding (i.e., BACKSLASH character
 * encoding) is defined for this value type.
 *
 * Example: The following is a rule which specifies 10 meetings which
 * occur every other day:
 *
 * FREQ=DAILY;COUNT=10;INTERVAL=2
 *
 * There are other examples specified in the "RRULE" specification.
 *
 * @package Relaxsd\ICalendar\Values\Traits
 */
class RecurrenceRule
{
    use HasXParams;

    // Frequencies from the 2445 RFC
    const FREQUENCY_SECONDLY = 'SECONDLY';
    const FREQUENCY_MINUTELY = 'MINUTELY';
    const FREQUENCY_HOURLY = 'HOURLY';
    const FREQUENCY_DAILY = 'DAILY';
    const FREQUENCY_WEEKLY = 'WEEKLY';
    const FREQUENCY_MONTHLY = 'MONTHLY';
    const FREQUENCY_YEARLY = 'YEARLY';

    // Days from the 2445 RFC
    // Corresponding to SUNDAY, MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY and SUNDAY days of the week.
    const WEEKDAY_SU = 'SU';
    const WEEKDAY_MO = 'MO';
    const WEEKDAY_TU = 'TU';
    const WEEKDAY_WE = 'WE';
    const WEEKDAY_TH = 'TH';
    const WEEKDAY_FR = 'FR';
    const WEEKDAY_SA = 'SA';

    // Week days & Weekend days
    const WEEK_DAYS = [self::WEEKDAY_MO, self::WEEKDAY_TH, self::WEEKDAY_WE, self::WEEKDAY_TU, self::WEEKDAY_FR];
    const WEEKEND_DAYS = [self::WEEKDAY_SA, self::WEEKDAY_SU];

    const OCCURENCE_FIRST = 1;
    const OCCURENCE_SECOND = 2;
    const OCCURENCE_THIRD = 3;
    const OCCURENCE_LAST = -1;
    const OCCURENCE_ONE_BUT_LAST = -2;

    /**
     * The FREQ rule part identifies the type of recurrence rule. This rule
     * part MUST be specified in the recurrence rule. Valid values include
     * SECONDLY, to specify repeating events based on an interval of a
     * second or more; MINUTELY, to specify repeating events based on an
     * interval of a minute or more; HOURLY, to specify repeating events
     * based on an interval of an hour or more; DAILY, to specify repeating
     * events based on an interval of a day or more; WEEKLY, to specify
     * repeating events based on an interval of a week or more; MONTHLY, to
     * specify repeating events based on an interval of a month or more; and
     * YEARLY, to specify repeating events based on an interval of a year or
     * more.
     *
     * freq = "SECONDLY" / "MINUTELY" / "HOURLY" / "DAILY" / "WEEKLY" / "MONTHLY" / "YEARLY"
     *
     * @var string
     */
    protected $frequency;

    /**
     * The INTERVAL rule part contains a positive integer representing how
     * often the recurrence rule repeats. The default value is "1", meaning
     * every second for a SECONDLY rule, or every minute for a MINUTELY
     * rule, every hour for an HOURLY rule, every day for a DAILY rule,
     * every week for a WEEKLY rule, every month for a MONTHLY rule and
     * every year for a YEARLY rule.
     *
     * ( ";" "INTERVAL" "=" 1*DIGIT )
     *
     * @var integer
     */
    protected $interval;

    /**
     * The UNTIL rule part defines a date-time value which bounds the
     * recurrence rule in an inclusive manner. If the value specified by
     * UNTIL is synchronized with the specified recurrence, this date or
     * date-time becomes the last instance of the recurrence. If specified
     * as a date-time value, then it MUST be specified in an UTC time
     * format. If not present, and the COUNT rule part is also not present,
     * the RRULE is considered to repeat forever.
     *
     * ( ";" "UNTIL" "=" enddate ), enddate    = date / enddate
     *
     * @var  \DateTime
     */
    protected $untilDate;

    /**
     * The COUNT rule part defines the number of occurrences at which to
     * range-bound the recurrence. The "DTSTART" property value, if
     * specified, counts as the first occurrence.
     *
     * ( ";" "COUNT" "=" 1*DIGIT )
     *
     * @var integer
     */
    protected $count;

    /**
     * The BYSECOND rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of seconds within a minute. Valid values are 0 to
     * 59.
     *
     *
     * ( ";" "BYSECOND" "=" byseclist )
     * byseclist  = seconds / ( seconds *("," seconds) )
     * seconds    = 1DIGIT / 2DIGIT       ;0 to 59
     *
     * @var integer[]
     */
    protected $bySeconds;

    /**
     * The BYMINUTE rule part specifies a COMMA character (US-ASCII
     * decimal 44) separated list of minutes within an hour. Valid values
     * are 0 to 59.
     *
     * ( ";" "BYMINUTE" "=" byminlist )
     * byminlist  = minutes / ( minutes *("," minutes) )
     * minutes    = 1DIGIT / 2DIGIT       ;0 to 59
     *
     * @var integer[]
     */
    protected $byMinutes;

    /**
     * The BYHOUR rule part specifies a COMMA character (US-
     * ASCII decimal 44) separated list of hours of the day. Valid values
     * are 0 to 23.
     *
     * ( ";" "BYHOUR" "=" byhrlist )
     * byhrlist   = hour / ( hour *("," hour) )
     * hour       = 1DIGIT / 2DIGIT       ;0 to 23
     *
     * @var integer[]
     */
    protected $byHours;

    /**
     * The BYMONTHDAY rule part specifies a COMMA character (ASCII decimal
     * 44) separated list of days of the month. Valid values are 1 to 31 or
     * -31 to -1. For example, -10 represents the tenth to the last day of
     * the month.
     *
     * ( ";" "BYMONTHDAY" "=" bymodaylist )
     * bymodaylist = monthdaynum / ( monthdaynum *("," monthdaynum) )
     * monthdaynum = ([plus] ordmoday) / (minus ordmoday)
     * ordmoday   = 1DIGIT / 2DIGIT       ;1 to 31
     *
     * @var integer[]
     */
    protected $byMonthDays;

    /**
     * The BYYEARDAY rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of days of the year. Valid values are 1 to 366 or
     * -366 to -1. For example, -1 represents the last day of the year
     * (December 31st) and -306 represents the 306th to the last day of the
     * year (March 1st).
     *
     * ( ";" "BYYEARDAY" "=" byyrdaylist )
     * byyrdaylist = yeardaynum / ( yeardaynum *("," yeardaynum) )
     * yeardaynum = ([plus] ordyrday) / (minus ordyrday)
     * ordyrday   = 1DIGIT / 2DIGIT / 3DIGIT      ;1 to 366
     *
     * @var integer[]
     */
    protected $byYearDays;

    /**
     * The BYDAY rule part specifies a COMMA character (US-ASCII decimal 44)
     * separated list of days of the week; MO indicates Monday; TU indicates
     * Tuesday; WE indicates Wednesday; TH indicates Thursday; FR indicates
     * Friday; SA indicates Saturday; SU indicates Sunday.
     *
     * Each BYDAY value can also be preceded by a positive (+n) or negative
     * (-n) integer. If present, this indicates the nth occurrence of the
     * specific day within the MONTHLY or YEARLY RRULE. For example, within
     * a MONTHLY rule, +1MO (or simply 1MO) represents the first Monday
     * within the month, whereas -1MO represents the last Monday of the
     * month. If an integer modifier is not present, it means all days of
     * this type within the specified frequency. For example, within a
     * MONTHLY rule, MO represents all Mondays within the month.
     *
     * ( ";" "BYDAY" "=" bywdaylist )
     * bywdaylist = weekdaynum / ( weekdaynum *("," weekdaynum) )
     * weekdaynum = [([+] ordwk / - ordwk)] weekday
     * ordwk      = 1DIGIT / 2DIGIT       ;1 to 53
     * weekday    = "SU" / "MO" / "TU" / "WE" / "TH" / "FR" / "SA"
     *
     * @var string[]   // Eg '-1SU', 'last sunday within'
     */
    protected $byDays;

    /**
     * The BYWEEKNO rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of ordinals specifying weeks of the year. Valid
     * values are 1 to 53 or -53 to -1. This corresponds to weeks according
     * to week numbering as defined in [ISO 8601]. A week is defined as a
     * seven day period, starting on the day of the week defined to be the
     * week start (see WKST). Week number one of the calendar year is the
     * first week which contains at least four (4) days in that calendar
     * year. This rule part is only valid for YEARLY rules. For example, 3
     * represents the third week of the year.
     *
     * Note: Assuming a Monday week start, week 53 can only occur when
     * Thursday is January 1 or if it is a leap year and Wednesday is
     * January 1.
     *
     *  ( ";" "BYWEEKNO" "=" bywknolist )
     * bywknolist = weeknum / ( weeknum *("," weeknum) )
     * weeknum    = ([plus] ordwk) / (minus ordwk)
     * ordwk      = 1DIGIT / 2DIGIT       ;1 to 53
     *
     * @var integer[]
     */
    protected $byWeekNumbers;

    /**
     * The BYMONTH rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of months of the year. Valid values are 1 to 12.
     *
     * ( ";" "BYMONTH" "=" bymolist )
     * bymolist   = monthnum / ( monthnum *("," monthnum) )
     * monthnum   = 1DIGIT / 2DIGIT       ;1 to 12
     *
     * @var integer[]
     */
    protected $byMonths;

    /**
     * The BYSETPOS rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of values which corresponds to the nth occurrence
     * within the set of events specified by the rule. Valid values are 1 to
     * 366 or -366 to -1. It MUST only be used in conjunction with another
     * BYxxx rule part. For example "the last work day of the month" could
     * be represented as:
     *
     * RRULE:FREQ=MONTHLY;BYDAY=MO,TU,WE,TH,FR;BYSETPOS=-1
     *
     * Each BYSETPOS value can include a positive (+n) or negative (-n)
     * integer. If present, this indicates the nth occurrence of the
     * specific occurrence within the set of events specified by the rule.
     *
     * ( ";" "BYSETPOS" "=" bysplist )
     * bysplist   = setposday / ( setposday *("," setposday) )
     * setposday  = yeardaynum
     * yeardaynum = ([plus] ordyrday) / (minus ordyrday)
     * ordyrday   = 1DIGIT / 2DIGIT / 3DIGIT      ;1 to 366
     *
     * @var integer[]
     */
    protected $bySetPositions;

    /**
     * The WKST rule part specifies the day on which the workweek starts.
     * Valid values are MO, TU, WE, TH, FR, SA and SU. This is significant
     * when a WEEKLY RRULE has an interval greater than 1, and a BYDAY rule
     * part is specified. This is also significant when in a YEARLY RRULE
     * when a BYWEEKNO rule part is specified. The default value is MO.
     *
     * weekday    = "SU" / "MO" / "TU" / "WE" / "TH" / "FR" / "SA"
     *
     * @var  string
     */
    protected $weekStart;

    /**
     * RecurrenceRuleValue constructor.
     *
     * @param string|null $frequency
     */
    public function __construct($frequency = null)
    {
        $this->frequency = $frequency;
    }

    /**
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param string $frequency
     *
     * @return $this
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUntilDate()
    {
        return $this->untilDate;
    }

    /**
     * @param \DateTime $untilDate
     *
     * @return $this
     */
    public function setUntilDate($untilDate)
    {
        $this->untilDate = $untilDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Repeats the rule n times.
     *
     * @param int $count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param int $interval
     *
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * @return integer[]
     */
    public function getBySeconds()
    {
        return $this->bySeconds;
    }

    /**
     * @param integer[] $atSeconds
     */
    public function setBySeconds($atSeconds)
    {
        $this->bySeconds = $atSeconds;
    }

    /**
     * @return integer[]
     */
    public function getByMinutes()
    {
        return $this->byMinutes;
    }

    /**
     * @param integer[] $atMinutes
     */
    public function setByMinutes($atMinutes)
    {
        $this->byMinutes = $atMinutes;
    }

    /**
     * @return integer[]
     */
    public function getByHours()
    {
        return $this->byHours;
    }

    /**
     * @param integer[] $atHours
     */
    public function setByHours($atHours)
    {
        $this->byHours = $atHours;
    }

    /**
     * @return string[]
     */
    public function getByDays()
    {
        return $this->byDays;
    }

    /**
     * @param string[] $atDays
     */
    public function setByDays($atDays)
    {
        $this->byDays = $atDays;
    }

    /**
     * @return integer[]
     */
    public function getByMonthDays()
    {
        return $this->byMonthDays;
    }

    /**
     * @param integer[] $atMonthDays
     */
    public function setByMonthDays($atMonthDays)
    {
        $this->byMonthDays = $atMonthDays;
    }

    /**
     * @return integer[]
     */
    public function getByYearDays()
    {
        return $this->byYearDays;
    }

    /**
     * @param integer[] $atYearDays
     */
    public function setByYearDays($atYearDays)
    {
        $this->byYearDays = $atYearDays;
    }

    /**
     * @return integer[]
     */
    public function getByWeekNumbers()
    {
        return $this->byWeekNumbers;
    }

    /**
     * @param integer[] $atWeekNumbers
     */
    public function setByWeekNumbers($atWeekNumbers)
    {
        $this->byWeekNumbers = $atWeekNumbers;
    }

    /**
     * @return integer[]
     */
    public function getByMonths()
    {
        return $this->byMonths;
    }

    /**
     * @param integer[] $atMonths
     */
    public function setByMonths($atMonths)
    {
        $this->byMonths = $atMonths;
    }

    /**
     * @return integer[]
     */
    public function getBySetPositions()
    {
        return $this->bySetPositions;
    }

    /**
     * @param integer[] $atSetPositions
     */
    public function setBySetPositions($atSetPositions)
    {
        $this->bySetPositions = $atSetPositions;
    }

    /**
     * @return string
     */
    public function getWeekStart()
    {
        return $this->weekStart;
    }

    /**
     * @param string $weekStart
     *
     * @return $this
     */
    public function setWeekStart($weekStart)
    {
        $this->weekStart = $weekStart;
        return $this;
    }

    // =================================== Constructors, providing a fluent interface

    public static function secondly()
    {
        return new self(self::FREQUENCY_SECONDLY);
    }

    public static function minutely()
    {
        return new self(self::FREQUENCY_MINUTELY);
    }

    public static function hourly()
    {
        return new self(self::FREQUENCY_HOURLY);
    }

    public static function weekly()
    {
        return new self(self::FREQUENCY_WEEKLY);
    }

    public static function monthly()
    {
        return new self(self::FREQUENCY_MONTHLY);
    }

    public static function yearly()
    {
        return new self(self::FREQUENCY_YEARLY);
    }

    // =================================== Setters, providing a fluent interface

    /**
     * Repeats the rule n times.
     * Alias for setCount()
     *
     * @param int $count
     *
     * @return $this
     */
    public function times($count)
    {
        return $this->setCount($count);
    }

    /**
     * Repeats the rul until a date/time.
     * Alias for setUntilDate().
     *
     * @param \DateTime $untilDate
     *
     * @return $this
     */
    public function until($untilDate)
    {
        return $this->setUntilDate($untilDate);
    }


    /**
     * @param integer|integer[] $atSecond
     *
     * @return $this
     */
    public function atSecond($atSecond)
    {
        $atSeconds = is_array($atSecond) ? $atSecond : func_get_args();

        foreach ($atSeconds as $atSecond) {
            $this->bySeconds[] = $atSecond;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $atMinute
     *
     * @return $this
     */
    public function atMinute($atMinute)
    {
        $atMinutes = is_array($atMinute) ? $atMinute : func_get_args();

        foreach ($atMinutes as $atMinute) {
            $this->byMinutes[] = $atMinute;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $atHour
     *
     * @return $this
     */
    public function atHour($atHour)
    {
        $atHours = is_array($atHour) ? $atHour : func_get_args();

        foreach ($atHours as $atHour) {
            $this->byHours[] = $atHour;
        }

        return $this;
    }

    /**
     * @param string|string[] $atDay
     *
     * @param  integer|null   $dayOccurence
     *
     * @return $this
     */
    public function atDay($atDay, $dayOccurence = null)
    {
        $atDays = (array)$atDay;

        foreach ($atDays as $atDay) {
            $this->byDays[] = isset($dayOccurence) ? "{$dayOccurence}{$atDay}" : $atDay;
        }

        return $this;
    }

    public function atWeekDays($occurence)
    {
        return $this->atDay(self::WEEK_DAYS, $occurence);
    }

    public function atWeekendDays($occurence)
    {
        return $this->atDay(self::WEEKEND_DAYS, $occurence);
    }

    /**
     * @param integer|integer[] $atMonthDay
     *
     * @return $this
     */
    public function atMonthDay($atMonthDay)
    {
        $atMonthDays = is_array($atMonthDay) ? $atMonthDay : func_get_args();

        foreach ($atMonthDays as $atMonthDay) {
            $this->byMonthDays[] = $atMonthDay;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $atYearDay
     *
     * @return $this
     */
    public function atYearDay($atYearDay)
    {
        $atYearDays = is_array($atYearDay) ? $atYearDay : func_get_args();

        foreach ($atYearDays as $atYearDay) {
            $this->byYearDays[] = $atYearDay;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $atWeekNumber
     *
     * @return $this
     */
    public function atWeekNumber($atWeekNumber)
    {
        $atWeekNumbers = is_array($atWeekNumber) ? $atWeekNumber : func_get_args();

        foreach ($atWeekNumbers as $atWeekNumber) {
            $this->byWeekNumbers[] = $atWeekNumber;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $atMonth
     *
     * @return $this
     */
    public function atMonth($atMonth)
    {
        $atMonths = is_array($atMonth) ? $atMonth : func_get_args();

        foreach ($atMonths as $atMonth) {
            $this->byMonths[] = $atMonth;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $atSetPosition
     *
     * @return $this
     */
    public function atSetPosition($atSetPosition)
    {
        $atSetPositions = is_array($atSetPosition) ? $atSetPosition : func_get_args();

        foreach ($atSetPositions as $atSetPosition) {
            $this->bySetPositions[] = $atSetPosition;
        }

        return $this;
    }

    /**
     * @param integer|integer[] $n
     *
     * @return $this
     */
    public function atOccurence($n)
    {
        return $this->atSetPosition($n);
    }

    public function atFirstOccurence()
    {
        return $this->atSetPosition(self::OCCURENCE_FIRST);
    }

    public function atLastOccurence()
    {
        return $this->atSetPosition(self::OCCURENCE_LAST);
    }


    /**
     * @param integer $n
     *
     * @return $this
     */
    public function everySeconds($n)
    {
        return $this->secondly()->setInterval($n);
    }

    /**
     * @param integer $n
     *
     * @return $this
     */
    public function everyMinutes($n)
    {
        return $this->minutely()->setInterval($n);
    }

    /**
     * @param integer $n
     *
     * @return $this
     */
    public function everyHours($n)
    {
        return $this->hourly()->setInterval($n);
    }

    /**
     * @param integer $n
     *
     * @return $this
     */
    public function everyWeeks($n)
    {
        return $this->weekly()->setInterval($n);
    }

    /**
     * @param integer $n
     *
     * @return $this
     */
    public function everyMonths($n)
    {
        return $this->monthly()->setInterval($n);
    }

    /**
     * @param integer $n
     *
     * @return $this
     */
    public function everyYears($n)
    {
        return $this->yearly()->setInterval($n);
    }


}
