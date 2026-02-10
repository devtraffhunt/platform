import { api } from '../core/api';

export async function fetchGames({ page = 1, provider_id = '', search = '' }) {
  const params = new URLSearchParams({ page, provider_id, search });
  return await api(`/api/games?${params.toString()}`, 'GET');
}
