function voteSinge() {
    console.log("A voté ! Singe")
    $.ajax({
        url: "/votes/singe",
        type: 'post',
        success:function(data){
            console.log(data);
            reloadResults();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}

function voteOrni() {
    console.log("A voté ! ornithorynque")
    $.ajax({
        url: "/votes/ornithorynque",
        type: 'post',
        success:function(data){
            console.log(data);
            reloadResults();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}

function reloadResults() {
    $.ajax({
        url: "/votes",
        type: 'get',
        success:function(data){
            console.log(data);
            $('#results').html(data)
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
        }

    });
}