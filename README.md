# php-icalendar
Fluent iCalendar creator for PHP

For the RFC, See [https://www.ietf.org/rfc/rfc2445.txt](https://www.ietf.org/rfc/rfc2445.txt)

### Current status:

- RFC Coverage: 80% (supports all components except `VTIMEZONE`)
- Fluent interface: 70% (working on it)
- Test cases: 10% (tested just some examples from the RFC, see below.)


## Examples from the RFC:

### Event
The following is an example of the "VEVENT" calendar
component used to represent a meeting that will also be opaque to
searches for busy time:

     BEGIN:VEVENT
     UID:19970901T130000Z-123401@host.com
     DTSTAMP:19970901T1300Z
     DTSTART:19970903T163000Z
     DTEND:19970903T190000Z
     SUMMARY:Annual Employee Review
     CLASS:PRIVATE
     CATEGORIES:BUSINESS,HUMAN RESOURCES
     END:VEVENT

To create this event in PHP:

```php
$event  = new Event('19970901T130000Z-123401@host.com')
            ->setDateTimeStamp('1997-09-01 13:00 UTC')
            ->setDateTimeStart('1997-09-03 16:30 UTC')
            ->setDateTimeEnd('1997-09-03 19:00 UTC')
            ->setSummary('Annual Employee Review')
            ->setClassification(Classification::CLASSIFICATION_PRIVATE)
            ->setCategories(['BUSINESS', 'HUMAN RESOURCES']);
```

### Audio Alarm

The following example is for a "VALARM" calendar component
that specifies an audio alarm that will sound at a precise time and
repeat 4 more times at 15 minute intervals:

     BEGIN:VALARM
     TRIGGER;VALUE=DATE-TIME:19970317T133000Z
     REPEAT:4
     DURATION:PT15M
     ACTION:AUDIO
     ATTACH;FMTTYPE=audio/basic:ftp://host.com/pub/sounds/bell-01.aud
     END:VALARM

To create this event in PHP:

```php
$audioAlarm = new AudioAlarm()
    ->setTrigger('1997-03-17 13:30 UTC')
    ->setRepeatCount(4)
    ->setAttachment(UriAttachment::forAudioUrl('ftp://host.com/pub/sounds/bell-01.aud'))
    ->setDuration(Duration::forMinutes(15));
```
            
### Audio Alarm

The following example is for a "VALARM" calendar component
that specifies an audio alarm that will sound at a precise time and
repeat 4 more times at 15 minute intervals:

     BEGIN:VALARM
     TRIGGER;VALUE=DATE-TIME:19970317T133000Z
     REPEAT:4
     DURATION:PT15M
     ACTION:AUDIO
     ATTACH;FMTTYPE=audio/basic:ftp://host.com/pub/sounds/bell-01.aud
     END:VALARM

To create this event in PHP:

```php
$audioAlarm = new AudioAlarm()
    ->setTrigger('1997-03-17 13:30 UTC')
    ->setRepeatCount(4)
    ->setAttachment(UriAttachment::forAudioUrl('ftp://host.com/pub/sounds/bell-01.aud'))
    ->setDuration(Duration::forMinutes(15));
```

### TODO Item

The following is an example of a "VTODO" calendar component:

     BEGIN:VTODO
     UID:19970901T130000Z-123404@host.com
     DTSTAMP:19970901T1300Z
     DTSTART:19970415T133000Z
     DUE:19970416T045959Z
     SUMMARY:1996 Income Tax Preparation
     CLASS:CONFIDENTIAL
     CATEGORIES:FAMILY,FINANCE
     PRIORITY:1
     STATUS:NEEDS-ACTION
     END:VTODO

To create this event in PHP:

```php
$todo = new Todo()
    ->setUniqueIdentifier('19970901T130000Z-123404@host.com')
    ->setDateTimeStamp('1997-09-01 13:00 UTC')
    ->setDateTimeStart('1997-04-15 13:30 UTC')
    ->setDateTimeDue('1997-04-16 04:59:59 UTC')
    ->setSummary('1996 Income Tax Preparation')
    ->setClassification(Classification::CLASSIFICATION_CONFIDENTIAL)
    ->setCategories(['FAMILY', 'FINANCE'])
    ->setPriority(1)
    ->setStatus(Status::STATUS_NEEDS_ACTION);
```
