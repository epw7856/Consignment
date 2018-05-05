$(document).ready(function() {     
    var ts1 = $("#table1");
    // initialize tablesorter
    ts1.tablesorter({
        widthFixed: false,
    });
    
    $(".sorting a").click(function(){
        var $t1 = $(this),
            col = $t1.attr('data-column'),
            dir = $t1.attr('data-direction');
        ts1.trigger('sorton', [ [[col, dir]] ]);
        // update to current data-direction
        $t1.attr('data-direction', ( parseInt(dir,10)+1) % 2 );
        return false;
    });

});