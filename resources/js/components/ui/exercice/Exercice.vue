<script setup>
import { ref } from 'vue';
import Button from '../button/Button.vue';

const step = ref(0);

// Example reactive state

function handleClick() {
	switch (step.value) {
		case 0:
			console.log('Add an exercice clicked');
			step.value = 1;
			break;
		case 1:
			console.log('Muscle ciblé clicked');
			step.value = 2;
			break;
		case 2:
			console.log('Exercice clicked');
			step.value = 3;
			break;
		case 3:
			console.log('Nombre de séries + rep/chrono clicked');
			step.value = 4;
			break;
		case 4:
			console.log('Exercice complete avec possibilité de edit clicked');
			break;
		default:
			step.value = 0;
	}
}
</script>

<template>
	
	<div class="border-2 p-1 bg-black flex flex-col items-center justify-center h-full w-full">
		<Button @click="step = 0" class="mt-2 cursor-pointer bg-red-800 hover:bg-green-800">RESET</Button>
		<Button v-if="step === 0" @click="handleClick" class="mt-2 cursor-pointer">Add an exercice</Button>
		<Button v-else-if="step === 1" @click="handleClick" class="mt-2 cursor-pointer">Muscle ciblé</Button>
		<Button v-else-if="step === 2" @click="handleClick" class="mt-2 cursor-pointer">Exercice</Button>
		<Button v-else-if="step === 3" @click="handleClick" class="mt-2 cursor-pointer">Nombre de séries + rep/chrono</Button>
		<Button v-else-if="step === 4" @click="handleClick" class="mt-2 cursor-pointer">Exercice complete avec possibilité de edit</Button>
	</div>
</template>