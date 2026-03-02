  $(document).ready(function() {
        function getData() {
            var url ="https://api.thingspeak.com/channels/3210144/fields/1,2,3,4.json?api_key=E0ZKNVZ3HJWPSCMG&results=1";

            $.getJSON(url, function(data) {
                var field1Values = [];
                var field2Values = [];
                var field3Values = [];
                var field4Values = [];
                var timestamps = [];

                $.each(data.feeds, function(index, feed) {
					field1Values.push(feed.field1);
					field2Values.push(feed.field2);
					field3Values.push(feed.field3);
					field4Values.push(feed.field4);
					timestamps.push(feed.created_at);
				});
    
                const toplam9 = parseInt(field1Values);   
                const toplam10 = parseInt(field2Values);   
                const toplam11 = parseInt(field3Values);
                const toplam12 = parseInt(field4Values);   

                document.cookie = "toplam9="+toplam9;   // temp
                document.cookie = "toplam10="+toplam10; // rh
                document.cookie = "toplam11="+toplam11; // lat
                document.cookie = "toplam12="+toplam12; // lng

            });


        }
        getData();

    });