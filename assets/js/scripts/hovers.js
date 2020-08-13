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
// export default function($elements, $data);

// export default function(){
//     $('[data-toggle="popover"]').popover();
// });

