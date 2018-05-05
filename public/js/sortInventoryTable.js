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

    var ts2 = $("#table2");
    // initialize tablesorter
    ts2.tablesorter({
        widthFixed: false,
    });
    
    $(".sorting2 a").click(function(){
        var $t2 = $(this),
            col = $t2.attr('data-column'),
            dir = $t2.attr('data-direction');
        ts2.trigger('sorton', [ [[col, dir]] ]);
        $t2.attr('data-direction', ( parseInt(dir,10)+1) % 2 );
        return false;
    });

});