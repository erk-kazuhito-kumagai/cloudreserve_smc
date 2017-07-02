function serarchZip(ele) {
    var data = {
	    zipcode    : $('#post').val().replace(/-/g, '')
	};
    var ret = false;
    $.ajax({
        type: 'post',
        dataType: 'jsonp',
        url: 'http://zipcloud.ibsnet.co.jp/api/search',
        data: data,
        async:true,
        timeout: 10000,
        success: function(response, dataType){
           
           if(response.results) {
               if(data.count == 0) {
                   alert(data.message);
               } else if(response.results.length == 1)  {
                   $("#prefecture").focus();
                   $("#prefecture").val(response.results[0].address1);
                   $("#address1").focus();
                   $("#address1").val(response.results[0].address2 + response.results[0].address3);
                   $("#address2").focus();
                   $("#address1").focus();
               }
           } else {
               alert('データがありません');
           }
        },
        error: function(xhr, textStatus, error) {
        alert('検索できませんでした');
        }
    });
   return ret;
}

function onSelect(el, text, value) {
    data = text.split(' ');
    $("#prefecture").focus();
     
    if(data.length == 2) {
        $("#prefecture").val(data[0]);
        $("#address1").focus();
        $("#address1").val(data[1]);
        
    } else {
       $("#address1").focus();
       $("#address1").val(text);
    }
    $("#address2").focus();
    return true;
}

$(document).ready(function() {
	$('#post_search').click(function(e) {
	     serarchZip(this, e);
	});
});
