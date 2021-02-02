describe('events as an array', function() {

  pushOptions({
    defaultView: 'dayGridMonth',
    defaultDate: '2014-05-01'
  })

  function getEventArray() {
    return [
      {
        title: 'my event',
        start: '2014-05-21'
      }
    ]
  }

  it('accepts an event using dayGrid form', function(done) {
    initCalendar({
      events: getEventArray(),
      eventRender: function(arg) {
        expect(arg.event.title).toEqual('my event')
        done()
      }
    })
  })

  it('accepts an event using extended form', function(done) {
    initCalendar({
      eventSources: [
        {
          className: 'customeventclass',
          events: getEventArray()
        }
      ],
      eventRender: function(arg) {
        expect(arg.event.title).toEqual('my event')
        expect(arg.el).toHaveClass('customeventclass')
        done()
      }
    })
  })

  it('doesn\'t mutate the original array', function(done) {
    var eventArray = getEventArray()
    var origArray = eventArray
    var origEvent = eventArray[0]
    initCalendar({
      events: eventArray,
      eventRender: function(arg) {
        expect(origArray).toEqual(eventArray)
        expect(origEvent).toEqual(eventArray[0])
        done()
      }
    })
  })

})
