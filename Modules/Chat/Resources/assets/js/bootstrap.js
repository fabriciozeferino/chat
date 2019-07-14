require('../../../../../resources/js/bootstrap.js')
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Moment = require('moment');


window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'affea2d3637f550a93db',
    cluster: 'eu',
    encrypted: true
});


