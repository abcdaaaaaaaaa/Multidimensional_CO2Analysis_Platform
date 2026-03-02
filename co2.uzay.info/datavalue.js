  $(document).ready(function() {
        function getData() {
            var url ="https://api.thingspeak.com/channels/3210139/fields/1,2,3,4,5,6,7,8.json?api_key=Z5YPB49X9V81MVGD&results=1";

            $.getJSON(url, function(data) {
                var field1Values = [];
                var field2Values = [];
                var field3Values = [];
                var field4Values = [];
                var field5Values = [];
                var field6Values = [];	
                var field7Values = [];	
                var field8Values = [];	
                var timestamps = [];

                $.each(data.feeds, function(index, feed) {
					field1Values.push(feed.field1);
					field2Values.push(feed.field2);
					field3Values.push(feed.field3);
					field4Values.push(feed.field4);
					field5Values.push(feed.field5);
					field6Values.push(feed.field6);
					field7Values.push(feed.field7);
					field8Values.push(feed.field8);
					timestamps.push(feed.created_at);
				});
    
                const toplam1 = parseInt(field1Values) / 100;   
                const toplam2 = parseInt(field2Values) / 10000;   
                const toplam3 = parseInt(field3Values) / 100;
                const toplam4 = parseInt(field4Values) / 100;   
                const toplam5 = parseInt(field5Values) / 100;   
                const toplam6 = parseInt(field6Values) / 100;
                const toplam7 = parseInt(field7Values) / 100;
                const toplam8 = parseInt(field8Values) / (Math.pow(2, 12) - 1) * 100;   


                document.cookie = "toplam1="+toplam1; // Time
                document.cookie = "toplam2="+toplam2; // Correction
                document.cookie = "toplam3="+toplam3; // TheoreticalCO2
                document.cookie = "toplam4="+toplam4; // CO2
                document.cookie = "toplam5="+toplam5; // CH4
                document.cookie = "toplam6="+toplam6; // C2H5OH
                document.cookie = "toplam7="+toplam7; // CO
                document.cookie = "toplam8="+toplam8; // Gas

            });


        }
        getData();

    });