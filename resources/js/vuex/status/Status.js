import axios from 'axios'
import { URL_BASE } from '../../config/url'
export default {    
    state: {
        status: {
            
        }
    },
    actions: {
        getStatus({commit}) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.get(`${URL_BASE}/status`).then(res => {
                    resolve(res)
                }).catch(err => {
                    reject(err)
                }).finally(() => {
                    commit('Loader/CHANGE_LOADING', false, { root: true })
                })
            })
        }
    },

} 