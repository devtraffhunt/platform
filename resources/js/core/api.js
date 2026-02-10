import { csrfToken } from './csrf';

export async function api(endpoint, method = 'GET', data = null) {
  const options = {
    method,
    headers: {
      'Accept': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    },
    credentials: 'include',
  };

  if (data) {
    options.headers['Content-Type'] = 'application/json';
    options.body = JSON.stringify(data);
  }

  const response = await fetch(endpoint, options);
  const contentType = response.headers.get('content-type');

  let result;
  if (contentType && contentType.includes('application/json')) {
    result = await response.json();
  } else {
    result = { message: await response.text() };
  }

  if (!response.ok) {
    const error = new Error(result.message || 'Request failed');
    error.status = response.status;
    error.response = result;
    throw error;
  }

  return result?.data ?? result;
}
