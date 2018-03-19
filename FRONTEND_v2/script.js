$(document).ready(function(){

    // like and unlike click
    $(".like, .unlike").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else if(text == "unlike"){
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'likeunlike.php',
            type: 'post',
            data: {postid:postid,type:type},
            dataType: 'json',
            success: function(data){

                if(type == 1){
                    var likes = data['likes'];
                    $("#likes_"+postid).text(likes); 
                    $("#like_"+postid).css("color","#ffa449");
                    $("#unlike_"+postid).css("color","lightseagreen");
                }else if(type == 0){
                    var unlikes = data['unlikes'];
                    $("#unlikes_"+postid).text(unlikes); 
                    $("#unlike_"+postid).css("color","#ffa449");
                    $("#like_"+postid).css("color","lightseagreen");
                }

            }
        });

    });

});