import qs from 'qs'
import axios from 'axios'
import useAsync from '@/api/useAsync'

const headers = {
	'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
}

function parseData({ action, data }) {
	return qs.stringify({
		...data,
		action
	})
}

export default function (action, data = {}) {
	const { isLoading, result, error, run } = useAsync(async () => {
		const result = await axios.post(site_urls.ajax, parseData({ action, data }), headers)
		return result
	})

	return { isLoading, result, error, run }
}
