// most other businessHours tests are in background-events.js

import { getBoundingRect } from '../lib/dom-geom'
import { doElsMatchSegs } from '../lib/segs'
import {
  getTimeGridTop,
  getTimeGridDayEls,
  getTimeGridNonBusinessDayEls
} from '../lib/time-grid'
import { ensureDate } from '../datelib/utils'
import { getDayGridNonBusinessDayEls } from '../view-render/DayGridRenderUtils'
import { startOfDay } from '@fullcalendar/core'


describe('businessHours', function() {
  pushOptions({
    timeZone: 'UTC',
    defaultDate: '2014-11-25',
    defaultView: 'dayGridMonth',
    businessHours: true
  })

  it('doesn\'t break when starting out in a larger month time range', function() {
    initCalendar() // start out in the month range
    currentCalendar.changeView('timeGridWeek')
    currentCalendar.next() // move out of the original month range...
    currentCalendar.next() // ... out. should render correctly.

    // whole days
    expect(getDayGridNonBusinessDayEls().length).toBe(2) // each multi-day stretch is one element

    // timed area
    expect(isTimeGridNonBusinessSegsRendered([
      // sun
      { start: '2014-12-07T00:00', end: '2014-12-08T00:00' },
      // mon
      { start: '2014-12-08T00:00', end: '2014-12-08T09:00' },
      { start: '2014-12-08T17:00', end: '2014-12-09T00:00' },
      // tue
      { start: '2014-12-09T00:00', end: '2014-12-09T09:00' },
      { start: '2014-12-09T17:00', end: '2014-12-10T00:00' },
      // wed
      { start: '2014-12-10T00:00', end: '2014-12-10T09:00' },
      { start: '2014-12-10T17:00', end: '2014-12-11T00:00' },
      // thu
      { start: '2014-12-11T00:00', end: '2014-12-11T09:00' },
      { start: '2014-12-11T17:00', end: '2014-12-12T00:00' },
      // fri
      { start: '2014-12-12T00:00', end: '2014-12-12T09:00' },
      { start: '2014-12-12T17:00', end: '2014-12-13T00:00' },
      // sat
      { start: '2014-12-13T00:00', end: '2014-12-14T00:00' }
    ])).toBe(true)
  })


  describe('when used as a dynamic option', function() {
    [ 'timeGridWeek', 'dayGridMonth' ].forEach(function(viewName) {

      it('allows dynamic turning on', function() {
        initCalendar({
          defaultView: viewName,
          businessHours: false
        })

        expect(queryNonBusinessSegs().length).toBe(0)
        currentCalendar.setOption('businessHours', true)
        expect(queryNonBusinessSegs().length).toBeGreaterThan(0)
      })

      it('allows dynamic turning off', function() {
        initCalendar({
          defaultView: viewName,
          businessHours: true
        })

        expect(queryNonBusinessSegs().length).toBeGreaterThan(0)
        currentCalendar.setOption('businessHours', false)
        expect(queryNonBusinessSegs().length).toBe(0)
      })
    })
  })


  describe('for multiple day-of-week definitions', function() {

    it('rendes two day-of-week groups', function() {
      initCalendar({
        defaultDate: '2014-12-07',
        defaultView: 'timeGridWeek',
        businessHours: [
          {
            daysOfWeek: [ 1, 2, 3 ], // mon, tue, wed
            startTime: '08:00',
            endTime: '18:00'
          },
          {
            daysOfWeek: [ 4, 5 ], // thu, fri
            startTime: '10:00',
            endTime: '16:00'
          }
        ]
      })

      // timed area
      expect(isTimeGridNonBusinessSegsRendered([
        // sun
        { start: '2014-12-07T00:00', end: '2014-12-08T00:00' },
        // mon
        { start: '2014-12-08T00:00', end: '2014-12-08T08:00' },
        { start: '2014-12-08T18:00', end: '2014-12-09T00:00' },
        // tue
        { start: '2014-12-09T00:00', end: '2014-12-09T08:00' },
        { start: '2014-12-09T18:00', end: '2014-12-10T00:00' },
        // wed
        { start: '2014-12-10T00:00', end: '2014-12-10T08:00' },
        { start: '2014-12-10T18:00', end: '2014-12-11T00:00' },
        // thu
        { start: '2014-12-11T00:00', end: '2014-12-11T10:00' },
        { start: '2014-12-11T16:00', end: '2014-12-12T00:00' },
        // fri
        { start: '2014-12-12T00:00', end: '2014-12-12T10:00' },
        { start: '2014-12-12T16:00', end: '2014-12-13T00:00' },
        // sat
        { start: '2014-12-13T00:00', end: '2014-12-14T00:00' }
      ])).toBe(true)
    })

    it('wont\'t process businessHour items that omit dow', function() {
      initCalendar({
        defaultDate: '2014-12-07',
        defaultView: 'timeGridWeek',
        businessHours: [
          {
            // invalid
            startTime: '08:00',
            endTime: '18:00'
          },
          {
            daysOfWeek: [ 4, 5 ], // thu, fri
            startTime: '10:00',
            endTime: '16:00'
          }
        ]
      })

      // timed area
      expect(isTimeGridNonBusinessSegsRendered([
        // sun
        { start: '2014-12-07T00:00', end: '2014-12-08T00:00' },
        // mon
        { start: '2014-12-08T00:00', end: '2014-12-09T00:00' },
        // tue
        { start: '2014-12-09T00:00', end: '2014-12-10T00:00' },
        // wed
        { start: '2014-12-10T00:00', end: '2014-12-11T00:00' },
        // thu
        { start: '2014-12-11T00:00', end: '2014-12-11T10:00' },
        { start: '2014-12-11T16:00', end: '2014-12-12T00:00' },
        // fri
        { start: '2014-12-12T00:00', end: '2014-12-12T10:00' },
        { start: '2014-12-12T16:00', end: '2014-12-13T00:00' },
        // sat
        { start: '2014-12-13T00:00', end: '2014-12-14T00:00' }
      ])).toBe(true)
    })
  })


  it('will grey-out a totally non-business-hour view', function() {
    initCalendar({
      defaultDate: '2016-07-23', // sat
      defaultView: 'timeGridDay',
      businessHours: true
    })

    // timed area
    expect(isTimeGridNonBusinessSegsRendered([
      { start: '2016-07-23T00:00', end: '2016-07-24T00:00' }
    ])).toBe(true)
  })


  function queryNonBusinessSegs() {
    return $('.fc-nonbusiness')
  }

  /* inspired by other proj...
  ------------------------------------------------------------------------------------------------------------------ */

  function isTimeGridNonBusinessSegsRendered(segs) {
    return doElsMatchSegs(getTimeGridNonBusinessDayEls(), segs, getTimeGridRect)
  }

  function getTimeGridRect(start, end) {
    var obj
    if (typeof start === 'object') {
      obj = start
      start = obj.start
      end = obj.end
    }

    start = ensureDate(start)
    end = ensureDate(end)

    var startDay = startOfDay(start)
    var endDay = startOfDay(end)
    var startTimeMs = start.valueOf() - startDay.valueOf()
    var endTimeMs = end.valueOf() - endDay.valueOf()

    if (startDay.valueOf() === endDay.valueOf()) {
      endTimeMs = end.valueOf() - endDay.valueOf()
    } else if (end < start) {
      endTimeMs = startTimeMs
    } else {
      endTimeMs = 1000 * 60 * 60 * 24 // whole day
    }

    var dayEls = getTimeGridDayEls(start)
    var dayRect = getBoundingRect(dayEls)
    return {
      left: dayRect.left,
      right: dayRect.right,
      top: getTimeGridTop(startTimeMs),
      bottom: getTimeGridTop(endTimeMs)
    }
  }

})
