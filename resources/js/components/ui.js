window.FlyWithMe = {};

import { NavigationMenu } from './navigation/navigationMenu';

window.FlyWithMe.NavigationMenu = NavigationMenu;

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
