import qs from 'qs'
import axios from 'axios'
import { reactive, toRefs } from 'vue'

const headers = {
  'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
}

function parseData ({ action, data }) {
  return qs.stringify({
    ...data,
    action
  })
}

function parseError (error) {
  return error
}

export default function (action, data = {}) {
  const state = reactive({
    isLoading: false,
    error: null,
    result: null
  })

  const run = async () => {
    try {
      state.isLoading = true
      state.result = await axios.post(site_urls.ajax, parseData({ action, data }), headers)
    } catch (error) {
      state.error = parseError(error)
    } finally {
      state.isLoading = false
    }
  }

  return { ...toRefs(state), run }
}
