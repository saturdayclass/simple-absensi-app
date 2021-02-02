import { parseFieldSpecs } from './util/misc'
import DateProfileGenerator, { DateProfile } from './DateProfileGenerator'
import { DateMarker, addMs } from './datelib/marker'
import { createDuration, Duration } from './datelib/duration'
import { default as EmitterMixin, EmitterInterface } from './common/EmitterMixin'
import { ViewSpec } from './structs/view-spec'
import { createElement } from './util/dom-manip'
import { ComponentContext } from './component/Component'
import DateComponent from './component/DateComponent'
import { EventStore } from './structs/event-store'
import { EventUiHash, EventUi } from './component/event-ui'
import { sliceEventStore, EventRenderRange } from './component/event-rendering'
import { DateSpan } from './structs/date-span'
import { EventInteractionState } from './interactions/event-interaction-state'
import { memoizeRendering } from './component/memoized-rendering'
import { __assign } from 'tslib'
import { EventDef } from './structs/event'

export interface ViewProps {
  dateProfile: DateProfile
  businessHours: EventStore
  eventStore: EventStore
  eventUiBases: EventUiHash
  dateSelection: DateSpan | null
  eventSelection: string
  eventDrag: EventInteractionState | null
  eventResize: EventInteractionState | null
}

export default abstract class View extends DateComponent<ViewProps> {

  // config properties, initialized after class on prototype
  usesMinMaxTime: boolean // whether minTime/maxTime will affect the activeRange. Views must opt-in.
  dateProfileGeneratorClass: any // initialized after class. used by Calendar

  on: EmitterInterface['on']
  one: EmitterInterface['one']
  off: EmitterInterface['off']
  trigger: EmitterInterface['trigger']
  triggerWith: EmitterInterface['triggerWith']
  hasHandlers: EmitterInterface['hasHandlers']

  viewSpec: ViewSpec
  dateProfileGenerator: DateProfileGenerator
  type: string // subclass' view name (string). for the API
  title: string // the text that will be displayed in the header's title. SET BY CALLER for API

  queuedScroll: any

  eventOrderSpecs: any // criteria for ordering events when they have same date/time
  nextDayThreshold: Duration

  // now indicator
  isNowIndicatorRendered: boolean
  initialNowDate: DateMarker // result first getNow call
  initialNowQueriedMs: number // ms time the getNow was called
  nowIndicatorTimeoutID: any // for refresh timing of now indicator
  nowIndicatorIntervalID: any // "

  private renderDatesMem = memoizeRendering(this.renderDatesWrap, this.unrenderDatesWrap)
  private renderBusinessHoursMem = memoizeRendering(this.renderBusinessHours, this.unrenderBusinessHours, [ this.renderDatesMem ])
  private renderDateSelectionMem = memoizeRendering(this.renderDateSelectionWrap, this.unrenderDateSelectionWrap, [ this.renderDatesMem ])
  private renderEventsMem = memoizeRendering(this.renderEvents, this.unrenderEvents, [ this.renderDatesMem ])
  private renderEventSelectionMem = memoizeRendering(this.renderEventSelectionWrap, this.unrenderEventSelectionWrap, [ this.renderEventsMem ])
  private renderEventDragMem = memoizeRendering(this.renderEventDragWrap, this.unrenderEventDragWrap, [ this.renderDatesMem ])
  private renderEventResizeMem = memoizeRendering(this.renderEventResizeWrap, this.unrenderEventResizeWrap, [ this.renderDatesMem ])


  constructor(context: ComponentContext, viewSpec: ViewSpec, dateProfileGenerator: DateProfileGenerator, parentEl: HTMLElement) {
    super(
      context,
      createElement('div', { className: 'fc-view fc-' + viewSpec.type + '-view' }),
      true // isView (HACK)
    )

    this.viewSpec = viewSpec
    this.dateProfileGenerator = dateProfileGenerator
    this.type = viewSpec.type
    this.eventOrderSpecs = parseFieldSpecs(this.opt('eventOrder'))
    this.nextDayThreshold = createDuration(this.opt('nextDayThreshold'))

    parentEl.appendChild(this.el)
    this.initialize()
  }


  initialize() { // convenient for sublcasses
  }


  // Date Setting/Unsetting
  // -----------------------------------------------------------------------------------------------------------------


  get activeStart(): Date {
    return this.dateEnv.toDate(this.props.dateProfile.activeRange.start)
  }

  get activeEnd(): Date {
    return this.dateEnv.toDate(this.props.dateProfile.activeRange.end)
  }

  get currentStart(): Date {
    return this.dateEnv.toDate(this.props.dateProfile.currentRange.start)
  }

  get currentEnd(): Date {
    return this.dateEnv.toDate(this.props.dateProfile.currentRange.end)
  }


  // General Rendering
  // -----------------------------------------------------------------------------------------------------------------


  render(props: ViewProps) {
    this.renderDatesMem(props.dateProfile)
    this.renderBusinessHoursMem(props.businessHours)
    this.renderDateSelectionMem(props.dateSelection)
    this.renderEventsMem(props.eventStore)
    this.renderEventSelectionMem(props.eventSelection)
    this.renderEventDragMem(props.eventDrag)
    this.renderEventResizeMem(props.eventResize)
  }


  destroy() {
    super.destroy()

    this.renderDatesMem.unrender() // should unrender everything else
  }


  // Sizing
  // -----------------------------------------------------------------------------------------------------------------


  updateSize(isResize: boolean, viewHeight: number, isAuto: boolean) {
    let { calendar } = this

    if (
      isResize || // HACKS...
      calendar.isViewUpdated ||
      calendar.isDatesUpdated ||
      calendar.isEventsUpdated
    ) {
      // sort of the catch-all sizing
      // anything that might cause dimension changes
      this.updateBaseSize(isResize, viewHeight, isAuto)
    }
  }


  updateBaseSize(isResize: boolean, viewHeight: number, isAuto: boolean) {
  }


  // Date Rendering
  // -----------------------------------------------------------------------------------------------------------------

  renderDatesWrap(dateProfile: DateProfile) {
    this.renderDates(dateProfile)
    this.addScroll({
      duration: createDuration(this.opt('scrollTime'))
    })
    this.startNowIndicator(dateProfile) // shouldn't render yet because updateSize will be called soon
  }

  unrenderDatesWrap() {
    this.stopNowIndicator()
    this.unrenderDates()
  }

  renderDates(dateProfile: DateProfile) {}
  unrenderDates() {}


  // Business Hours
  // -----------------------------------------------------------------------------------------------------------------

  renderBusinessHours(businessHours: EventStore) {}
  unrenderBusinessHours() {}


  // Date Selection
  // -----------------------------------------------------------------------------------------------------------------

  renderDateSelectionWrap(selection: DateSpan) {
    if (selection) {
      this.renderDateSelection(selection)
    }
  }

  unrenderDateSelectionWrap(selection: DateSpan) {
    if (selection) {
      this.unrenderDateSelection(selection)
    }
  }

  renderDateSelection(selection: DateSpan) {}
  unrenderDateSelection(selection: DateSpan) {}


  // Event Rendering
  // -----------------------------------------------------------------------------------------------------------------

  renderEvents(eventStore: EventStore) {}
  unrenderEvents() {}

  // util for subclasses
  sliceEvents(eventStore: EventStore, allDay: boolean): EventRenderRange[] {
    let { props } = this

    return sliceEventStore(
      eventStore,
      props.eventUiBases,
      props.dateProfile.activeRange,
      allDay ? this.nextDayThreshold : null
    ).fg
  }

  computeEventDraggable(eventDef: EventDef, eventUi: EventUi) {
    let transformers = this.calendar.pluginSystem.hooks.isDraggableTransformers
    let val = eventUi.startEditable

    for (let transformer of transformers) {
      val = transformer(val, eventDef, eventUi, this)
    }

    return val
  }

  computeEventStartResizable(eventDef: EventDef, eventUi: EventUi) {
    return eventUi.durationEditable && this.opt('eventResizableFromStart')
  }

  computeEventEndResizable(eventDef: EventDef, eventUi: EventUi) {
    return eventUi.durationEditable
  }


  // Event Selection
  // -----------------------------------------------------------------------------------------------------------------

  renderEventSelectionWrap(instanceId: string) {
    if (instanceId) {
      this.renderEventSelection(instanceId)
    }
  }

  unrenderEventSelectionWrap(instanceId: string) {
    if (instanceId) {
      this.unrenderEventSelection(instanceId)
    }
  }

  renderEventSelection(instanceId: string) {}
  unrenderEventSelection(instanceId: string) {}


  // Event Drag
  // -----------------------------------------------------------------------------------------------------------------

  renderEventDragWrap(state: EventInteractionState) {
    if (state) {
      this.renderEventDrag(state)
    }
  }

  unrenderEventDragWrap(state: EventInteractionState) {
    if (state) {
      this.unrenderEventDrag(state)
    }
  }

  renderEventDrag(state: EventInteractionState) {}
  unrenderEventDrag(state: EventInteractionState) {}


  // Event Resize
  // -----------------------------------------------------------------------------------------------------------------

  renderEventResizeWrap(state: EventInteractionState) {
    if (state) {
      this.renderEventResize(state)
    }
  }

  unrenderEventResizeWrap(state: EventInteractionState) {
    if (state) {
      this.unrenderEventResize(state)
    }
  }

  renderEventResize(state: EventInteractionState) {}
  unrenderEventResize(state: EventInteractionState) {}


  /* Now Indicator
  ------------------------------------------------------------------------------------------------------------------*/


  // Immediately render the current time indicator and begins re-rendering it at an interval,
  // which is defined by this.getNowIndicatorUnit().
  // TODO: somehow do this for the current whole day's background too
  startNowIndicator(dateProfile: DateProfile) {
    let { dateEnv } = this
    let unit
    let update
    let delay // ms wait value

    if (this.opt('nowIndicator')) {
      unit = this.getNowIndicatorUnit(dateProfile)
      if (unit) {
        update = this.updateNowIndicator.bind(this)

        this.initialNowDate = this.calendar.getNow()
        this.initialNowQueriedMs = new Date().valueOf()

        // wait until the beginning of the next interval
        delay = dateEnv.add(
          dateEnv.startOf(this.initialNowDate, unit),
          createDuration(1, unit)
        ).valueOf() - this.initialNowDate.valueOf()

        // TODO: maybe always use setTimeout, waiting until start of next unit
        this.nowIndicatorTimeoutID = setTimeout(() => {
          this.nowIndicatorTimeoutID = null
          update()

          if (unit === 'second') {
            delay = 1000 // every second
          } else {
            delay = 1000 * 60 // otherwise, every minute
          }

          this.nowIndicatorIntervalID = setInterval(update, delay) // update every interval
        }, delay)
      }

      // rendering will be initiated in updateSize
    }
  }


  // rerenders the now indicator, computing the new current time from the amount of time that has passed
  // since the initial getNow call.
  updateNowIndicator() {
    if (
      this.props.dateProfile && // a way to determine if dates were rendered yet
      this.initialNowDate // activated before?
    ) {
      this.unrenderNowIndicator() // won't unrender if unnecessary
      this.renderNowIndicator(
        addMs(this.initialNowDate, new Date().valueOf() - this.initialNowQueriedMs)
      )
      this.isNowIndicatorRendered = true
    }
  }


  // Immediately unrenders the view's current time indicator and stops any re-rendering timers.
  // Won't cause side effects if indicator isn't rendered.
  stopNowIndicator() {
    if (this.isNowIndicatorRendered) {

      if (this.nowIndicatorTimeoutID) {
        clearTimeout(this.nowIndicatorTimeoutID)
        this.nowIndicatorTimeoutID = null
      }
      if (this.nowIndicatorIntervalID) {
        clearInterval(this.nowIndicatorIntervalID)
        this.nowIndicatorIntervalID = null
      }

      this.unrenderNowIndicator()
      this.isNowIndicatorRendered = false
    }
  }


  getNowIndicatorUnit(dateProfile: DateProfile) {
    // subclasses should implement
  }


  // Renders a current time indicator at the given datetime
  renderNowIndicator(date) {
    // SUBCLASSES MUST PASS TO CHILDREN!
  }


  // Undoes the rendering actions from renderNowIndicator
  unrenderNowIndicator() {
    // SUBCLASSES MUST PASS TO CHILDREN!
  }


  /* Scroller
  ------------------------------------------------------------------------------------------------------------------*/


  addScroll(scroll) {
    let queuedScroll = this.queuedScroll || (this.queuedScroll = {})

    __assign(queuedScroll, scroll)
  }


  popScroll(isResize: boolean) {
    this.applyQueuedScroll(isResize)
    this.queuedScroll = null
  }


  applyQueuedScroll(isResize: boolean) {
    this.applyScroll(this.queuedScroll || {}, isResize)
  }


  queryScroll() {
    let scroll = {} as any

    if (this.props.dateProfile) { // dates rendered yet?
      __assign(scroll, this.queryDateScroll())
    }

    return scroll
  }


  applyScroll(scroll, isResize: boolean) {
    let { duration } = scroll

    if (duration != null) {
      delete scroll.duration

      if (this.props.dateProfile) { // dates rendered yet?
        __assign(scroll, this.computeDateScroll(duration))
      }
    }

    if (this.props.dateProfile) { // dates rendered yet?
      this.applyDateScroll(scroll)
    }
  }


  computeDateScroll(duration: Duration) {
    return {} // subclasses must implement
  }


  queryDateScroll() {
    return {} // subclasses must implement
  }


  applyDateScroll(scroll) {
     // subclasses must implement
  }


  // for API
  scrollToDuration(duration: Duration) {
    this.applyScroll({ duration }, false)
  }

}

EmitterMixin.mixInto(View)

View.prototype.usesMinMaxTime = false
View.prototype.dateProfileGeneratorClass = DateProfileGenerator
