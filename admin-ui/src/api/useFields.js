import useActionApi from '@/api/useActionApi'

export function useGetAllFields(fieldType) {
	const { isLoading, error, result: fields, run: getAllFields } = useActionApi(fieldType + '_get_all')
	return { isLoading, error, fields, getAllFields }
}

export function useDeleteFields(fieldType, ids) {
	const { isLoading: isDeleting, error, result, run: deleteFields } = useActionApi(fieldType + '_delete', { ids })
	return { isDeleting, error, result, deleteFields }
}
