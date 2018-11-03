<?php

namespace Relaxsd\ICalendar\Formatter;

use Relaxsd\ICalendar\Components\AudioAlarm;
use Relaxsd\ICalendar\Components\Calendar;
use Relaxsd\ICalendar\Components\DisplayAlarm;
use Relaxsd\ICalendar\Components\EmailAlarm;
use Relaxsd\ICalendar\Components\Event;
use Relaxsd\ICalendar\Components\FreeBusy;
use Relaxsd\ICalendar\Components\Journal;
use Relaxsd\ICalendar\Components\ProcedureAlarm;
use Relaxsd\ICalendar\Components\TimeZone;
use Relaxsd\ICalendar\Components\Todo;
use Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip;
use Relaxsd\ICalendar\Parameters\CalendarUserType;
use Relaxsd\ICalendar\Parameters\CommonName;
use Relaxsd\ICalendar\Parameters\DirectoryEntryReference;
use Relaxsd\ICalendar\Parameters\GroupOrListMembership;
use Relaxsd\ICalendar\Parameters\Language;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Properties\Alarm\AbsoluteTrigger;
use Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger;
use Relaxsd\ICalendar\Properties\Calendar\ProductIdentifier;
use Relaxsd\ICalendar\Properties\DateTime\DateTimeStart;
use Relaxsd\ICalendar\Properties\DateTime\FreeBusy as FreeBusyProperty;
use Relaxsd\ICalendar\Properties\Descriptive\Attachment;
use Relaxsd\ICalendar\Properties\Descriptive\BinaryAttachment;
use Relaxsd\ICalendar\Properties\Descriptive\Comment;
use Relaxsd\ICalendar\Properties\Descriptive\UriAttachment;
use Relaxsd\ICalendar\Properties\Misc\RequestStatus;
use Relaxsd\ICalendar\Properties\Misc\XProperty;
use Relaxsd\ICalendar\Properties\Recurrence\ExceptionDate;
use Relaxsd\ICalendar\Properties\Recurrence\ExceptionRule;
use Relaxsd\ICalendar\Properties\Recurrence\RecurrenceDate;
use Relaxsd\ICalendar\Properties\Recurrence\RecurrenceRule;
use Relaxsd\ICalendar\Properties\Relationship\Attendee;
use Relaxsd\ICalendar\Properties\Relationship\RecurrenceId;
use Relaxsd\ICalendar\Properties\Relationship\RelatedTo;
use Relaxsd\ICalendar\Values\DurationPeriod;
use Relaxsd\ICalendar\Values\ExplicitPeriod;
use Relaxsd\ICalendar\Values\RecurrenceDatePeriod;
use Relaxsd\ICalendar\Values\RecurrenceDateTime;

/**
 * Class ICalendarWriter
 * Writes a calendar in vCalendar output
 *
 * @package Relaxsd\ICalendar\Formatter
 */
class ICalendarWriter extends BaseWriter
{

    /**
     * ICalendarWriter constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @param \Relaxsd\ICalendar\Components\Calendar $calendar
     *
     * @return $this
     */
    public function writeCalendar(Calendar $calendar)
    {
        $this->line('BEGIN:VCALENDAR');

        $this
            ->writeProductIdentifierProperty($calendar->getProductIdentifier())
            ->writeVersionProperty($calendar->getVersion())
            ->writeCalendarScaleProperty($calendar->getCalendarScale())
            ->writeMethodProperty($calendar->getMethod())
            ->writeXPropertiesProperties($calendar->getXProperties());

        foreach ($calendar->getEvents() as $event) {
            $event->acceptWriter($this);
        }
        foreach ($calendar->getTodos() as $todo) {
            $todo->acceptWriter($this);
        }
        foreach ($calendar->getJournals() as $journal) {
            $journal->acceptWriter($this);
        }
        foreach ($calendar->getFreeBusies() as $freeBusy) {
            $freeBusy->acceptWriter($this);
        }
        foreach ($calendar->getTimeZones() as $timeZone) {
            $timeZone->acceptWriter($this);
        }
//        foreach ($calendar->getIanaComponents() as $ianaComponent) {
//            $ianaComponent->acceptWriter($this);
//        }
//        foreach ($calendar->getExperimentalComponents() as $experimentalComponent) {
//            $experimentalComponent->acceptWriter($this);
//        }

        $this->line('END:VCALENDAR');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\Event $event
     *
     * @return $this
     */
    public function writeEvent(Event $event)
    {
        $this->line('BEGIN:VEVENT');

        $this
            ->writeClassificationProperty($event->getClassification())
            ->writeDateTimeCreatedProperty($event->getDateTimeCreated())
            ->writeDescriptionProperty($event->getDescription())
            ->writeDateTimeStartProperty($event->getDateTimeStart())
            ->writeGeographicPositionProperty($event->getGeographicPosition())
            ->writeLastModifiedProperty($event->getLastModified())
            ->writeLocationProperty($event->getLocation())
            ->writeOrganizerProperty($event->getOrganizer())
            ->writePriorityProperty($event->getPriority())
            ->writeDateTimeStampProperty($event->getDateTimeStamp())
            ->writeSequenceNumberProperty($event->getSequenceNumber())
            ->writeStatusProperty($event->getStatus())
            ->writeSummaryProperty($event->getSummary())
            ->writeTimeTransparencyProperty($event->getTimeTransparency())
            ->writeUniqueIdentifierProperty($event->getUniqueIdentifier())
            ->writeUrlProperty($event->getUrl())
            ->writeRecurrenceIdProperty($event->getRecurrenceId());

        $this
            ->writeDateTimeEndProperty($event->getDateTimeEnd())
            ->writeDurationProperty($event->getDuration());

        $this
            ->writeAttachmentsProperties($event->getAttachments())
            ->writeAttendeesProperties($event->getAttendees())
            ->writeCategoriesProperty($event->getCategories())
            ->writeCommentsProperties($event->getComments())
            ->writeContactsProperties($event->getContacts())
            ->writeExceptionDatesProperties($event->getExceptionDates())
            ->writeExceptionRulesProperties($event->getExceptionRules())
            ->writeRequestStatusesProperties($event->getRequestStatuses())
            ->writeRelatedTosProperties($event->getRelatedTos())
            ->writeResourcesProperty($event->getResources())
            ->writeRecurrenceDatesProperties($event->getRecurrenceDates())
            ->writeRecurrenceRulesProperties($event->getRecurrenceRules())
            ->writeXPropertiesProperties($event->getXProperties());

        foreach ($event->getAlarms() as $alarm) {
            $alarm->acceptWriter($this);
        }

        $this->line('END:VEVENT');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\Todo $todo
     *
     * @return $this
     */
    public function writeTodo(Todo $todo)
    {
        $this->line('BEGIN:VTODO');

        $this
            ->writeClassificationProperty($todo->getClassification())
            ->writeDateTimeCompletedProperty($todo->getDateTimeCompleted())
            ->writeDateTimeCreatedProperty($todo->getDateTimeCreated())
            ->writeDescriptionProperty($todo->getDescription())
            ->writeDateTimeStampProperty($todo->getDateTimeStamp())
            ->writeDateTimeStartProperty($todo->getDateTimeStart())
            ->writeGeographicPositionProperty($todo->getGeographicPosition())
            ->writeLastModifiedProperty($todo->getLastModified())
            ->writeLocationProperty($todo->getLocation())
            ->writeOrganizerProperty($todo->getOrganizer())
            ->writePercentCompleteProperty($todo->getPercentComplete())
            ->writePriorityProperty($todo->getPriority())
            ->writeRecurrenceIdProperty($todo->getRecurrenceId())
            ->writeSequenceNumberProperty($todo->getSequenceNumber())
            ->writeStatusProperty($todo->getStatus())
            ->writeSummaryProperty($todo->getSummary())
            ->writeUniqueIdentifierProperty($todo->getUniqueIdentifier())
            ->writeUrlProperty($todo->getUrl());

        $this
            ->writeDateTimeDueProperty($todo->getDateTimeDue())
            ->writeDurationProperty($todo->getDuration());

        $this
            ->writeAttachmentsProperties($todo->getAttachments())
            ->writeAttendeesProperties($todo->getAttendees())
            ->writeCategoriesProperty($todo->getCategories())
            ->writeCommentsProperties($todo->getComments())
            ->writeContactsProperties($todo->getContacts())
            ->writeExceptionDatesProperties($todo->getExceptionDates())
            ->writeExceptionRulesProperties($todo->getExceptionRules())
            ->writeRequestStatusesProperties($todo->getRequestStatuses())
            ->writeRelatedTosProperties($todo->getRelatedTos())
            ->writeResourcesProperty($todo->getResources())
            ->writeRecurrenceDatesProperties($todo->getRecurrenceDates())
            ->writeRecurrenceRulesProperties($todo->getRecurrenceRules())
            ->writeXPropertiesProperties($todo->getXProperties());

        $this->line('END:VTODO');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\AudioAlarm $alarm
     *
     * @return $this
     */
    public function writeAudioAlarm(AudioAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this
            ->writeActionProperty($alarm->getAction())
            ->writeAttachmentProperty($alarm->getAttachment())
            ->writeDurationProperty($alarm->getDuration())
            ->writeRepeatCountProperty($alarm->getRepeatCount())
            ->writeTriggerProperty($alarm->getTrigger())
            ->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\DisplayAlarm $alarm
     *
     * @return $this
     */
    public function writeDisplayAlarm(DisplayAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this
            ->writeActionProperty($alarm->getAction())
            ->writeDescriptionProperty($alarm->getDescription())
            ->writeDurationProperty($alarm->getDuration())
            ->writeRepeatCountProperty($alarm->getRepeatCount())
            ->writeTriggerProperty($alarm->getTrigger())
            ->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\EmailAlarm $alarm
     *
     * @return $this
     */
    public function writeEmailAlarm(EmailAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this
            ->writeActionProperty($alarm->getAction())
            ->writeAttachmentProperty($alarm->getAttachment())
            ->writeAttendeesProperties($alarm->getAttendees())
            ->writeDescriptionProperty($alarm->getDescription())
            ->writeDurationProperty($alarm->getDuration())
            ->writeRepeatCountProperty($alarm->getRepeatCount())
            ->writeSummaryProperty($alarm->getSummary())
            ->writeTriggerProperty($alarm->getTrigger())
            ->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\ProcedureAlarm $alarm
     *
     * @return $this
     */
    public function writeProcedureAlarm(ProcedureAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this
            ->writeActionProperty($alarm->getAction())
            ->writeAttachmentProperty($alarm->getAttachment())
            ->writeDescriptionProperty($alarm->getDescription())
            ->writeDurationProperty($alarm->getDuration())
            ->writeRepeatCountProperty($alarm->getRepeatCount())
            ->writeTriggerProperty($alarm->getTrigger())
            ->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\FreeBusy $freeBusy
     *
     * @return $this
     */
    public function writeFreeBusy(FreeBusy $freeBusy)
    {

        $this->line('BEGIN:VFREEBUSY');

        $this
            ->writeContactProperty($freeBusy->getContact())
            ->writeDateTimeStartProperty($freeBusy->getDateTimeStart())
            ->writeDateTimeEndProperty($freeBusy->getDateTimeEnd())
            ->writeDurationProperty($freeBusy->getDuration())
            ->writeDateTimeStampProperty($freeBusy->getDateTimeStamp())
            ->writeOrganizerProperty($freeBusy->getOrganizer())
            ->writeUniqueIdentifierProperty($freeBusy->getUniqueIdentifier())
            ->writeUrlProperty($freeBusy->getUrl());

        $this
            ->writeAttendeesProperties($freeBusy->getAttendees())
            ->writeCommentsProperties($freeBusy->getComments())
            ->writeFreeBusiesProperties($freeBusy->getFreeBusies())
            ->writeRequestStatusesProperties($freeBusy->getRequestStatuses())
            ->writeXPropertiesProperties($freeBusy->getXProperties());

        $this->line('END:VFREEBUSY');

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\TimeZone $timeZone
     *
     * @return $this
     */
    public function writeTimeZone(TimeZone $timeZone)
    {
        // TODO: Implement writeTimeZone() method.
        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Components\Journal $journal
     *
     * @return $this
     */
    public function writeJournal(Journal $journal)
    {
        $this->line('BEGIN:VJOURNAL');

        $this
            ->writeClassificationProperty($journal->getClassification())
            ->writeDateTimeCreatedProperty($journal->getDateTimeCreated())
            ->writeDescriptionProperty($journal->getDescription())
            ->writeDateTimeStartProperty($journal->getDateTimeStart())
            ->writeDateTimeStampProperty($journal->getDateTimeStamp())
            ->writeLastModifiedProperty($journal->getLastModified())
            ->writeOrganizerProperty($journal->getOrganizer())
            ->writeRecurrenceIdProperty($journal->getRecurrenceId())
            ->writeSequenceNumberProperty($journal->getSequenceNumber())
            ->writeStatusProperty($journal->getStatus())
            ->writeSummaryProperty($journal->getSummary())
            ->writeUniqueIdentifierProperty($journal->getUniqueIdentifier())
            ->writeUrlProperty($journal->getUrl());

        $this
            ->writeAttachmentsProperties($journal->getAttachments())
            ->writeAttendeesProperties($journal->getAttendees())
            ->writeCategoriesProperty($journal->getCategories())
            ->writeCommentsProperties($journal->getComments())
            ->writeContactsProperties($journal->getContacts())
            ->writeExceptionDatesProperties($journal->getExceptionDates())
            ->writeExceptionRulesProperties($journal->getExceptionRules())
            ->writeRelatedTosProperties($journal->getRelatedTos())
            ->writeRecurrenceDatesProperties($journal->getRecurrenceDates())
            ->writeRecurrenceRulesProperties($journal->getRecurrenceRules())
            ->writeRequestStatusesProperties($journal->getRequestStatuses())
            ->writeXPropertiesProperties($journal->getXProperties());

        $this->line('END:VJOURNAL');

        return $this;
    }

    // ============================ PROPERTIES ===============================

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart $dateTime
     *
     * @return $this
     */
    protected function writeDateTimeStartProperty($dateTime)
    {
        if (isset($dateTime)) {
            $this->writeProperty('DTSTART',
                array_merge(
                    self::getTimezoneIdentifierParam($dateTime->getTimezoneIdentifier()),
                    $this->getValueDataTypeParams($dateTime->getValueDataType(), DateTimeStart::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($dateTime->getXParams())
                ),
                self::formatDate($dateTime->getDateTime(), $dateTime->getValueDataType())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd $dateTime
     *
     * @return $this
     */
    protected function writeDateTimeEndProperty($dateTime)
    {
        if (isset($dateTime)) {
            $this->writeProperty('DTEND',
                array_merge(
                    self::getTimezoneIdentifierParam($dateTime->getTimezoneIdentifier()),
                    self::getXParamsParams($dateTime->getXParams())
                ),
                self::formatDate($dateTime->getDateTime())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\Duration $duration
     *
     * @return $this
     */
    protected function writeDurationProperty($duration)
    {
        if (isset($duration)) {
            $this->writeProperty('DURATION',
                array_merge(
                    self::getXParamsParams($duration->getXParams())
                ),
                self::formatDuration($duration->getDuration())
            );
        }


        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeDue $dateTime
     *
     * @return $this
     */
    protected function writeDateTimeDueProperty($dateTime)
    {
        if (isset($dateTime)) {
            $this->writeProperty('DUE',
                array_merge(
                    self::getTimezoneIdentifierParam($dateTime->getTimezoneIdentifier()),
                    self::getXParamsParams($dateTime->getXParams())
                ),
                self::formatDate($dateTime->getDateTime())
            );
        }


        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeCreated $dateTime
     *
     * @return $this
     */
    protected function writeDateTimeCreatedProperty($dateTime)
    {
        if (isset($dateTime)) {
            $this->writeProperty('CREATED',
                array_merge(
                    self::getXParamsParams($dateTime->getXParams())
                ),
                self::formatDate($dateTime->getDateTime())
            );
        }


        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted $dateTime
     *
     * @return $this
     */
    protected function writeDateTimeCompletedProperty($dateTime)
    {
        if (isset($dateTime)) {
            $this->writeProperty('COMPLETED',
                array_merge(
                    self::getXParamsParams($dateTime->getXParams())
                ),
                self::formatDate($dateTime->getDateTime())
            );
        }


        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeStamp $dateTime
     *
     * @return $this
     */
    protected function writeDateTimeStampProperty($dateTime)
    {
        if (isset($dateTime)) {
            $this->writeProperty('DTSTAMP',
                array_merge(
                    self::getXParamsParams($dateTime->getXParams())
                ),
                self::formatDate($dateTime->getDateTime())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\LastModified $lastModified
     *
     * @return $this
     */
    protected function writeLastModifiedProperty($lastModified)
    {
        if (isset($lastModified)) {
            $this->writeProperty('LAST-MODIFIED',
                array_merge(
                    self::getXParamsParams($lastModified->getXParams())
                ),
                self::formatDate($lastModified->getDateTime())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Organizer $organizer
     *
     * @return $this
     */
    protected function writeOrganizerProperty($organizer)
    {
        if (isset($organizer)) {
            $this->writeProperty('ORGANIZER',
                array_merge(
                    self::getCommonNameParams($organizer->getCommonName()),
                    self::getDirectoryEntryReferenceParams($organizer->getDirectoryEntryReference()),
                    self::getLanguageParams($organizer->getLanguage()),
                    self::getSentByParams($organizer->getSentBy()),
                    self::getXParamsParams($organizer->getXParams())
                ),
                $organizer->getCalendarUserAddress()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\PercentComplete $percentComplete
     *
     * @return $this
     */
    protected function writePercentCompleteProperty($percentComplete)
    {
        if (isset($percentComplete)) {
            $this->writeProperty('PERCENT-COMPLETE',
                array_merge(
                    self::getXParamsParams($percentComplete->getXParams())
                ),
                $percentComplete->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Priority $priority
     *
     * @return $this
     */
    protected function writePriorityProperty($priority)
    {
        if (isset($priority)) {
            $this->writeProperty('PRIORITY',
                array_merge(
                    self::getAlternateTextRepresentation($priority->getAlternateTextRepresentation()),
                    self::getLanguageParams($priority->getLanguage()),
                    self::getXParamsParams($priority->getXParams())
                ),
                $priority->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\RecurrenceId $recurrenceId
     *
     * @return $this
     */
    protected function writeRecurrenceIdProperty($recurrenceId)
    {
        if (isset($recurrenceId)) {
            $this->writeProperty('RECURRENCE-ID',
                array_merge(
                    self::getTimezoneIdentifierParams($recurrenceId->getTimezoneIdentifier()),
                    self::getRecurrenceIdentifierRangeParams($recurrenceId->getRecurrenceIdentifierRange()),
                    $this->getValueDataTypeParams($recurrenceId->getValueDataType(), RecurrenceId::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($recurrenceId->getXParams())
                ),
                $recurrenceId->getDateTime()
            );
        }
        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\SequenceNumber $sequenceNumber
     *
     * @return $this
     */
    protected function writeSequenceNumberProperty($sequenceNumber)
    {
        if (isset($sequenceNumber)) {
            $this->writeProperty('SEQUENCE',
                array_merge(
                    self::getXParamsParams($sequenceNumber->getXParams())
                ),
                $sequenceNumber->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Status $status
     *
     * @return $this
     */
    protected function writeStatusProperty($status)
    {
        if (isset($status)) {
            $this->writeProperty('STATUS',
                array_merge(
                    self::getXParamsParams($status->getXParams())
                ),
                self::escapeText($status->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Summary $summary
     *
     * @return $this
     */
    protected function writeSummaryProperty($summary)
    {
        if (isset($summary)) {
            $this->writeProperty('SUMMARY',
                array_merge(
                    self::getAlternateTextRepresentation($summary->getAlternateTextRepresentation()),
                    self::getLanguageParams($summary->getLanguage()),
                    self::getXParamsParams($summary->getXParams())
                ),
                self::escapeText($summary->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\TimeTransparency $timeTransparency
     *
     * @return $this
     */
    protected function writeTimeTransparencyProperty($timeTransparency)
    {
        if (isset($timeTransparency)) {
            $this->writeProperty('TRANSP',
                array_merge(
                    self::getXParamsParams($timeTransparency->getXParams())
                ),
                $timeTransparency->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\UniqueIdentifier $uniqueIdentifier
     *
     * @return $this
     */
    protected function writeUniqueIdentifierProperty($uniqueIdentifier)
    {
        if (isset($uniqueIdentifier)) {
            $this->writeProperty('UID',
                array_merge(
                    self::getXParamsParams($uniqueIdentifier->getXParams())
                ),
                self::escapeText($uniqueIdentifier->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Location $location
     *
     * @return $this
     */
    protected function writeLocationProperty($location)
    {
        if (isset($location)) {
            $this->writeProperty('LOCATION',
                array_merge(
                    self::getAlternateTextRepresentation($location->getAlternateTextRepresentation()),
                    self::getLanguageParams($location->getLanguage()),
                    self::getXParamsParams($location->getXParams())
                ),
                self::escapeText($location->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Url $url
     *
     * @return $this
     */
    protected function writeUrlProperty($url)
    {
        if (isset($url)) {
            $this->writeProperty('URL',
                array_merge(
                    self::getXParamsParams($url->getXParams())
                ),
                $url->getUri()
            );
        }

        return $this;
    }

    /**
     * @param ProductIdentifier|null $productIdentifier
     *
     * @return $this
     */
    protected function writeProductIdentifierProperty($productIdentifier)
    {
        if (isset($productIdentifier)) {
            $this->writeProperty('PRODID',
                array_merge(
                    self::getXParamsParams($productIdentifier->getXParams())
                ),
                $productIdentifier->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\Version $version
     *
     * @return $this
     */
    protected function writeVersionProperty($version)
    {
        if (isset($version)) {
            $this->writeProperty('VERSION',
                array_merge(
                    self::getXParamsParams($version->getXParams())
                ),
                // TODO: Support min and max version
                $version->getVersion()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\CalendarScale $calendarScale
     *
     * @return $this
     */
    protected function writeCalendarScaleProperty($calendarScale)
    {
        if (isset($calendarScale)) {
            $this->writeProperty('CALSCALE',
                array_merge(
                    self::getXParamsParams($calendarScale->getXParams())
                ),
                $calendarScale->getIanaToken()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\Method $method
     *
     * @return $this
     */
    protected function writeMethodProperty($method)
    {
        if (isset($method)) {
            $this->writeProperty('METHOD',
                array_merge(
                    self::getXParamsParams($method->getXParams())
                ),
                $method->getIanaToken()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Classification $classification
     *
     * @return $this
     */
    protected function writeClassificationProperty($classification)
    {
        if (isset($classification)) {
            $this->writeProperty('CLASS',
                array_merge(
                    self::getXParamsParams($classification->getXParams())
                ),
                $classification->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Description $description
     *
     * @return $this
     */
    protected function writeDescriptionProperty($description)
    {
        if (isset($description)) {
            $this->writeProperty('DESCRIPTION',
                array_merge(
                    self::getAlternateTextRepresentation($description->getAlternateTextRepresentation()),
                    self::getLanguageParams($description->getLanguage()),
                    self::getXParamsParams($description->getXParams())
                ),
                self::escapeText($description->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Attendee[] $attendees
     *
     * @return $this
     */
    protected function writeAttendeesProperties($attendees)
    {
        if (isset($attendees)) {
            foreach ($attendees as $attendee) {
                $this->writeAttendeeProperty($attendee);
            }
        }

        return $this;
    }

    /**
     * @param Attendee $attendee
     *
     * @return $this
     */
    protected function writeAttendeeProperty($attendee)
    {
        if (isset($attendee)) {
            $this->writeProperty('ATTENDEE',

                array_merge(
                    self::getCalendarUserTypeParams($attendee->getCalendarUserType()),
                    self::getGroupOrListMembershipParams($attendee->getGroupOrListMembership()),
                    self::getParticipationRoleParams($attendee->getParticipationRole()),
                    self::getParticipationStatusParams($attendee->getParticipationStatus()),
                    self::getRsvpExpectationParams($attendee->getRsvpExpectation()),
                    self::getDelegateesParams($attendee->getDelegatees()),
                    self::getDelegatorsParams($attendee->getDelegators()),
                    self::getSentByParams($attendee->getSentBy()),
                    self::getCommonNameParams($attendee->getCommonName()),
                    self::getDirectoryEntryReferenceParams($attendee->getDirectoryEntryReference()),
                    self::getLanguageParams($attendee->getLanguage()),
                    self::getXParamsParams($attendee->getXParams())
                ),
                $attendee->getCalendarUserAddress()
            );
        }

        return $this;
    }

    /**
     * @param Attachment[] $attachments
     *
     * @return $this
     */
    protected function writeAttachmentsProperties($attachments)
    {
        if (isset($attachments)) {
            foreach ($attachments as $attachment) {
                $this->writeAttachmentProperty($attachment);
            }
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\Action $action
     *
     * @return $this
     */
    protected function writeActionProperty($action)
    {
        if (isset($action)) {
            $this->writeProperty('ACTION',

                array_merge(
                    self::getXParamsParams($action->getXParams())
                ),
                $action->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\RepeatCount $repeatCount
     *
     * @return $this
     */
    protected function writeRepeatCountProperty($repeatCount)
    {
        if (isset($repeatCount)) {
            $this->writeProperty('REPEAT',

                array_merge(
                    self::getXParamsParams($repeatCount->getXParams())
                ),
                $repeatCount->getValue()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\Trigger $trigger
     *
     * @return $this
     */
    protected function writeTriggerProperty($trigger)
    {
        if (isset($trigger)) {
            if ($trigger instanceof AbsoluteTrigger) {
                $this->writeAbsoluteTriggerProperty($trigger);
            } elseif ($trigger instanceof RelativeTrigger) {
                $this->writeRelativeTriggerProperty($trigger);
            } else {
                throw new \LogicException('Unsupported Trigger type');
            }
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\AbsoluteTrigger $absoluteTrigger
     *
     * @return $this
     */
    protected function writeAbsoluteTriggerProperty($absoluteTrigger)
    {
        if (isset($absoluteTrigger)) {
            $this->writeProperty('TRIGGER',

                array_merge(
                    $this->getValueDataTypeParams($absoluteTrigger->getValueDataType(), AbsoluteTrigger::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($absoluteTrigger->getXParams())
                ),
                self::formatDate($absoluteTrigger->getDateTime())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger $relativeTrigger
     *
     * @return $this
     */
    protected function writeRelativeTriggerProperty($relativeTrigger)
    {
        if (isset($relativeTrigger)) {
            $this->writeProperty('TRIGGER',

                array_merge(
                    self::getAlarmTriggerRelationshipParams($relativeTrigger->getAlarmTriggerRelationship(), RelativeTrigger::DEFAULT_RELATED_TYPE),
                    $this->getValueDataTypeParams($relativeTrigger->getValueDataType(), RelativeTrigger::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($relativeTrigger->getXParams())
                ),
                self::formatDuration($relativeTrigger->getDuration())
            );
        }

        return $this;
    }

    /**
     * TODO: Use visitor pattern instead of instanceof
     *
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Attachment $attachment
     *
     * @return $this
     */
    protected function writeAttachmentProperty($attachment)
    {
        if (isset($attachment)) {
            if ($attachment instanceof UriAttachment) {
                $this->writeUriAttachmentProperty($attachment);
            } elseif ($attachment instanceof BinaryAttachment) {
                $this->writeBinaryAttachmentProperty($attachment);
            } else {
                throw new \LogicException('Unsupported Attachment type');
            }
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\UriAttachment $attachment
     *
     * @return $this
     */
    protected function writeUriAttachmentProperty($attachment)
    {
        if (isset($attachment)) {
            $this->writeProperty('ATTACH',

                array_merge(
                    self::getFormatTypeParams($attachment->getFormatType()),
                    $this->getValueDataTypeParams($attachment->getValueDataType(), Attachment::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($attachment->getXParams())
                ),
                $attachment->getUri()
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\BinaryAttachment $attachment
     *
     * @return $this
     */
    public function writeBinaryAttachmentProperty($attachment)
    {
        if (isset($attachment)) {
            $this->writeProperty('ATTACH',

                array_merge(
                    self::getFormatTypeParams($attachment->getFormatType()),
                    self::getEncodingParams($attachment->getEncoding()),
                    $this->getValueDataTypeParams($attachment->getValueDataType(), Attachment::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($attachment->getXParams())
                ),
                $this->encode($attachment->getBinaryValue(), $attachment->getEncoding())
            );
        }

        return $this;
    }

    /**
     * @param Comment[] $comments
     *
     * @return $this
     */
    protected function writeCommentsProperties($comments)
    {
        if (isset($comments)) {
            foreach ($comments as $comment) {
                $this->writeCommentProperty($comment);
            }
        }

        return $this;
    }

    /**
     * @param Comment $comment
     *
     * @return $this
     */
    protected function writeCommentProperty($comment)
    {
        if (isset($comment)) {
            $this->writeProperty('COMMENT',

                array_merge(
                    self::getAlternateTextRepresentation($comment->getAlternateTextRepresentation()),
                    self::getLanguageParams($comment->getLanguage()),
                    self::getXParamsParams($comment->getXParams())
                ),
                self::escapeText($comment->getText())
            );
        }

        return $this;
    }

    /**
     * @param FreeBusyProperty[] $freeBusies
     *
     * @return $this
     */
    protected function writeFreeBusiesProperties($freeBusies)
    {
        if (isset($freeBusies)) {
            foreach ($freeBusies as $freeBusy) {
                $this->writeFreeBusyProperty($freeBusy);
            }
        }

        return $this;
    }

    /**
     * @param FreeBusyProperty $freeBusy
     *
     * @return $this
     */
    protected function writeFreeBusyProperty($freeBusy)
    {
        if (isset($freeBusy)) {
            $this->writeProperty('FREEBUSY',

                array_merge(
                    self::getFreeBusyTypeParams($freeBusy->getFreeBusyType()),
                    $this->getValueDataTypeParams($freeBusy->getValueDataType(), FreeBusyProperty::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($freeBusy->getXParams())
                ),
                self::formatPeriods($freeBusy->getPeriods())
            );
        }

        return $this;
    }

    /**
     * @param ExceptionDate[] $exceptionDates
     *
     * @return $this
     */
    protected function writeExceptionDatesProperties($exceptionDates)
    {
        if (isset($exceptionDates)) {
            foreach ($exceptionDates as $exceptionDate) {
                $this->writeExceptionDateProperty($exceptionDate);
            }
        }

        return $this;
    }

    /**
     * @param ExceptionDate $exceptionDate
     *
     * @return $this
     */
    protected function writeExceptionDateProperty($exceptionDate)
    {
        if (isset($exceptionDate)) {
            $this->writeProperty('EXDATE',
                array_merge(
                    self::getTimezoneIdentifierParams($exceptionDate->getTimezoneIdentifier()),
                    $this->getValueDataTypeParams($exceptionDate->getValueDataType(), ExceptionDate::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($exceptionDate->getXParams())
                ),
                self::dateTimeValuesString($exceptionDate->getDateTimeValues())
            );
        }

        return $this;
    }

    /**
     * @param ExceptionRule[] $exceptionRules
     *
     * @return $this
     */
    protected function writeExceptionRulesProperties($exceptionRules)
    {
        if (isset($exceptionRules)) {
            foreach ($exceptionRules as $exceptionRule) {
                $this->writeExceptionRuleProperty($exceptionRule);
            }
        }

        return $this;
    }

    /**
     * @param ExceptionRule $exceptionRule
     *
     * @return $this
     */
    protected function writeExceptionRuleProperty($exceptionRule)
    {
        if (isset($exceptionRule)) {
            $this->writeProperty('EXDATE',
                array_merge(
                    self::getXParamsParams($exceptionRule->getXParams())
                ),
                self::recurrenceRuleValue($exceptionRule->getRecurrenceRule())
            );
        }

        return $this;
    }

    /**
     * @param RequestStatus[] $requestStatuses
     *
     * @return $this
     */
    protected function writeRequestStatusesProperties($requestStatuses)
    {
        if (isset($requestStatuses)) {
            foreach ($requestStatuses as $requestStatus) {
                $this->writeRequestStatusProperty($requestStatus);
            }
        }

        return $this;
    }

    /**
     * @param RequestStatus $requestStatus
     *
     * @return $this
     */
    protected function writeRequestStatusProperty($requestStatus)
    {
        if (isset($requestStatus)) {
            $this->writeProperty('REQUEST-STATUS',
                array_merge(
                    self::getLanguageParams($requestStatus->getLanguage()),
                    self::getXParamsParams($requestStatus->getXParams())
                ),
                self::requestStatusValue($requestStatus)
            );
        }

        return $this;
    }

    /**
     * @param RelatedTo[] $relatedTos
     *
     * @return $this
     */
    protected function writeRelatedTosProperties($relatedTos)
    {
        if (isset($relatedTos)) {
            foreach ($relatedTos as $relatedTo) {
                $this->writeRelatedToProperty($relatedTo);
            }
        }

        return $this;
    }

    /**
     * @param RelatedTo $relatedTo
     *
     * @return $this
     */
    protected function writeRelatedToProperty($relatedTo)
    {
        if (isset($relatedTo)) {
            $this->writeProperty('REQUEST-STATUS',
                array_merge(
                    self::getRelationshipTypeParams($relatedTo->getRelationshipType()),
                    self::getXParamsParams($relatedTo->getXParams())
                ),
                self::escapeText($relatedTo->getText())
            );
        }

        return $this;
    }

    /**
     * @param RecurrenceDate[] $recurrenceDates
     *
     * @return $this
     */
    protected function writeRecurrenceDatesProperties($recurrenceDates)
    {
        if (isset($recurrenceDates)) {
            foreach ($recurrenceDates as $recurrenceDate) {
                $this->writeRecurrenceDateProperty($recurrenceDate);
            }
        }

        return $this;
    }

    /**
     * @param RecurrenceDate $recurrenceDate
     *
     * @return $this
     */
    protected function writeRecurrenceDateProperty($recurrenceDate)
    {
        if (isset($recurrenceDate)) {
            $this->writeProperty('RDATE',
                array_merge(
                    self::getTimezoneIdentifierParams($recurrenceDate->getTimezoneIdentifier()),
                    $this->getValueDataTypeParams($recurrenceDate->getValueDataType(), RecurrenceDate::DEFAULT_VALUE_TYPE),
                    self::getXParamsParams($recurrenceDate->getXParams())
                ),
                self::recurrenceDatesString($recurrenceDate->getRecurrenceDates())
            );
        }

        return $this;
    }

    /**
     * @param RecurrenceRule[] $recurrenceRules
     *
     * @return $this
     */
    protected function writeRecurrenceRulesProperties($recurrenceRules)
    {
        if (isset($recurrenceRules)) {
            foreach ($recurrenceRules as $recurrenceRule) {
                $this->writeRecurrenceRuleProperty($recurrenceRule);
            }
        }

        return $this;
    }

    /**
     * @param RecurrenceRule $recurrenceRule
     *
     * @return $this
     */
    protected function writeRecurrenceRuleProperty($recurrenceRule)
    {
        if (isset($recurrenceRule)) {
            $this->writeProperty('RRULE',
                array_merge(
                    self::getXParamsParams($recurrenceRule->getXParams())
                ),
                self::recurrenceRuleValue($recurrenceRule->getRecurrenceRule())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Contact[] $contacts
     *
     * @return $this
     */
    protected function writeContactsProperties($contacts)
    {
        if (isset($contacts)) {
            foreach ($contacts as $contact) {
                $this->writeContactProperty($contact);
            }
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Contact $contact
     *
     * @return $this
     */
    protected function writeContactProperty($contact)
    {
        if (isset($contact)) {
            $this->writeProperty('CONTACT',
                array_merge(
                    self::getAlternateTextRepresentation($contact->getAlternateTextRepresentation()),
                    self::getLanguageParams($contact->getLanguage()),
                    self::getXParamsParams($contact->getXParams())
                ),
                self::escapeText($contact->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Categories $categories
     *
     * @return $this
     */
    protected function writeCategoriesProperty($categories)
    {
        if (isset($categories)) {
            $this->writeProperty('CATEGORIES',

                array_merge(
                    self::getLanguageParams($categories->getLanguage()),
                    self::getXParamsParams($categories->getXParams())
                ),
                self::textValuesString($categories->getTextValues())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Resources $resources
     *
     * @return $this
     */
    protected function writeResourcesProperty($resources)
    {
        if (isset($resources)) {
            $this->writeProperty('RESOURCES',

                array_merge(
                    self::getAlternateTextRepresentation($resources->getAlternateTextRepresentation()),
                    self::getLanguageParams($resources->getLanguage()),
                    self::getXParamsParams($resources->getXParams())
                ),
                self::textValuesString($resources->getTextValues())
            );
        }

        return $this;
    }

    /**
     * @param XProperty[] $xProperties
     *
     * @return $this
     */
    protected function writeXPropertiesProperties($xProperties)
    {
        if (isset($xProperties)) {
            foreach ($xProperties as $xProperty) {
                $this->writeXPropertyProperty($xProperty);
            }
        }

        return $this;
    }

    /**
     * @param XProperty $xProperty
     *
     * @return $this
     */
    protected function writeXPropertyProperty($xProperty)
    {
        if (isset($xProperty)) {
            $this->writeProperty(strtoupper($xProperty->getXName()),

                array_merge(
                    self::getLanguageParams($xProperty->getLanguage()),
                    self::getXParamsParams($xProperty->getXParams())
                ),
                self::escapeText($xProperty->getText())
            );
        }

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\GeographicPosition $geographicPosition
     *
     * @return $this
     */
    protected function writeGeographicPositionProperty($geographicPosition)
    {
        if (isset($geographicPosition)) {
            $this->writeProperty('GEO',
                array_merge(
                    self::getXParamsParams($geographicPosition->getXParams())
                ),
                $geographicPosition->getLatitude() . ';' . $geographicPosition->getLongitude()
            );
        }

        return $this;
    }

    // ============================ VALUES ===============================

    /**
     * @param \Relaxsd\ICalendar\Values\RecurrenceRule $getRecurrenceRule
     *
     * @return array
     */
    protected static function recurrenceRuleValue($getRecurrenceRule)
    {
        if (!isset($getRecurrenceRule)) return [];

        return array_merge(
            self::getFrequencyParams($getRecurrenceRule->getFrequency()),
            self::getUntilDateParams($getRecurrenceRule->getUntilDate()),
            self::getCountParams($getRecurrenceRule->getCount()),
            self::getIntervalParams($getRecurrenceRule->getInterval()),
            self::getBySecondsParams($getRecurrenceRule->getBySeconds()),
            self::getByMinutesParams($getRecurrenceRule->getByMinutes()),
            self::getByHoursParams($getRecurrenceRule->getByHours()),
            self::getByDaysParams($getRecurrenceRule->getByDays()),
            self::getByMonthDaysParams($getRecurrenceRule->getByMonthDays()),
            self::getByYearDaysParams($getRecurrenceRule->getByYearDays()),
            self::getByWeekNumbersParams($getRecurrenceRule->getByWeekNumbers()),
            self::getByMonthsParams($getRecurrenceRule->getByMonths()),
            self::getBySetPositionsParams($getRecurrenceRule->getBySetPositions()),
            self::getWeekStartParams($getRecurrenceRule->getWeekStart()),
            self::getXParamsParams($getRecurrenceRule->getXParams())
        );
    }

    // ============================ PARAMETERS ===============================

    /**
     * @param CommonName $commonName
     *
     * @return array
     */
    protected static function getCommonNameParams($commonName)
    {
        if (!isset($commonName)) return [];

        return ['CN' => self::paramValue($commonName->getValue())];
    }

    /**
     * @param DirectoryEntryReference $directoryEntryReference
     *
     * @return array
     */
    protected static function getDirectoryEntryReferenceParams($directoryEntryReference)
    {
        if (!isset($directoryEntryReference)) return [];

        return ['DIR' => self::doubleQuoted($directoryEntryReference->getValue())];
    }

    /**
     * @param Language $language
     *
     * @return array
     */
    protected static function getLanguageParams($language)
    {
        if (!isset($language)) return [];

        return ['LANGUAGE' => $language->getValue()];
    }

    /**
     * @param CalendarUserType|null $calendarUserType
     *
     * @return array
     */
    protected static function getCalendarUserTypeParams($calendarUserType)
    {
        if (!isset($calendarUserType)) return [];

        return ['CUTYPE' => $calendarUserType->getValue()];
    }

    /**
     * @param GroupOrListMembership $groupOrListMembership
     *
     * @return array
     */
    protected static function getGroupOrListMembershipParams($groupOrListMembership)
    {
        if (!isset($groupOrListMembership)) return [];

        return ['MEMBER' => self::doubleQuotedValuesString($groupOrListMembership->getCalendarUserAddresses())];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\ParticipationRole $participationRole
     *
     * @return array
     */
    protected static function getParticipationRoleParams($participationRole)
    {
        if (!isset($participationRole)) return [];

        return ['ROLE' => $participationRole->getValue()];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\ParticipationStatus $participationStatus
     *
     * @return array
     */
    protected static function getParticipationStatusParams($participationStatus)
    {
        if (!isset($participationStatus)) return [];

        return ['PARTSTAT' => $participationStatus->getValue()];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\Delegatees $delegatees
     *
     * @return array
     */
    protected static function getDelegateesParams($delegatees)
    {
        if (!isset($delegatees)) return [];

        return ['DELEGATED-TO' => self::doubleQuotedValuesString($delegatees->getCalendarUserAddresses())];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\Delegators $delegators
     *
     * @return array
     */
    protected static function getDelegatorsParams($delegators)
    {
        if (!isset($delegators)) return [];

        return ['DELEGATED-FROM' => self::doubleQuotedValuesString($delegators->getCalendarUserAddresses())];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\RSVPExpectation $rsvpExpectation
     *
     * @return array
     */
    protected static function getRsvpExpectationParams($rsvpExpectation)
    {
        if (!isset($rsvpExpectation)) return [];

        return ['RSVP' => self::booleanString($rsvpExpectation->getValue())];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\SentBy $sentBy
     *
     * @return array
     */
    protected static function getSentByParams($sentBy)
    {
        if (!isset($sentBy)) return [];

        return ['SENT-BY' => self::doubleQuoted($sentBy->getUri())];
    }

    /**
     * @param ValueDataType|string|null $valueDataType
     * @param ValueDataType|string|null $defaultValueDataType
     *
     * @return array
     */
    protected function getValueDataTypeParams($valueDataType, $defaultValueDataType = null)
    {
        if (!isset($valueDataType)) return [];

        $valueDataType = ValueDataType::valueOf($valueDataType);

        if (!$this->options['force-value']) {

            $defaultValueDataType = ValueDataType::valueOf($defaultValueDataType);

            if ($defaultValueDataType == $valueDataType) return [];

        }

        return ['VALUE' => $valueDataType];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\TimeZoneIdentifier $timeZoneIdentifier
     *
     * @return array
     */
    protected static function getTimeZoneIdentifierParams($timeZoneIdentifier)
    {
        if (!isset($timeZoneIdentifier)) return [];

        return ['TZID' => $timeZoneIdentifier->getPrefix() . $timeZoneIdentifier->getParamText()];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\RecurrenceIdentifierRange $recurrenceIdentifierRange
     *
     * @return array
     */
    protected static function getRecurrenceIdentifierRangeParams($recurrenceIdentifierRange)
    {
        if (!isset($recurrenceIdentifierRange)) return [];

        return ['RANGE' => $recurrenceIdentifierRange->getValue()];
    }

    /**
     * @param \Relaxsd\ICalendar\Values\Duration $duration
     *
     * @return array
     */
    protected static function getDurationParams($duration)
    {
        if (!isset($duration)) return [];

        return ['DURATION' => $duration->getValue()];
    }

    /**
     * @param AlarmTriggerRelationShip|string|null $alarmTriggerRelationShipType
     * @param AlarmTriggerRelationShip|string|null $defaultRelationshipType
     *
     * @return array
     */
    protected static function getAlarmTriggerRelationShipParams($alarmTriggerRelationShipType, $defaultRelationshipType = null)
    {
        if (!isset($alarmTriggerRelationShipType)) return [];

        $alarmTriggerRelationShipType = AlarmTriggerRelationShip::valueOf($alarmTriggerRelationShipType);
        $defaultRelationshipType      = AlarmTriggerRelationShip::valueOf($defaultRelationshipType);

        if ($defaultRelationshipType && ($defaultRelationshipType == $alarmTriggerRelationShipType)) return [];

        return ['RELATED' => $alarmTriggerRelationShipType];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\AlternateTextRepresentation $alternateTextRepresentation
     *
     * @return array
     */
    protected static function getAlternateTextRepresentation($alternateTextRepresentation)
    {
        if (!isset($alternateTextRepresentation)) return [];

        return ['ALTREP' => self::doubleQuoted($alternateTextRepresentation->getUri())];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\RelationshipType $relationshipType
     *
     * @return array
     */
    protected static function getRelationshipTypeParams($relationshipType)
    {
        if (!isset($relationshipType)) return [];

        return ['RELTYPE' => $relationshipType->getValue()];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\FormatType $formatType
     *
     * @return array
     */
    protected static function getFormatTypeParams($formatType)
    {
        if (!isset($formatType)) return [];

        return ['FMTTYPE' => $formatType->getValue()];
    }

    /**
     * @param string $encoding
     *
     * @return array
     */
    protected static function getEncodingParams($encoding)
    {
        if (!isset($encoding)) return [];

        return ['ENCODING' => $encoding];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\TimeZoneIdentifier $timezoneIdentifier
     *
     * @return array
     */
    protected static function getTimezoneIdentifierParam($timezoneIdentifier)
    {
        if (!isset($timezoneIdentifier)) return [];

        return ['TZID' => $timezoneIdentifier->getPrefix() . $timezoneIdentifier->getParamText()];
    }

    /**
     * @param string $frequency
     *
     * @return array
     */
    protected static function getFrequencyParams($frequency)
    {
        if (!isset($frequency)) return [];

        return ['FREQ' => $frequency];
    }

    /**
     * @param \DateTime $untilDate
     *
     * @return array
     */
    protected static function getUntilDateParams($untilDate)
    {
        if (!isset($untilDate)) return [];

        return ['UNTIL' => self::formatDate($untilDate)];
    }

    /**
     * @param integer $count
     *
     * @return array
     */
    protected static function getCountParams($count)
    {
        if (!isset($count)) return [];

        return ['COUNT' => $count];
    }

    /**
     * @param integer $interval
     *
     * @return array
     */
    protected static function getIntervalParams($interval)
    {
        if (!isset($interval)) return [];

        return ['INTERVAL' => $interval];
    }

    /**
     * @param array $bySeconds
     *
     * @return array
     */
    protected static function getBySecondsParams($bySeconds)
    {
        if (!isset($bySeconds)) return [];

        return ['BYSECOND' => implode(',', $bySeconds)];
    }

    /**
     * @param array $byMinutes
     *
     * @return array
     */
    protected static function getByMinutesParams($byMinutes)
    {
        if (!isset($byMinutes)) return [];

        return ['BYMINUTE' => implode(',', $byMinutes)];
    }

    /**
     * @param array $byHours
     *
     * @return array
     */
    protected static function getByHoursParams($byHours)
    {
        if (!isset($byHours)) return [];

        return ['BYHOUR' => implode(',', $byHours)];
    }

    /**
     * @param string[] $byDays
     *
     * @return array
     */
    protected static function getByDaysParams($byDays)
    {
        if (!isset($byDays)) return [];

        return ['BYDAY' => implode(',', $byDays)];
    }

    /**
     * @param integer[] $byMonthDays
     *
     * @return array
     */
    protected static function getByMonthDaysParams($byMonthDays)
    {
        if (!isset($byMonthDays)) return [];

        return ['BYMONTHDAY' => implode(',', $byMonthDays)];
    }

    /**
     * @param integer[] $byYearDays
     *
     * @return array
     */
    protected static function getByYearDaysParams($byYearDays)
    {
        if (!isset($byYearDays)) return [];

        return ['BYYEARDAY' => implode(',', $byYearDays)];
    }

    /**
     * @param integer[] $byWeekNumbers
     *
     * @return array
     */
    protected static function getByWeekNumbersParams($byWeekNumbers)
    {
        if (!isset($byWeekNumbers)) return [];

        return ['BYWEEKNO' => implode(',', $byWeekNumbers)];
    }

    /**
     * @param integer[] $byMonths
     *
     * @return array
     */
    protected static function getByMonthsParams($byMonths)
    {
        if (!isset($byMonths)) return [];

        return ['BYMONTH' => implode(',', $byMonths)];
    }

    /**
     * @param integer[] $bySetPositions
     *
     * @return array
     */
    protected static function getBySetPositionsParams($bySetPositions)
    {
        if (!isset($bySetPositions)) return [];

        return ['BYSETPOS' => implode(',', $bySetPositions)];
    }

    /**
     * @param string $weekStart
     *
     * @return array
     */
    protected static function getWeekStartParams($weekStart)
    {
        if (!isset($weekStart)) return [];

        return ['WKST' => $weekStart];
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\FreeBusyType $freeBusyType
     *
     * @return array
     */
    protected static function getFreeBusyTypeParams($freeBusyType)
    {
        if (!isset($freeBusyType)) return [];

        return ['FBTYPE' => $freeBusyType->getValue()];
    }

    /**
     * @param string[][] $xParams
     *
     * @return array
     */
    protected static function getXParamsParams($xParams)
    {
        $result = [];
        foreach ($xParams as $name => $values) {
            $paramValues = array_map(function ($value) {
                return self::paramValue($value);
            }, $values);

            $result[$name] = implode(',', $paramValues);
        }
        return $result;
    }

    /**
     * @param string $binaryValue
     * @param string $encoding
     *
     * @return string
     */
    protected function encode($binaryValue, $encoding)
    {
        if ($encoding == 'BASE64') {
            return base64_encode($binaryValue);
        } else {
            throw new \LogicException('Unsupported Encoding');
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Misc\RequestStatus $requestStatus
     *
     * @return string
     */
    protected static function requestStatusValue($requestStatus)
    {
        return $requestStatus->getStatusCode()
        . ',' . $requestStatus->getStatusDescription()
        . ($extData = $requestStatus->getExtraData()) ? ',' . $extData : '';
    }

    /**
     * @param \Relaxsd\ICalendar\Values\RecurrenceDate[] $recurrenceDates
     *
     * @return string
     */
    protected static function recurrenceDatesString($recurrenceDates)
    {
        return implode(',', array_map(function ($recurrenceDate) {
            return self::formatRecurrenceDate($recurrenceDate);
        }, $recurrenceDates));
    }

    /**
     * @param \Relaxsd\ICalendar\Values\RecurrenceDate $recurrenceDate
     *
     * @return string
     */
    protected static function formatRecurrenceDate($recurrenceDate)
    {
        if ($recurrenceDate instanceof RecurrenceDatePeriod) {
            return self::formatRecurrenceDatePeriod($recurrenceDate);
        } elseif ($recurrenceDate instanceof RecurrenceDateTime) {
            return self::formatRecurrenceDateTime($recurrenceDate);
        } else {
            throw new \LogicException('Unsupported Recurrence Data Type');
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Values\RecurrenceDatePeriod $recurrenceDatePeriod
     *
     * @return string
     */
    protected static function formatRecurrenceDatePeriod($recurrenceDatePeriod)
    {
        return self::formatPeriod($recurrenceDatePeriod->getPeriod());
    }

    /**
     * @param \Relaxsd\ICalendar\Values\RecurrenceDateTime $recurrenceDateTime
     *
     * @return string
     */
    protected static function formatRecurrenceDateTime($recurrenceDateTime)
    {
        return self::formatDate($recurrenceDateTime->getDateTime());
    }

    /**
     * @param \Relaxsd\ICalendar\Values\Period[] $periods
     *
     * @return string
     */
    protected static function formatPeriods($periods)
    {
        return implode(',', array_map(function ($period) {
            return self::formatPeriod($period);
        }, $periods));
    }

    /**
     * @param \Relaxsd\ICalendar\Values\Period $period
     *
     * @return string
     */
    protected static function formatPeriod($period)
    {
        if ($period instanceof ExplicitPeriod) {

            return self::formatDate($period->getStartDate()) . '/' . self::formatDate($period->getEndDate());

        } elseif ($period instanceof DurationPeriod) {

            return self::formatDate($period->getStartDate()) . '/' . self::formatDuration($period->getDuration());

        } else {
            throw new \LogicException('Unsupported Period Type');
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Values\Duration $duration
     *
     * @return string
     */
    protected static function formatDuration($duration)
    {
        return $duration->getValue();
    }

}
