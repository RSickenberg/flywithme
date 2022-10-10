window.FlyWithMe = {};
window.FlyWithMe.App = {};

import { NavigationMenu } from './navigation/navigationMenu';
import { FlightIndex } from './app/flights'

window.FlyWithMe.NavigationMenu = NavigationMenu;
window.FlyWithMe.App.FlightIndex = FlightIndex;

// ######################### UTILS #########################

// function interceptFlashMessage(axiosInterceptorData) {
//   console.log(axiosInterceptorData);
//
//   const landingZone = $('#flash_container');
//   landingZone.html('<flash-message :message="test" :type="info"></flash-message>');
// }
//
// window.axios.interceptors.response.use((resp) => {
//   interceptFlashMessage(resp.data);
//   return resp;
// });
