import { computed, ref } from 'vue';

function parseError(error) {
	return error;
}

export default function(cb = () => { }) {
	const isLoading = ref(false);
	const error = ref(null);
	const result = ref(null);


	const run = async () => {
		try {
			isLoading.value = true
			result.value = await cb();
		} catch (e) {
			error.value = parseError(e)
		} finally {
			isLoading.value = false
		}
	}

	return {
		isLoading: computed(() => isLoading.value),
		error: computed(() => error.value),
		result: computed(() => result.value),
		run
	}
}
