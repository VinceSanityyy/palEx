<template>
	<div>
        <PalexLoading></PalexLoading>
		<router-view />
		<router-view name="helper" />
	</div>
</template>
<style>
.palex-msg-min-width {
  min-width: 250px !important;
}
</style>
