<template>
    <Pie
        :chart-options="chartOptions"
        :chart-data="chartData"
        :chart-id="chartId"
        :dataset-id-key="datasetIdKey"
        :width="20"
        :height="400"
    />
</template>

<script>
import {Bar, Pie, Doughnut} from 'vue-chartjs/legacy'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)
export default {
    // eslint-disable-next-line vue/no-unused-components
    components: {Bar, Pie, Doughnut},
     props: {
          chartId: {
        type: String,
        default: 'pie-chart'
        },
        datasetIdKey: {
        type: String,
        default: 'label'
        },
        width: {
        type: Number,
        default: 25
        },
        height: {
        type: Number,
        default: 5
        },
        cssClasses: {
        default: '',
        type: String
        },
        styles: {
        type: Object,
        default: () => {}
        },
        plugins: {
        type: Object,
        default: () => {}
        },
        objectData: {
          type: Object,
          required: true
        },
        appName: {
          type: String,
          required: false
        }
     },
     data() {
          return {
               chartData: {
                    labels: [ 'Admin', 'normal'/*, 'Não recebem newsletter' */],
                    datasets: [ { label: `permissões`,  
                    backgroundColor: [
                         'rgba(75, 192, 192)',
                         'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1,
                    data: [
                         this.objectData.admin, 
                         this.objectData.normal,
                    ], hoverOffset: 1 } ]
               },
               chartOptions: {
                    responsive: true,
                    maintainAspectRatio: true
               }
          }
     }

}
</script>

<style>

</style>