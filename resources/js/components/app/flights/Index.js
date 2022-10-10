export class FlightIndex {
  constructor() {
    this.registerEventListeners();
  }

  registerEventListeners() {
    let showOldFlights = document.getElementById('include_old_flights');

    showOldFlights.onchange = this.showOldFlightToggled;
  }

  /**
   * By default the toggle is set to disabled.
   * @param event: Event
   */
  showOldFlightToggled(event) {
    let searchParams = new URLSearchParams(document.location.search);

    const val = event.target.checked;

    if (!val) {
      searchParams.set('old', '0');
    } else {
      searchParams.set('old', '1');
    }

    window.location.search = searchParams.toString();
  }
}
