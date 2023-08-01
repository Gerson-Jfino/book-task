import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {
  theme: {
    themes: {
      light: {
        accent: '#F4811F',
        secondary: '#8a0000',
      },
      dark: {
        accent: '#F4811F',
        secondary: '#f15726',
      }
    }
  },
  icons: {
    iconfont: 'mdi', // default - only for display purposes
  },
}

export default new Vuetify(opts)