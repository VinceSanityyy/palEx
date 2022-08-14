<template>
	<section class="content mt-2" style="margin-bottom: 5rem">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="palex-card">
						<div class="px-2" style="font-weight: bold; font-size: 24px"><i class="fas fa-shopping-cart mr-2"></i>TEST PAGE</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
export default {
	data() {
		return {};
	},
	mounted() {
		Pusher.logToConsole = true;
		var pusher = new Pusher("8bfb7f6648a195296a7f", {
			cluster: "ap1",
		});
		var channel = pusher.subscribe("palex-channel");
		channel.bind("palex-pusher-event", function (data) {
			// console.warn(data);
			self.receive_PalexPusherEvent(data);
		});
		this.test();
	},
	methods: {
		test() {},
	},
};
</script>

