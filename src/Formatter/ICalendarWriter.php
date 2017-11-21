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
use Relaxsd\ICalendar\Values\ExplicitPeriod;
use Relaxsd\ICalendar\Values\DurationPeriod;
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

    public function writeCalendar(Calendar $calendar)
    {
        $this->line('BEGIN:VCALENDAR');

        $this->writeProductIdentifierProperty($calendar->getProductIdentifier());
        $this->writeVersionProperty($calendar->getVersion());
        $this->writeCalendarScaleProperty($calendar->getCalendarScale());
        $this->writeMethodProperty($calendar->getMethod());
        $this->writeXPropertiesProperties($calendar->getXProperties());

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
    }

    public function writeEvent(Event $event)
    {
        $this->line('BEGIN:VEVENT');

        $this->writeClassificationProperty($event->getClassification());
        $this->writeDateTimeCreatedProperty($event->getDateTimeCreated());
        $this->writeDescriptionProperty($event->getDescription());
        $this->writeDateTimeStartProperty($event->getDateTimeStart());
        $this->writeGeographicPositionProperty($event->getGeographicPosition());
        $this->writeLastModifiedProperty($event->getLastModified());
        $this->writeLocationProperty($event->getLocation());
        $this->writeOrganizerProperty($event->getOrganizer());
        $this->writePriorityProperty($event->getPriority());
        $this->writeDateTimeStampProperty($event->getDateTimeStamp());
        $this->writeSequenceNumberProperty($event->getSequenceNumber());
        $this->writeStatusProperty($event->getStatus());
        $this->writeSummaryProperty($event->getSummary());
        $this->writeTimeTransparencyProperty($event->getTimeTransparency());
        $this->writeUniqueIdentifierProperty($event->getUniqueIdentifier());
        $this->writeUrlProperty($event->getUrl());
        $this->writeRecurrenceIdProperty($event->getRecurrenceId());

        $this->writeDateTimeEndProperty($event->getDateTimeEnd());
        $this->writeDurationProperty($event->getDuration());

        $this->writeAttachmentsProperties($event->getAttachments());
        $this->writeAttendeesProperties($event->getAttendees());
        $this->writeCategoriesProperty($event->getCategories());
        $this->writeCommentsProperties($event->getComments());
        $this->writeContactsProperties($event->getContacts());
        $this->writeExceptionDatesProperties($event->getExceptionDates());
        $this->writeExceptionRulesProperties($event->getExceptionRules());
        $this->writeRequestStatusesProperties($event->getRequestStatuses());
        $this->writeRelatedTosProperties($event->getRelatedTos());
        $this->writeResourcesProperty($event->getResources());
        $this->writeRecurrenceDatesProperties($event->getRecurrenceDates());
        $this->writeRecurrenceRulesProperties($event->getRecurrenceRules());
        $this->writeXPropertiesProperties($event->getXProperties());

        foreach ($event->getAlarms() as $alarm) {
            $alarm->acceptWriter($this);
        }

        $this->line('END:VEVENT');
    }

    public function writeTodo(Todo $todo)
    {
        $this->line('BEGIN:VTODO');

        $this->writeClassificationProperty($todo->getClassification());
        $this->writeDateTimeCompletedProperty($todo->getDateTimeCompleted());
        $this->writeDateTimeCreatedProperty($todo->getDateTimeCreated());
        $this->writeDescriptionProperty($todo->getDescription());
        $this->writeDateTimeStampProperty($todo->getDateTimeStamp());
        $this->writeDateTimeStartProperty($todo->getDateTimeStart());
        $this->writeGeographicPositionProperty($todo->getGeographicPosition());
        $this->writeLastModifiedProperty($todo->getLastModified());
        $this->writeLocationProperty($todo->getLocation());
        $this->writeOrganizerProperty($todo->getOrganizer());
        $this->writePercentCompleteProperty($todo->getPercentComplete());
        $this->writePriorityProperty($todo->getPriority());
        $this->writeRecurrenceIdProperty($todo->getRecurrenceId());
        $this->writeSequenceNumberProperty($todo->getSequenceNumber());
        $this->writeStatusProperty($todo->getStatus());
        $this->writeSummaryProperty($todo->getSummary());
        $this->writeUniqueIdentifierProperty($todo->getUniqueIdentifier());
        $this->writeUrlProperty($todo->getUrl());

        $this->writeDateTimeDueProperty($todo->getDateTimeDue());
        $this->writeDurationProperty($todo->getDuration());

        $this->writeAttachmentsProperties($todo->getAttachments());
        $this->writeAttendeesProperties($todo->getAttendees());
        $this->writeCategoriesProperty($todo->getCategories());
        $this->writeCommentsProperties($todo->getComments());
        $this->writeContactsProperties($todo->getContacts());
        $this->writeExceptionDatesProperties($todo->getExceptionDates());
        $this->writeExceptionRulesProperties($todo->getExceptionRules());
        $this->writeRequestStatusesProperties($todo->getRequestStatuses());
        $this->writeRelatedTosProperties($todo->getRelatedTos());
        $this->writeResourcesProperty($todo->getResources());
        $this->writeRecurrenceDatesProperties($todo->getRecurrenceDates());
        $this->writeRecurrenceRulesProperties($todo->getRecurrenceRules());
        $this->writeXPropertiesProperties($todo->getXProperties());

        $this->line('END:VTODO');
    }

    public function writeAudioAlarm(AudioAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this->writeActionProperty($alarm->getAction());
        $this->writeAttachmentProperty($alarm->getAttachment());
        $this->writeDurationProperty($alarm->getDuration());
        $this->writeRepeatCountProperty($alarm->getRepeatCount());
        $this->writeTriggerProperty($alarm->getTrigger());
        $this->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');
    }

    public function writeDisplayAlarm(DisplayAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this->writeActionProperty($alarm->getAction());
        $this->writeDescriptionProperty($alarm->getDescription());
        $this->writeDurationProperty($alarm->getDuration());
        $this->writeRepeatCountProperty($alarm->getRepeatCount());
        $this->writeTriggerProperty($alarm->getTrigger());
        $this->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');
    }

    public function writeEmailAlarm(EmailAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this->writeActionProperty($alarm->getAction());
        $this->writeAttachmentProperty($alarm->getAttachment());
        $this->writeAttendeesProperties($alarm->getAttendees());
        $this->writeDescriptionProperty($alarm->getDescription());
        $this->writeDurationProperty($alarm->getDuration());
        $this->writeRepeatCountProperty($alarm->getRepeatCount());
        $this->writeSummaryProperty($alarm->getSummary());
        $this->writeTriggerProperty($alarm->getTrigger());
        $this->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');
    }

    public function writeProcedureAlarm(ProcedureAlarm $alarm)
    {
        $this->line('BEGIN:VALARM');

        $this->writeActionProperty($alarm->getAction());
        $this->writeAttachmentProperty($alarm->getAttachment());
        $this->writeDescriptionProperty($alarm->getDescription());
        $this->writeDurationProperty($alarm->getDuration());
        $this->writeRepeatCountProperty($alarm->getRepeatCount());
        $this->writeTriggerProperty($alarm->getTrigger());
        $this->writeXPropertiesProperties($alarm->getXProperties());

        $this->line('END:VALARM');
    }

    public function writeFreeBusy(FreeBusy $freeBusy)
    {

        $this->line('BEGIN:VFREEBUSY');
        $this->writeContactProperty($freeBusy->getContact());
        $this->writeDateTimeStartProperty($freeBusy->getDateTimeStart());
        $this->writeDateTimeEndProperty($freeBusy->getDateTimeEnd());
        $this->writeDurationProperty($freeBusy->getDuration());
        $this->writeDateTimeStampProperty($freeBusy->getDateTimeStamp());
        $this->writeOrganizerProperty($freeBusy->getOrganizer());
        $this->writeUniqueIdentifierProperty($freeBusy->getUniqueIdentifier());
        $this->writeUrlProperty($freeBusy->getUrl());

        $this->writeAttendeesProperties($freeBusy->getAttendees());
        $this->writeCommentsProperties($freeBusy->getComments());
        $this->writeFreeBusiesProperties($freeBusy->getFreeBusies());
        $this->writeRequestStatusesProperties($freeBusy->getRequestStatuses());
        $this->writeXPropertiesProperties($freeBusy->getXProperties());
        $this->line('END:VFREEBUSY');
    }

    public function writeTimeZone(TimeZone $timeZone)
    {
        // TODO: Implement writeTimeZone() method.
    }

    public function writeJournal(Journal $journal)
    {
        $this->line('BEGIN:VJOURNAL');

        $this->writeClassificationProperty($journal->getClassification());
        $this->writeDateTimeCreatedProperty($journal->getDateTimeCreated());
        $this->writeDescriptionProperty($journal->getDescription());
        $this->writeDateTimeStartProperty($journal->getDateTimeStart());
        $this->writeDateTimeStampProperty($journal->getDateTimeStamp());
        $this->writeLastModifiedProperty($journal->getLastModified());
        $this->writeOrganizerProperty($journal->getOrganizer());
        $this->writeRecurrenceIdProperty($journal->getRecurrenceId());
        $this->writeSequenceNumberProperty($journal->getSequenceNumber());
        $this->writeStatusProperty($journal->getStatus());
        $this->writeSummaryProperty($journal->getSummary());
        $this->writeUniqueIdentifierProperty($journal->getUniqueIdentifier());
        $this->writeUrlProperty($journal->getUrl());

        $this->writeAttachmentsProperties($journal->getAttachments());
        $this->writeAttendeesProperties($journal->getAttendees());
        $this->writeCategoriesProperty($journal->getCategories());
        $this->writeCommentsProperties($journal->getComments());
        $this->writeContactsProperties($journal->getContacts());
        $this->writeExceptionDatesProperties($journal->getExceptionDates());
        $this->writeExceptionRulesProperties($journal->getExceptionRules());
        $this->writeRelatedTosProperties($journal->getRelatedTos());
        $this->writeRecurrenceDatesProperties($journal->getRecurrenceDates());
        $this->writeRecurrenceRulesProperties($journal->getRecurrenceRules());
        $this->writeRequestStatusesProperties($journal->getRequestStatuses());
        $this->writeXPropertiesProperties($journal->getXProperties());

        $this->line('END:VJOURNAL');
    }

    // ============================ PROPERTIES ===============================

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart $dateTime
     */
    protected function writeDateTimeStartProperty($dateTime)
    {
        if (!isset($dateTime)) return;

        $this->writeProperty('DTSTART',
            array_merge(
                self::getTimezoneIdentifierParam($dateTime->getTimezoneIdentifier()),
                $this->getValueDataTypeParams($dateTime->getValueDataType(), DateTimeStart::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($dateTime->getXParams())
            ),
            self::formatDate($dateTime->getDateTime(), $dateTime->getValueDataType())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd $dateTime
     */
    protected function writeDateTimeEndProperty($dateTime)
    {
        if (!isset($dateTime)) return;

        $this->writeProperty('DTEND',
            array_merge(
                self::getTimezoneIdentifierParam($dateTime->getTimezoneIdentifier()),
                self::getXParamsParams($dateTime->getXParams())
            ),
            self::formatDate($dateTime->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\Duration $duration
     */
    protected function writeDurationProperty($duration)
    {
        if (!isset($duration)) return;

        $this->writeProperty('DURATION',
            array_merge(
                self::getXParamsParams($duration->getXParams())
            ),
            self::formatDuration($duration->getDuration())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeDue $dateTime
     */
    protected function writeDateTimeDueProperty($dateTime)
    {
        if (!isset($dateTime)) return;

        $this->writeProperty('DUE',
            array_merge(
                self::getTimezoneIdentifierParam($dateTime->getTimezoneIdentifier()),
                self::getXParamsParams($dateTime->getXParams())
            ),
            self::formatDate($dateTime->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeCreated $dateTime
     */
    protected function writeDateTimeCreatedProperty($dateTime)
    {
        if (!isset($dateTime)) return;

        $this->writeProperty('CREATED',
            array_merge(
                self::getXParamsParams($dateTime->getXParams())
            ),
            self::formatDate($dateTime->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted $dateTime
     */
    protected function writeDateTimeCompletedProperty($dateTime)
    {
        if (!isset($dateTime)) return;

        $this->writeProperty('COMPLETED',
            array_merge(
                self::getXParamsParams($dateTime->getXParams())
            ),
            self::formatDate($dateTime->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeStamp $dateTime
     */
    protected function writeDateTimeStampProperty($dateTime)
    {
        if (!isset($dateTime)) return;

        $this->writeProperty('DTSTAMP',
            array_merge(
                self::getXParamsParams($dateTime->getXParams())
            ),
            self::formatDate($dateTime->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\LastModified $lastModified
     */
    protected function writeLastModifiedProperty($lastModified)
    {
        if (!isset($lastModified)) return;

        $this->writeProperty('LAST-MODIFIED',
            array_merge(
                self::getXParamsParams($lastModified->getXParams())
            ),
            self::formatDate($lastModified->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Organizer $organizer
     */
    protected function writeOrganizerProperty($organizer)
    {
        if (!isset($organizer)) return;

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

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\PercentComplete $percentComplete
     */
    protected function writePercentCompleteProperty($percentComplete)
    {
        if (!isset($percentComplete)) return;

        $this->writeProperty('PERCENT-COMPLETE',
            array_merge(
                self::getXParamsParams($percentComplete->getXParams())
            ),
            $percentComplete->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Priority $priority
     */
    protected function writePriorityProperty($priority)
    {
        if (!isset($priority)) return;

        $this->writeProperty('PRIORITY',
            array_merge(
                self::getAlternateTextRepresentation($priority->getAlternateTextRepresentation()),
                self::getLanguageParams($priority->getLanguage()),
                self::getXParamsParams($priority->getXParams())
            ),
            $priority->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\RecurrenceId $recurrenceId
     */
    protected function writeRecurrenceIdProperty($recurrenceId)
    {
        if (!isset($recurrenceId)) return;

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

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\SequenceNumber $sequenceNumber
     */
    protected function writeSequenceNumberProperty($sequenceNumber)
    {
        if (!isset($sequenceNumber)) return;

        $this->writeProperty('SEQUENCE',
            array_merge(
                self::getXParamsParams($sequenceNumber->getXParams())
            ),
            $sequenceNumber->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Status $status
     */
    protected function writeStatusProperty($status)
    {
        if (!isset($status)) return;

        $this->writeProperty('STATUS',
            array_merge(
                self::getXParamsParams($status->getXParams())
            ),
            self::escapeText($status->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Summary $summary
     */
    protected function writeSummaryProperty($summary)
    {
        if (!isset($summary)) return;

        $this->writeProperty('SUMMARY',
            array_merge(
                self::getAlternateTextRepresentation($summary->getAlternateTextRepresentation()),
                self::getLanguageParams($summary->getLanguage()),
                self::getXParamsParams($summary->getXParams())
            ),
            self::escapeText($summary->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\TimeTransparency $timeTransparency
     */
    protected function writeTimeTransparencyProperty($timeTransparency)
    {
        if (!isset($timeTransparency)) return;

        $this->writeProperty('TRANSP',
            array_merge(
                self::getXParamsParams($timeTransparency->getXParams())
            ),
            $timeTransparency->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\UniqueIdentifier $uniqueIdentifier
     */
    protected function writeUniqueIdentifierProperty($uniqueIdentifier)
    {
        if (!isset($uniqueIdentifier)) return;

        $this->writeProperty('UID',
            array_merge(
                self::getXParamsParams($uniqueIdentifier->getXParams())
            ),
            self::escapeText($uniqueIdentifier->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Location $location
     */
    protected function writeLocationProperty($location)
    {
        if (!isset($location)) return;

        $this->writeProperty('LOCATION',
            array_merge(
                self::getAlternateTextRepresentation($location->getAlternateTextRepresentation()),
                self::getLanguageParams($location->getLanguage()),
                self::getXParamsParams($location->getXParams())
            ),
            self::escapeText($location->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Url $url
     */
    protected function writeUrlProperty($url)
    {
        if (!isset($url)) return;

        $this->writeProperty('URL',
            array_merge(
                self::getXParamsParams($url->getXParams())
            ),
            $url->getUri()
        );
    }

    /**
     * @param ProductIdentifier|null $productIdentifier
     */
    protected function writeProductIdentifierProperty($productIdentifier)
    {
        if (!isset($productIdentifier)) return;

        $this->writeProperty('PRODID',
            array_merge(
                self::getXParamsParams($productIdentifier->getXParams())
            ),
            $productIdentifier->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\Version $version
     */
    protected function writeVersionProperty($version)
    {
        if (!isset($version)) return;

        $this->writeProperty('VERSION',
            array_merge(
                self::getXParamsParams($version->getXParams())
            ),
            // TODO: Support min and max version
            $version->getVersion()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\CalendarScale $calendarScale
     */
    protected function writeCalendarScaleProperty($calendarScale)
    {
        if (!isset($calendarScale)) return;

        $this->writeProperty('CALSCALE',
            array_merge(
                self::getXParamsParams($calendarScale->getXParams())
            ),
            $calendarScale->getIanaToken()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\Method $method
     */
    protected function writeMethodProperty($method)
    {
        if (!isset($method)) return;

        $this->writeProperty('METHOD',
            array_merge(
                self::getXParamsParams($method->getXParams())
            ),
            $method->getIanaToken()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Classification $classification
     */
    protected function writeClassificationProperty($classification)
    {
        if (!isset($classification)) return;

        $this->writeProperty('CLASS',
            array_merge(
                self::getXParamsParams($classification->getXParams())
            ),
            $classification->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Description $description
     */
    protected function writeDescriptionProperty($description)
    {
        if (!isset($description)) return;

        $this->writeProperty('DESCRIPTION',
            array_merge(
                self::getAlternateTextRepresentation($description->getAlternateTextRepresentation()),
                self::getLanguageParams($description->getLanguage()),
                self::getXParamsParams($description->getXParams())
            ),
            self::escapeText($description->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Attendee[] $attendees
     */
    protected function writeAttendeesProperties($attendees)
    {
        if (!isset($attendees)) return;

        foreach ($attendees as $attendee) {
            $this->writeAttendeeProperty($attendee);
        }
    }

    /**
     * @param Attendee $attendee
     */
    protected function writeAttendeeProperty($attendee)
    {
        if (!isset($attendee)) return;

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

    /**
     * @param Attachment[] $attachments
     *
     */
    protected function writeAttachmentsProperties($attachments)
    {
        if (!isset($attachments)) return;

        foreach ($attachments as $attachment) {
            $this->writeAttachmentProperty($attachment);
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\Action $action
     */
    protected function writeActionProperty($action)
    {
        if (!isset($action)) return;

        $this->writeProperty('ACTION',

            array_merge(
                self::getXParamsParams($action->getXParams())
            ),
            $action->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\RepeatCount $repeatCount
     */
    protected function writeRepeatCountProperty($repeatCount)
    {
        if (!isset($repeatCount)) return;

        $this->writeProperty('REPEAT',

            array_merge(
                self::getXParamsParams($repeatCount->getXParams())
            ),
            $repeatCount->getValue()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\Trigger $trigger
     */
    protected function writeTriggerProperty($trigger)
    {
        if (!isset($trigger)) return;

        if ($trigger instanceof AbsoluteTrigger) {
            $this->writeAbsoluteTriggerProperty($trigger);
        } elseif ($trigger instanceof RelativeTrigger) {
            $this->writeRelativeTriggerProperty($trigger);
        } else {
            throw new \LogicException('Unsupported Trigger type');
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\AbsoluteTrigger $absoluteTrigger
     */
    protected function writeAbsoluteTriggerProperty($absoluteTrigger)
    {
        if (!isset($absoluteTrigger)) return;

        $this->writeProperty('TRIGGER',

            array_merge(
                $this->getValueDataTypeParams($absoluteTrigger->getValueDataType(), AbsoluteTrigger::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($absoluteTrigger->getXParams())
            ),
            self::formatDate($absoluteTrigger->getDateTime())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger $relativeTrigger
     */
    protected function writeRelativeTriggerProperty($relativeTrigger)
    {
        if (!isset($relativeTrigger)) return;

        $this->writeProperty('TRIGGER',

            array_merge(
                self::getAlarmTriggerRelationshipParams($relativeTrigger->getAlarmTriggerRelationship(), RelativeTrigger::DEFAULT_RELATED_TYPE),
                $this->getValueDataTypeParams($relativeTrigger->getValueDataType(), RelativeTrigger::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($relativeTrigger->getXParams())
            ),
            self::formatDuration($relativeTrigger->getDuration())
        );
    }

    /**
     * TODO: Use visitor pattern instead of instanceof
     *
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Attachment $attachment
     */
    protected function writeAttachmentProperty($attachment)
    {
        if (!isset($attachment)) return;

        if ($attachment instanceof UriAttachment) {
            $this->writeUriAttachmentProperty($attachment);
        } elseif ($attachment instanceof BinaryAttachment) {
            $this->writeBinaryAttachmentProperty($attachment);
        } else {
            throw new \LogicException('Unsupported Attachment type');
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\UriAttachment $attachment
     */
    protected function writeUriAttachmentProperty($attachment)
    {
        if (!isset($attachment)) return;

        $this->writeProperty('ATTACH',

            array_merge(
                self::getFormatTypeParams($attachment->getFormatType()),
                $this->getValueDataTypeParams($attachment->getValueDataType(), Attachment::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($attachment->getXParams())
            ),
            $attachment->getUri()
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\BinaryAttachment $attachment
     */
    public function writeBinaryAttachmentProperty($attachment)
    {
        if (!isset($attachment)) return;

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

    /**
     * @param Comment[] $comments
     *
     */
    protected function writeCommentsProperties($comments)
    {
        if (!isset($comments)) return;

        foreach ($comments as $comment) {
            $this->writeCommentProperty($comment);
        }
    }

    /**
     * @param Comment $comment
     */
    protected function writeCommentProperty($comment)
    {
        if (!isset($comment)) return;

        $this->writeProperty('COMMENT',

            array_merge(
                self::getAlternateTextRepresentation($comment->getAlternateTextRepresentation()),
                self::getLanguageParams($comment->getLanguage()),
                self::getXParamsParams($comment->getXParams())
            ),
            self::escapeText($comment->getText())
        );
    }

    /**
     * @param FreeBusyProperty[] $freeBusies
     *
     */
    protected function writeFreeBusiesProperties($freeBusies)
    {
        if (!isset($freeBusies)) return;

        foreach ($freeBusies as $freeBusy) {
            $this->writeFreeBusyProperty($freeBusy);
        }
    }

    /**
     * @param FreeBusyProperty $freeBusy
     */
    protected function writeFreeBusyProperty($freeBusy)
    {
        if (!isset($freeBusy)) return;

        $this->writeProperty('FREEBUSY',

            array_merge(
                self::getFreeBusyTypeParams($freeBusy->getFreeBusyType()),
                $this->getValueDataTypeParams($freeBusy->getValueDataType(), FreeBusyProperty::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($freeBusy->getXParams())
            ),
            self::formatPeriods($freeBusy->getPeriods())
        );
    }

    /**
     * @param ExceptionDate[] $exceptionDates
     */
    protected function writeExceptionDatesProperties($exceptionDates)
    {
        if (!isset($exceptionDates)) return;

        foreach ($exceptionDates as $exceptionDate) {
            $this->writeExceptionDateProperty($exceptionDate);
        }
    }

    /**
     * @param ExceptionDate $exceptionDate
     */
    protected function writeExceptionDateProperty($exceptionDate)
    {
        if (!isset($exceptionDate)) return;

        $this->writeProperty('EXDATE',
            array_merge(
                self::getTimezoneIdentifierParams($exceptionDate->getTimezoneIdentifier()),
                $this->getValueDataTypeParams($exceptionDate->getValueDataType(), ExceptionDate::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($exceptionDate->getXParams())
            ),
            self::dateTimeValuesString($exceptionDate->getDateTimeValues())
        );
    }

    /**
     * @param ExceptionRule[] $exceptionRules
     */
    protected function writeExceptionRulesProperties($exceptionRules)
    {
        if (!isset($exceptionRules)) return;

        foreach ($exceptionRules as $exceptionRule) {
            $this->writeExceptionRuleProperty($exceptionRule);
        }
    }

    /**
     * @param ExceptionRule $exceptionRule
     */
    protected function writeExceptionRuleProperty($exceptionRule)
    {
        if (!isset($exceptionRule)) return;

        $this->writeProperty('EXDATE',
            array_merge(
                self::getXParamsParams($exceptionRule->getXParams())
            ),
            self::recurrenceRuleValue($exceptionRule->getRecurrenceRule())
        );
    }

    /**
     * @param RequestStatus[] $requestStatuses
     */
    protected function writeRequestStatusesProperties($requestStatuses)
    {
        if (!isset($requestStatuses)) return;

        foreach ($requestStatuses as $requestStatus) {
            $this->writeRequestStatusProperty($requestStatus);
        }
    }

    /**
     * @param RequestStatus $requestStatus
     */
    protected function writeRequestStatusProperty($requestStatus)
    {
        if (!isset($requestStatus)) return;

        $this->writeProperty('REQUEST-STATUS',
            array_merge(
                self::getLanguageParams($requestStatus->getLanguage()),
                self::getXParamsParams($requestStatus->getXParams())
            ),
            self::requestStatusValue($requestStatus)
        );
    }

    /**
     * @param RelatedTo[] $relatedTos
     */
    protected function writeRelatedTosProperties($relatedTos)
    {
        if (!isset($relatedTos)) return;

        foreach ($relatedTos as $relatedTo) {
            $this->writeRelatedToProperty($relatedTo);
        }
    }

    /**
     * @param RelatedTo $relatedTo
     */
    protected function writeRelatedToProperty($relatedTo)
    {
        if (!isset($relatedTo)) return;

        $this->writeProperty('REQUEST-STATUS',
            array_merge(
                self::getRelationshipTypeParams($relatedTo->getRelationshipType()),
                self::getXParamsParams($relatedTo->getXParams())
            ),
            self::escapeText($relatedTo->getText())
        );
    }

    /**
     * @param RecurrenceDate[] $recurrenceDates
     */
    protected function writeRecurrenceDatesProperties($recurrenceDates)
    {
        if (!isset($recurrenceDates)) return;

        foreach ($recurrenceDates as $recurrenceDate) {
            $this->writeRecurrenceDateProperty($recurrenceDate);
        }
    }

    /**
     * @param RecurrenceDate $recurrenceDate
     */
    protected function writeRecurrenceDateProperty($recurrenceDate)
    {
        if (!isset($recurrenceDate)) return;

        $this->writeProperty('RDATE',
            array_merge(
                self::getTimezoneIdentifierParams($recurrenceDate->getTimezoneIdentifier()),
                $this->getValueDataTypeParams($recurrenceDate->getValueDataType(), RecurrenceDate::DEFAULT_VALUE_TYPE),
                self::getXParamsParams($recurrenceDate->getXParams())
            ),
            self::recurrenceDatesString($recurrenceDate->getRecurrenceDates())
        );
    }

    /**
     * @param RecurrenceRule[] $recurrenceRules
     */
    protected function writeRecurrenceRulesProperties($recurrenceRules)
    {
        if (!isset($recurrenceRules)) return;

        foreach ($recurrenceRules as $recurrenceRule) {
            $this->writeRecurrenceRuleProperty($recurrenceRule);
        }
    }

    /**
     * @param RecurrenceRule $recurrenceRule
     */
    protected function writeRecurrenceRuleProperty($recurrenceRule)
    {
        if (!isset($recurrenceRule)) return;

        $this->writeProperty('RRULE',
            array_merge(
                self::getXParamsParams($recurrenceRule->getXParams())
            ),
            self::recurrenceRuleValue($recurrenceRule->getRecurrenceRule())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Contact[] $contacts
     *
     */
    protected function writeContactsProperties($contacts)
    {
        if (!isset($contacts)) return;
        foreach ($contacts as $contact) {
            $this->writeContactProperty($contact);
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Contact $contact
     */
    protected function writeContactProperty($contact)
    {
        if (!isset($contact)) return;

        $this->writeProperty('CONTACT',
            array_merge(
                self::getAlternateTextRepresentation($contact->getAlternateTextRepresentation()),
                self::getLanguageParams($contact->getLanguage()),
                self::getXParamsParams($contact->getXParams())
            ),
            self::escapeText($contact->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Categories $categories
     */
    protected function writeCategoriesProperty($categories)
    {
        if (!isset($categories)) return;

        $this->writeProperty('CATEGORIES',

            array_merge(
                self::getLanguageParams($categories->getLanguage()),
                self::getXParamsParams($categories->getXParams())
            ),
            self::textValuesString($categories->getTextValues())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Resources $resources
     */
    protected function writeResourcesProperty($resources)
    {
        if (!isset($resources)) return;

        $this->writeProperty('RESOURCES',

            array_merge(
                self::getAlternateTextRepresentation($resources->getAlternateTextRepresentation()),
                self::getLanguageParams($resources->getLanguage()),
                self::getXParamsParams($resources->getXParams())
            ),
            self::textValuesString($resources->getTextValues())
        );
    }

    /**
     * @param XProperty[] $xProperties
     */
    protected function writeXPropertiesProperties($xProperties)
    {
        if (!isset($xProperties)) return;

        foreach ($xProperties as $xProperty) {
            $this->writeXPropertyProperty($xProperty);
        }
    }

    /**
     * @param XProperty $xProperty
     */
    protected function writeXPropertyProperty($xProperty)
    {
        if (!isset($xProperty)) return;

        $this->writeProperty(strtoupper($xProperty->getXName()),

            array_merge(
                self::getLanguageParams($xProperty->getLanguage()),
                self::getXParamsParams($xProperty->getXParams())
            ),
            self::escapeText($xProperty->getText())
        );
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\GeographicPosition $geographicPosition
     */
    protected function writeGeographicPositionProperty($geographicPosition)
    {
        if (!isset($geographicPosition)) return;

        $this->writeProperty('GEO',
            array_merge(
                self::getXParamsParams($geographicPosition->getXParams())
            ),
            $geographicPosition->getLatitude() . ';' . $geographicPosition->getLongitude()
        );
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

        $valueDataType        = ValueDataType::valueOf($valueDataType);

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
