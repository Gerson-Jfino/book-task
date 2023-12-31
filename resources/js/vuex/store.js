import Vue from "vue";
import Vuex from 'vuex';
import Activities from "./Activieties/Activities";
import Loader from "./Loader/Loader";
import Status from "./status/Status";
import Auth from "./Auth/Auth";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Activities,
        Loader,
        Status,
        Auth
    }
});