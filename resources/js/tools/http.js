import { useUserStore } from "@stores/user";
import axios from 'axios';

export function useHttp(){
    const userStore = useUserStore();
    const token = userStore.token;

    let api = axios.create({
		headers: {
			Authorization: 'Bearer '+token,
			Accept: 'application/json',
			'Content-type': 'application/json'
		}
	})

    api.interceptors.response.use(function (response) {
        // Any status code that lie within the range of 2xx cause this function to trigger
        // Do something with response data
        return response;
    }, function (error) {
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        // Do something with response error
        return Promise.reject(error);
    });

    return api
}