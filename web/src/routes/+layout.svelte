<script>
	import Header from './Header.svelte';
</script>

<div class="app">
	<Header />

	<main>
		<slot />
	</main>

	<footer>
        <p>footer</p>
	</footer>
</div>

<style lang="scss">
</style>
