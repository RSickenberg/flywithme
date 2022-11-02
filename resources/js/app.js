import './bootstrap';
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';

import Alpine from 'alpinejs';
import AlpineFloatingUI from '@awcodes/alpine-floating-ui'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import './components/ui';

Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine;

Alpine.start();
