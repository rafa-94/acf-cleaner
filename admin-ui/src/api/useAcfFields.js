import { ref } from 'vue'
import useActionApi from '@/api/useActionApi'

function parseAcfField(result) {
	return result.value.data
}

export async function useDeleteAcfField(ids) {
	const { error, result, run } = useActionApi('acf_delete', { ids })

	await run()

	return { error, result }
}

export async function useGetAcfFields() {
	const fields = ref(null)
	const { isLoading, error, result, run } = useActionApi('acf_get_all')

	await run()
	fields.value = parseAcfField(result)

	return { isLoading, error, fields }
}
