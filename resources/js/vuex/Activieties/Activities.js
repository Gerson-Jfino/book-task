import axios from 'axios'
import { URL_BASE } from '../../config/url'

export default {
    state: {
        items: {

        }
    },
    actions: {
        getActivities({commit}) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.get(`${URL_BASE}/activities`).then(res => {
                    // console.log(res);
                    resolve(res.data)
                }).catch(err => {
                    reject(err)
                }).finally(() => {commit('Loader/CHANGE_LOADING', false, { root: true })})
            })
        },
        storeAtivities({commit}, params) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.post(`${URL_BASE}/activities`, params).then(res => {
                    resolve(res)
                }).catch(err => {
                    console.log(err);
                    reject(err)
                }).finally(() => {commit('Loader/CHANGE_LOADING', false, { root: true })})
            })
        },
        showActivie({commit}, params) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.get(`${URL_BASE}/activities/${params.id}`)
                    .then(res => {
                        resolve(res)
                    })
                    .catch(err => {
                        reject(err)
                    })
                    .finally(() => {commit('Loader/CHANGE_LOADING', false, { root: true })})
            })
        },
        updateActivitie({commit}, params) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.post(`${URL_BASE}/activities/update/${params.id}`, params).then(res => {
                    resolve(res)
                }).catch(err => {
                    console.log(err);
                    reject(err)
                }).finally(() => {commit('Loader/CHANGE_LOADING', false, { root: true })})
            })
        },
        removeActivitie({commit}, params) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.delete(`${URL_BASE}/activities/${params.id}`).then(res => {
                    resolve(res)
                }).catch(err => {
                    reject(err)
                }).finally(() => {commit('Loader/CHANGE_LOADING', false, { root: true })})
            })
        }
    }
} 