<script setup>
import { ref } from 'vue';
import Button from '../button/Button.vue';

// Example reactive state

function handleClick() {
	alert('Button clicked!');
}
</script>

<template>
	<div class="border-2 p-1 bg-black flex flex-col items-center justify-center h-full w-full">
		<Button @click="handleClick" class="mt-2 cursor-pointer">Add an exercice</Button>
		<!-- Add your component content here -->
	</div>
</template>