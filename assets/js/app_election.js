import '../css/ui_election.scss';
import 'jquery';
import 'popper.js';

import 'bootstrap';

// import 'bootstrap/dist/js/bootstrap.bundle';
// import './scripts/hovers';

import $ from 'jquery';
$(document).ready(function () {
    $('[data-toggle="popover"]').popover({
            delay: {"show": 500, "hide": 100},
            html: true,
            trigger: 'hover',
            placement: 'auto',
        }
    );
});
