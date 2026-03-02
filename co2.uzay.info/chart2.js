$(document).ready(function() {
	function getData() {
		var url = "https://api.thingspeak.com/channels/3210139/fields/8.json?api_key=Z5YPB49X9V81MVGD&results=7";

		$.getJSON(url, function(data) {
			var field8Values = [];
			var timestamps = [];

			$.each(data.feeds, function(index, feed) {
				field8Values.push(feed.field8);
                // timestamps.push(feed.created_at);
				timestamps.push(feed.created_at.substring(11, 19));
			});

			var ctx = document.getElementById('myChart2').getContext('2d');
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: timestamps,
					datasets: [{
						label: 'SpaceData%',
						data: field8Values.map(num => parseFloat(Number(num) / (Math.pow(2, 12) - 1) * 100).toString()),
						backgroundColor: blue(0.2),
						borderColor: blue(1),
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});
		});
	}
	getData();
});
